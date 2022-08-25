#Wait for network is up
var=$(ping ip.of.the.nas -c 1 2>&1)
while [ ${var:15:7} = "Network" ]
do
	var=$(ping ip.of.the.nas -c 1 2>&1)
done
#Mount the directory
sudo mount -t nfs ip.of.the.nas:/path/of/share/directory /media/data
python3 /home/pi/server.py