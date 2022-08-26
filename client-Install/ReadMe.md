# Server installation
## Setup the Network Attached Storage:

For this you need to setup a NAS wich have the possibilities to create an NFS share directory and, if you don't want to connect all the RPI to internet but have the RPI at the good time, the possibilities to make a NTP server. For this i can recommand you

- Synology : allready mount you have just the config to make but it cost 200€
- OpenMediaVault : based and debian and open-source but you need install it on a computer by yourself but is free if you have an old computer and because is a debian like you have a debian system on the computer so you can use apt and other linux command.

## Install the MQTT broker

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

## Install of venv python:

1. Download **Python-venv** directory
```
wget https://github.com/UBO-Open-factory/Photogrammetrie/raw/ClientRPI/client-Install/Python-venv/download.sh
chmod +x ./download.sh
./download.sh
```
2. Go in the directory : 
```
'cd Python-venv'
```
3. open **install.sh** and set the good information about nas ip and name of share directory
```
nano install.sh
```
4. Make the install.sh script executable and execute him:
```
sudo chmod +x ./install.sh
sudo su -c "./install.sh"
```
5- If the computer shutdown is good

## Config the programme
When you have the venv correctly installed you need to add the **prog** directory in the venv folder and set inforamtion about nas ip, broker ip and path of share directory in **connect.sh**

# Client installation
**Now we can install the client for the fisrt RPI**
## Install the client manually:
1. Install PI os without desktop' on a pi 3
2. Download the **Client** directory on the pi
```
wget https://github.com/UBO-Open-factory/Photogrammetrie/raw/ClientRPI/client-Install/Client/download.sh
chmod +x ./download.sh
./download.sh
```
3. Go to in the directory:
```
cd Client
```
4. Open the user config file **user.conf**:
```
sudo nano config/user.conf
```
5. Set information about nas ip and path of share directory
6. Open the config file **timesyncd.conf**
```
sudo nano config/timesyncd.conf
```
7. Set information about nas ip
8. Make the install.sh script executable and execute him:
```
sudo chmod +x ./install.sh
sudo sed -i 's/\r$//' install.sh
./install.sh
```
9. After a while you need to config the camera to this the script execute the command below
```
raspi-config 
```
10. Here you need to go to :
	- 3 Interface Options
	- I1 Legacy Camera
	- Yes
	- Ok
	- Finish
	- Yes reboot

The pi download the good **connect.sh** script on the share directory and reboot the first time automatycally so wait few minutes and don't worry

**Now you can duplicate this client on an another SD card for that**
You can use **win32diskimager** on windows to create a .img and write it an another SD cards.

## Install the client with image:
1. Download the **Client_img** directory
2. Open it and install Raspberry Pi Imager
3. In the same time unzip the **RPI_xx.xx.xx_2.75Go.rar**
4. Launch raspberry pi imager
5. Click on **Choose OS**
6. Go to the bottom of the list and select **Use image perso**
7. Select the **RPI_xx.xx.xx_2.75Go.img**
8. Select your SD card and click on write
9. A message say you when it is finish and you can remove your SD card
10. You need to change information in **/media/user.conf file** to work

## Use the client

1. To use your client RPI you need to start in order :
	- The NAS
	- The web server
		- test web server : https://github.com/UBO-Open-factory/Photogrammetrie/tree/ClientRPI/ProgClient/Server#use-the-web-server
		- real web server : https://github.com/UBO-Open-factory/Photogrammetrie/tree/ServeurYii
	- All your client
2. Next you can go on your web browser on the website by type the url : http://ip.of.web.server
