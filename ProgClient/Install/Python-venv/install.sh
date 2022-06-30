#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 23/06/22
# version ='1.0'
# ---------------------------------------------------------------------------

# Install the venv python on the share directory and install the lib
#+ required by the client

#Script ---------------------------------------------------------------------
#Wait for network up
var=$(ping ip.of.the.nas -c 1 2>&1)
while [ ${var:15:7} = "Network" ]
do
	var=$(ping ip.of.the.nas -c 1 2>&1)
done
#Mount directory with nfs protocole
sudo mkdir /media/data
sudo mount -t nfs ip.of.the.nas:/path/to/share/directory /media/data >> /var/log/MQTT/log
#Make the venv environnement
sudo apt install python3-venv -y
sudo python3 -m venv /media/data/ProgClient
#Active the venv
source /media/data/ProgClient/bin/activate
#Install the lib
sudo pip install -r ./requirements.txt
#Shutdown
sudo shutdown -h now
# ---------------------------------------------------------------------------