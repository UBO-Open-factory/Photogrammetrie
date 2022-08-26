#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 10/07/22
# version ='3.0'
# ---------------------------------------------------------------------------

# ./mqtt.sh <topic> <message> : send message at topic on MQTT broker 

#Script ---------------------------------------------------------------------
if [ $# -eq 2 ]; then
	mosquitto_pub -h ip.of.the.broker -t "$1" -m "$2"
else
	echo './mqtt.sh <topic> <message>'
fi
