#!/usr/bin/env python3
# -*- coding: utf-8 -*-

#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 10/07/22
# version ='3.0'
# ---------------------------------------------------------------------------

""" Create a client that connects to an MQTT broker and wait for message.
    When he receive a message it performs an action associated with the message"""

# Import libraries ----------------------------------------------------------
import paho.mqtt.client as mqtt
import RPi.GPIO as GPIO
import time
import datetime
import os
import sys
# ---------------------------------------------------------------------------

#global variable-------------------------------------------------------------
global mac_address
nb_reconnect = 0
# ---------------------------------------------------------------------------

# const variable ------------------------------------------------------------
BROKER_IP = "ip.of.the.broker"
DSLR=int(sys.argv[1])
# ---------------------------------------------------------------------------

#Callback function ----------------------------------------------------------
def on_log(client, userdata, level, buff):
	""" Write log in the log file when a log interrupt is raise by the client"""
	error = buff
	f = 0
	if ((error == "Sending PINGREQ") or (error == "Received PINGRESP")):
		f = open("/home/pi/watchdogLog/log", "a")
	else:
		f = open("/var/log/MQTT/log", "a")
	f.write(datetime.datetime.now().strftime('[%d.%m.%y_%H.%M.%S]')+error+'\n')
	f.close()

def on_connect(client, userdata, flags, rc):
	""" When we are connected to the broker we suscribe
	to topic use by the programm and count the number
	of time this function is called to detect multiple
	connection"""
	global nb_reconnect
	global led_error
	print ("connected with result code" + str(rc))
	nb_reconnect+=1
	if (nb_reconnect == 4): #client connect/disconnect more than four times so make Error signal (led red 0.5s on / 0.5s off)
		os.system("python errorGpio.py 2 50 &")
	elif (nb_reconnect < 4):
		GPIO.output(23, False) #else turn off red led

	# Suscribe to a project
	ourClient.subscribe("Photo/"+mac_address[0]+"/#")
	ourClient.subscribe("Photo/all")

	ourClient.subscribe("Reboot/all")
	ourClient.subscribe("Reboot/"+mac_address[0])

	ourClient.subscribe("Shutdown/all")
	ourClient.subscribe("Shutdown/"+mac_address[0])

	ourClient.subscribe("IsAlive/all")
	ourClient.subscribe("IsAlive/"+mac_address[0]+"/#")

    #Write we are connected to the broker in log file
	f = open("/var/log/MQTT/log", "a")
	f.write(datetime.datetime.now().strftime('[%d.%m.%y_%H.%M.%S]')+"Connexion réussie\n")
	f.close()
	GPIO.output(18, True) #turn on blue light

def messageFunction (client, userdata, message):
	""" When client receive a message on one of this suscribe topic
	this function was called and analyse the message to execute
	the correct action"""
	global blue_flip_flop
	topic = str(message.topic).split('/') #We divide the topic by '/' character
	message = str(message.payload.decode("utf-8"))

	if (topic[0] == "Reboot"): #Reboot pi
		if (len(topic) > 1):
			if (topic[1] == mac_address[0]) or (topic[1] == "all"): #If it is just me or all
				f = open("/var/log/MQTT/log", "a")
				f.write(datetime.datetime.now().strftime('[%d.%m.%y_%H.%M.%S]')+"Reboot : "+message)
				f.close()
				os.system("sudo reboot")
				os.system("killall -9 python3")

	if (topic[0] == "Shutdown"): #Reboot pi
		if (len(topic) > 1):
			if (topic[1] == mac_address[0]) or (topic[1] == "all"): #If it is just me or all
				f = open("/var/log/MQTT/log", "a")
				f.write(datetime.datetime.now().strftime('[%d.%m.%y_%H.%M.%S]')+"Shutdown : "+message)
				f.close()
				os.system("sudo shutdown -h now")
				os.system("killall -9 python3")

	if (topic[0] == "Photo"): #Take photo
		if (len(topic) > 1):
			if (topic[1] == "all"): #Take photo and save it on NAS with the name : Date+message
				os.system("sudo mkdir ../../3D/"+message)
				str_cmd = "sudo raspistill -t 1 -q 100 -o ../../3D/"+message+"/"+mac_address[0]+".jpg"
				os.system(str_cmd)
				if (DSLR == 1): #Take photo with the DSLR if have one
					os.system("gphoto2 --capture-image-and-download")
					os.system("mv ./*.jpg ../../3D/"+message+"/DSLR_"+mac_address[0]+".jpg")
			if (topic[1] == mac_address[0]): #Take photo and save it on NAS with the name : mac_address + preview
				str_cmd = "sudo raspistill -t 1 -q 25 -w 100 -h 100 -o ../../Preview/"+mac_address[0]+".jpg"
				os.system(str_cmd)
				if (DSLR == 1): #Take photo with the DSLR if have one
					os.system("gphoto2 --capture-image-and-download")
					os.system("mv ./*.jpg ../../Preview/DSLR_"+mac_address[0]+".jpg")

	if (topic[0] == "IsAlive" and message == "is alive"): #Server want know if i'm alive or not
		if (len(topic) > 1):
			if (topic[1] == mac_address[0]):
				if (len(topic) > 2):
					if (topic[2] == "ok"):
						blue_flip_flop.start(100)
				else:
					blue_flip_flop.start(50)
					print ("Demande de vie demande")
					client.publish("IsAlive", mac_address[0])
			if (topic[1] == "all"):
				print ("Demande de vie demande")
				client.publish("IsAlive", mac_address[0])

# ---------------------------------------------------------------------------

# main ----------------------------------------------------------------------

#Write the mac address in the /home/pi/mac file ----
os.system('sudo ./mac.sh')
filin = open("/home/pi/mac", "r")
mac_address = filin.readlines()
for i in range(len(mac_address)): #replace the ':' by '-'
	mac_address[i] = mac_address[i].replace(':', '-')
	mac_address[i] = mac_address[i][:-1] #remove the '\n'
filin.close()
#---------------------------------------------------

GPIO.setmode(GPIO.BCM)
GPIO.setup(18, GPIO.OUT) #blue led
GPIO.setup(23, GPIO.OUT) #red led

blue_flip_flop = GPIO.PWM(18, 1) #Make PWM blue led variable

ourClient = mqtt.Client(mac_address[0]) #Create client with mac address for the name
ourClient.on_log = on_log #define the callback function for log
ourClient.on_connect = on_connect #Define the connect callback for when we are connected
ourClient.on_message = messageFunction #Define the callback function for when the client receive a message

# Login et mot de passe
#ourClient.username_pw_set(username="montotof",password="trucmuche")

# Connexion to MQTT broker
try:
	ourClient.connect(BROKER_IP, 1883)
except:
	f = open("/var/log/MQTT/log", "a")
	f.write(datetime.datetime.now().strftime('[%d.%m.%y_%H.%M.%S]')+"Erreur lors de la connexion au serveur\n")
	f.close()
	os.system("python errorGpio.py 1 50 &")

# Start client loop
ourClient.loop_forever()
# ---------------------------------------------------------------------------
