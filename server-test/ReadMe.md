# Install the test web server

1. Download the Server directory
2. Go in
```
cd path/of/Server/directory
```
3. Set good information about database : ip, username, password in php file
```
sudo nano ./html/db.php
sudo nano ./html/index.php
sudo nano ./html/mqtt.php
sudo nano ./html/preview.php
```
4. Set good information about database : username, password in **install.sh** script
```
sudo nano ./install.sh
```
5. Set good information about nas ip and share directories, MQTT broker ip and databse ip, username and password in **mount.sh** script
```
sudo nano ./Script/mount.sh
```
6. Set good information about MQTT broker ip **mqtt.sh** script
```
sudo nano ./Script/mqtt.sh
```
7. Make script executable and execute
```
sudo chmod +x ./install.sh
sudo sed -i 's/\r$//' install.sh
./install.sh
```
8. Select Apache2 when prompted and press the Enter key
9. Configure database for phpmyadmin with dbconfig-common? Yes
10. Type your password and press OK
11. When the script is complete the computer reboot

# Use the web server

1. Turn on the server, when it's done turn on the RPI.
2. On a web browser on a computer connect to the same network as the server type the ip address in the navigation bar
3. On the page you see all connect RPI and button to send order to RPI
