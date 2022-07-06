#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 23/06/22
# version ='2.1'
# ---------------------------------------------------------------------------

# Mount the share directory that contains the venv python
#+ activate it and start the client

#Script ---------------------------------------------------------------------
echo "Lancement" >> /var/log/MQTT/log
echo "Lancement" >> /home/pi/watchdogLog/log

declare -i boot=$(cat /media/boot)
boot+=1
echo $boot | sudo tee /media/boot

if [ $boot = 3 ]; then
		sudo systemctl stop watchdog.service
        echo '0' | sudo tee /media/boot
fi

#Wait for network is up
var=$(ping ip.of.the.NAS -c 1 2>&1)
while [ ${var:15:7} = "Network" ]
do
	var=$(ping ip.of.the.NAS -c 1 2>&1)
done
echo "Network is up" >> /var/log/MQTT/log
#Turn on red led
sudo /media/gpio.sh 0
#Mount the directory
sudo mount -t nfs ip.of.the.NAS:/path/of/ProgClient/directory /media/data >> /var/log/MQTT/log
#Test if directory is mount
if [ -f /media/data/mount ]; then
	echo "Error when mounting the directory" >> /var/log/MQTT/log
else
	echo "Directory ok" >> /var/log/MQTT/log
	#Copy the script for update
	sudo cp /media/data/ProgClient/prog/connect.sh /media/connect.sh
	#DO NOT MODIFY THE SCRIPT BEFORE THIS POINT TO AVOID TO BREAK THE SCRIPT AND DISABLE THE AUTO UPDATE
	var=$(gphoto2 --auto-detect | awk '{print $3}')
	if [ -z $var ]; then
		DSLR=0
	else
		DSLR=1
	fi
	sudo rfkill block wifi
	echo "Directory mount success" >> /var/log/MQTT/log
	#activate the python env
	source /media/data/ProgClient/bin/activate
	echo "Source ok" >> /var/log/MQTT/log
	#Go to prog directory
	cd /media/data/ProgClient/prog
	echo "Chemin ok" >> /var/log/MQTT/log
	#Launch the register python programme
	python3 boot.py
	echo "Register ok" >> /var/log/MQTT/log
	echo "Prog lancé" >> /var/log/MQTT/log
	#Launch the loop python programme
	echo "Lancement client" >> /home/pi/watchdogLog/log
	python3 prog.py $DSLR
	echo "Prog fini" >> /var/log/MQTT/log
	#If prog end turn on blue and red led for error
	sudo /media/gpio.sh 1
fi

echo "Fermeture prog" >> /var/log/MQTT/log

# ---------------------------------------------------------------------------
