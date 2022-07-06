#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 06/07/22
# version ='2.1'
# ---------------------------------------------------------------------------

# Prepare the pi to execute the client correctely when he boot

#Script ---------------------------------------------------------------------
#Make PI launch the connect.sh when he boot
(sudo crontab -l 2>/dev/null; echo '@reboot sudo su pi -c "/media/connect.sh &" &') | sudo crontab -
#Add in /etc/fstab the tmpfs mount point to don't use the SD card for the watchdog logs
mkdir /home/pi/watchdogLog
echo "tmpfs /home/pi/watchdogLog tmpfs defaults,noatime,nosuid,size=32m 0 0" | sudo tee -a /etc/fstab
#copy the script in the /media directory and make them executable
sudo cp ./script/*.sh /media/
sudo chmod +x /media/*.sh
#Create log directory, file, and logrotate config
sudo mkdir /var/log/MQTT
sudo echo "make" > /var/log/MQTT/log
sudo chown pi:pi /var/log/MQTT/log
sudo cp ./config/mqttclient /etc/logrotate.d/
#make file use by the script and the proggram in local
echo "test" >  /home/pi/mac
sudo mkdir /media/data
echo "mount" | sudo tee /media/data/mount
echo "0" | sudo tee /media/boot
#Config the NTP server if you want that all PI is up to date
sudo cp ./config/timesyncd.conf /etc/systemd/
#Install and config the watchdog for client
sudo apt install watchdog -y
sudo cp ./config/watchdog.conf /etc/
sudo systemctl enable watchdog
#Install gphoto2 to control DSLR
sudo apt install gphoto2 -y
#Here open raspi-config to allow camera
sudo raspi-config
#Uncomment the line below if you want disable wifi
#sudo rfkill block wifi
# ---------------------------------------------------------------------------