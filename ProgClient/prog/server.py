#!/usr/bin/env python3
# -*- coding: utf-8 -*-

#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 07/07/22
# version ='1.0'
# ---------------------------------------------------------------------------

""" Create a client that connects to an MQTT broker, listen 'Register' topic
and add every message receive in a sql database"""

# Import libraries ----------------------------------------------------------
import paho.mqtt.client as mqtt
#pip install mysql-connector-python
import mysql.connector
# ---------------------------------------------------------------------------

#global variable-------------------------------------------------------------
mydb=0
# ---------------------------------------------------------------------------


# const variable ------------------------------------------------------------
BROKER_IP = "ip.of.the.broker"
# ---------------------------------------------------------------------------

#Callback function ----------------------------------------------------------
def on_connect(client, userdata, flags, rc):
	""" When we are connected to the broker we suscribe
	to topic use by the programm"""
	print ("connected with result code" + str(rc))
	# Suscribe to a project
	ourClient.subscribe("Register")

def messageFunction (client, userdata, message):
	""" When client receive a message on Register topic
	the function add the message in database """
	global mydb
	topic = str(message.topic).split('/') #We divide the topic by '/' character
	message = str(message.payload.decode("utf-8"))
	if (topic[0] == "Register"):
		cursor = mydb.cursor()
		sql = """INSERT INTO MAC(ADDRESS) VALUES ('"""+message+"""')"""
		try:
			cursor.execute(sql)
			mydb.commit()
		except:
			mydb.rollback()

# ---------------------------------------------------------------------------

# main ----------------------------------------------------------------------

# Creating connection object
mydb = mysql.connector.connect(host = "localhost", user = "yourusername", password = "your_password")

ourClient = mqtt.Client(mac_address[0]) #Create client with mac address for the name
ourClient.on_connect = on_connect #Define the connect callback for when we are connected
ourClient.on_message = messageFunction #Define the callback function for when the client receive a message

# Connexion to MQTT broker
try:
	ourClient.connect(BROKER_IP, 1883)
except:
	print("error")

# Start client loop
ourClient.loop_forever()
# ---------------------------------------------------------------------------
