#!/usr/bin/env python3
# -*- coding: utf-8 -*-

#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 10/07/22
# version ='3.0'
# ---------------------------------------------------------------------------

""" Make led on pin 23 of GPIO flash with frequency and duty cycle
    give in parameters"""

# Import libraries ----------------------------------------------------------
import RPi.GPIO as GPIO
import sys
# ---------------------------------------------------------------------------

# main ----------------------------------------------------------------------
#Setup PWM for pin 23
GPIO.setmode(GPIO.BCM) #Type of access to the GPIO
GPIO.setup(23, GPIO.OUT) #Set pin 23 in output mode
p= GPIO.PWM(23, int(sys.argv[1])) #Set the frequency of the PWM
p.start(int(sys.argv[2])) #Start the PWM and set the duty cycle

while(1): #make the programm loop forever
	a=0

# ---------------------------------------------------------------------------