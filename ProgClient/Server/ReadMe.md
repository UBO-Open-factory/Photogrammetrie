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
5. Set good information about nas ip and share directories in **mount.sh** script
```
sudo nano ./Script/mount.sh
```
6. Set good information about MQTT broker ip **mqtt.sh** script
```
sudo nano ./Script/mqtt.sh
```
7. Set good information about MQTT broker ip and databse ip, username and password in **server.py**
```
sudo nano ./server.py
```
8. Make script executable and execute
```
sudo chmod +x ./install.sh
sudo sed -i 's/\r$//' install.sh
./install.sh
```
9. Select Apache2 when prompted and press the Enter key
10. Configure database for phpmyadmin with dbconfig-common? Yes
11. Type your password and press OK
12. When the script is complete the computer reboot