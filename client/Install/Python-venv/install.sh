#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 10/07/22
# version ='3.0'
# ---------------------------------------------------------------------------

# Install the venv python on the share directory and install the lib
#+ required by the client

#User configuration
ipNas=ip.of.the.nas
ShareDirectory=:/path/to/share/directory

#Script ---------------------------------------------------------------------
#Wait for network up
var=$(ping $ipNas -c 1 2>&1)
while [ ${var:15:7} = "Network" ]
do
	var=$(ping $ipNas -c 1 2>&1)
done
#Mount directory with nfs protocole
sudo mkdir /media/data
sudo mount -t nfs $ipNas$ShareDirectory /media/data
#Make the folder use by client
sudo mkdir /media/data/3D
sudo mkdir /media/data/Preview
#Make the venv environnement
sudo apt install python3-venv -y
sudo python3 -m venv /media/data/ProgClient
#Active the venv
source /media/data/ProgClient/bin/activate
#Install the lib
pip install -r ./requirements.txt
#Shutdown
sudo shutdown -h now
# ---------------------------------------------------------------------------
