#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 23/06/22
# version ='1.0'
# ---------------------------------------------------------------------------

#Download the real 'connect.sh' script on share directory and
#+ reboot to execute the new script

#Script ---------------------------------------------------------------------
echo "Lancement" >> /var/log/MQTT/log
#Wait for network up
var=$(ping ip.of.the.nas -c 1 2>&1)
while [ ${var:15:7} = "Network" ]
do
	var=$(ping ip.of.the.nas -c 1 2>&1)
done
echo "Network is up" >> /var/log/MQTT/log
#Mount directory with nfs protocole
sudo mount -t nfs ip.of.the.nas:/path/of/share/directory /media/data >> /var/log/MQTT/log
#Test if the directory if mount
if [ -f /media/data/mount ]; then
	echo "Error when mounting the directory" >> /var/log/MQTT/log
else
	echo "Directory ok" >> /var/log/MQTT/log
	#copy the real startup scripàt
	sudo cp /media/data/ProgClient/prog/connect.sh /media/connect.sh
	echo "Connect.shy success copy" >> /var/log/MQTT/log
	#reboot to apply the update
	sudo reboot
fi
# ---------------------------------------------------------------------------