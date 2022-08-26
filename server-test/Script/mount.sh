#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 10/07/22
# version ='3.0'
# ---------------------------------------------------------------------------

# Mount share directory and start the server programm

# User configuration --------------------------------------------------------
ipNas=ip.of.the.nas
ShareDirectory=:/path/of/share/directory
ipBroker=ip.of.the.broker
ipDb=ip.of.the.db
dbUser=userDb
dbPass=passDb

#Script ---------------------------------------------------------------------
#Wait for network is up
var=$(ping $ipNas -c 1 2>&1)
while [ ${var:15:7} = "Network" ]
do
	var=$(ping $ipNas -c 1 2>&1)
done
#Mount the directory
sudo mount -t nfs $ipNas$ShareDirectory /media/data
python3 /home/pi/server.py $ipBroker $dbUser $dbPass $ipDb