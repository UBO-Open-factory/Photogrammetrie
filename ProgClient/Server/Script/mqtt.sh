if [ $# -eq 2 ]; then
	mosquitto_pub -h ip.of.the.broker -t "$1" -m "$2"
else
	echo './mqtt.sh <topic> <message>'
fi
