#!/usr/bin/env python3
# -*- coding: utf-8 -*-

#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 07/07/22
# version ='3.0'
# ---------------------------------------------------------------------------

""" Create a client that connects to an MQTT broker, listen 'Register' topic
and add every message receive in a sql database"""

# Import libraries ----------------------------------------------------------
import paho.mqtt.client as mqtt
import mysql.connector
# ---------------------------------------------------------------------------

# const variable ------------------------------------------------------------
BROKER_IP = "ip.of.the.broker"
USER_DB = "username"
PASS_DB = "password"
IP_DB = "ip.of.the.db"
DB = "mysql.mac"
# ---------------------------------------------------------------------------

#Callback function ----------------------------------------------------------
def on_connect(client, userdata, flags, rc):
	""" When we are connected to the broker we suscribe
	to topic use by the programm"""
	print ("connected with result code" + str(rc))
	# Suscribe to a project
	ourClient.subscribe("Register")
	ourClient.subscribe("IsAlive")

def messageFunction (client, userdata, message):
	""" When client receive a message on Register topic
	the function add the message in database """
	topic = str(message.topic).split('/') #We divide the topic by '/' character
	message = str(message.payload.decode("utf-8"))

	#Open database
	mydb = mysql.connector.connect(host = IP_DB, user = USER_DB, password = PASS_DB)

	if (topic[0] == "IsAlive"):
		#Create cursor to execute SQL command
		cursor = mydb.cursor()

		sql = "update "+DB+" set alive = %s where address = %s";
		try:
			cursor.execute(sql, ["1", message]) #Add mac address
			mydb.commit() #Commit
		except:
			mydb.rollback() #If command fail rollback
	if (topic[0] == "Register"):
		#Create cursor to execute SQL command
		cursor = mydb.cursor()
		try:
			sql = "select address from "+DB+" where address=%s;"
			cursor.execute(sql, [message]) #Verify if mac address does not exist
			result = cursor.fetchall()
			if (len(result) == 0):
				sql = "insert into "+DB+"(address,alive) values (%s,%s);"
				cursor.execute(sql, [message, "1"]) #Add mac address
				mydb.commit() #Commit
				print ("Success")
			else:
				print ("Already in the databases")
		except:
			mydb.rollback() #If command fail rollback
			print ("Failure")
	mydb.close() #Close database

# ---------------------------------------------------------------------------

# main ----------------------------------------------------------------------
ourClient = mqtt.Client("Broker") #Create client with mac address for the name
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
