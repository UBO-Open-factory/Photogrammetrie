Here you can found how setup and install the different part of the
project :

# Setup the Network Attached Storage:

For this you need to setup a NAS wich have the possibilities to create an NFS share directory and, if you don't want to connect all the RPI to internet but have the RPI at the good time, the possibilities to make a NTP server. For this i can recommand you

- Synology : allready mount you have just the config to make but it cost 200€
- OpenMediaVault : based and debian and open-source but you need install it on a computer by yourself but is free if you have an old computer and because is a debian like you have a debian system on the computer so you can use apt and other linux command.

# Install the MQTT broker

**But where install it ? You have two choice here :**
- On the NAS if it is possible
- On an another computer, maibye the same that the web server

**To install it :**

1. Download the **MQTT_broker** directory
2. Open a terminal and go in the directory:
```
cd path/of/MQTT_broker/directory
```
3. Make the install.sh script executable and execute him:
```
sudo chmod +x ./install.sh
./install.sh
```
4. The script reboot your computer when the broker is installed

Now we have all the server part ready for the next step, we need
ip address of NAS and MQTT broker so write it somewhere.

# Install of venv python:

1- Download **Python-venv** directory => git clone or wget
2- Open a terminal and go in the directory : 
```
'cd path/of/Python-venv/directory'
```
3- open **install.sh** and set the good information about nas ip and name of share directory
4- Make the install.sh script executable and execute him:
```
sudo chmod +x ./install.sh
sudo su -c "./install.sh"
```
5- If the computer shutdown is good
		
When you have the venv correctly installed you need to add the **prog** directory in the venv folder and set inforamtion about nas ip in **connect.sh** and broker ip in **boot.py** and **prog.py**, in the **prog** folder.
			
**Now we can install the client for the fisrt RPI**
# Install the client:
1. Install PI os without desktop' on a pi 3
2. Download the **Client** directory on the pi => wget or git clone
3. Open a terminal and go to in the directory:
```
'cd path/of/Client/directory'
```
4. Make the install.sh script executable and execute him:
```
sudo chmod +x ./install.sh
./install.sh
```
5. After a while you need to config the camera to this the script execute the command below
```
raspi-config 
```
6. Here you need to go to :
	- 3 Interface Options
	- P1 Camera
	- yes
7. Open the script **connect.sh**:
```
sudo nano /media/connect.sh
```
8. Set information about nas ip and name of share directory
9. Reboot
```
sudo reboot
```

The pi download the good **connect.sh** script on the share directory and reboot the first time automatycally so wait few minutes and don't worry
			
# Now you can duplicate this client on an another SD card for that
You can use **win32diskimager** on windows to create a .img and write it an another SD cards.
