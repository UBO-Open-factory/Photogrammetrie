#!/usr/bin/env python3
# -*- coding: utf-8 -*-

#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 06/07/22
# version ='2.0'
# ---------------------------------------------------------------------------

""" create a client that connects to an MQTT broker and send the mac address
    on 'Register' topic"""

# Import libraries ----------------------------------------------------------
import paho.mqtt.client as mqtt
import RPi.GPIO as GPIO
import os
import time
import datetime
# ---------------------------------------------------------------------------

# global variable -----------------------------------------------------------
global mac_address
# ---------------------------------------------------------------------------

# const variable ------------------------------------------------------------
BROKER_IP = "ip.of.the.broker"
# ---------------------------------------------------------------------------

# Callback function ---------------------------------------------------------
def on_log(client, userdata, level, buff):
	""" Write log in the log file when a log interrupt is raise by the client"""
	error = buff
	f = open("/var/log/MQTT/log", "a")
	f.write(datetime.datetime.now().strftime('[%d.%m.%y_%H.%M.%S]')+"Boot.py: "+error+'\n')
	f.close()

#Callback on connection
def on_connect(client, userdata, flags, rc):
	""" Call when the client is connect to the MQTT broker
	suscribe to 'Register' topic ans send the mac address on it"""
	print ("connected with result code" + str(rc))
	client.subscribe("Register")
	client.publish("Register", mac_address[0])
	client.subscribe("Time")
	client.publish("Time", datetime.datetime.now().strftime('[%d.%m.%y_%H.%M.%S]'))
	os.system("echo '0' | sudo tee /media/boot")
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

ourClient = mqtt.Client(mac_address[0]) #Create client with mac address for the name
ourClient.on_log = on_log #define the callback function for log
ourClient.on_connect = on_connect #Define the connect callback for when we are connected

# Login et mot de passe
#ourClient.username_pw_set(username="montotof",password="trucmuche")

# Connexion to MQTT broker
try:
	ourClient.connect(BROKER_IP, 1883)
except:
	f = open("/var/log/MQTT/log", "a")
	f.write(datetime.datetime.now().strftime('[%d.%m.%y_%H.%M.%S]')+"Boot.py: Erreur lors de la connexion au serveur\n")
	f.close()
	os.system("python errorGpio.py 1 50 &")

ourClient.loop_start() #start client
time.sleep(2) #wait for client send mac address to Register topic
ourClient.loop_stop() #stop client
# ---------------------------------------------------------------------------