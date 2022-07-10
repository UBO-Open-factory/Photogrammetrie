#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 10/07/22
# version ='3.0'
# ---------------------------------------------------------------------------

# Install and configure web server for test

#Script ---------------------------------------------------------------------
#Install AMP : apache2/mariadb/PHP
sudo apt update
sudo apt install apache2 -y
sudo apt install php -y
sudo service apache2 restart
sudo apt install mariadb-server php-mysql -y
sudo service apache2 restart
#Create db and user in mariadb
user="your_username"
pass="your_password"
sudo mariadb -u root -proot -Bse "create user '$user'@localhost identified by '$pass';use mysql;create table mysql.mac(address char(20), alive int);grant all privileges on mysql.* to '$user'@localhost;FLUSH PRIVILEGES;"
#install phpmyadmin
sudo apt install phpmyadmin -y
sudo phpenmod mysqli
sudo service apache2 restart

#Copy the website in web folder
sudo rm /var/www/html/*
sudo cp ./html/* /var/www/html

#Copy script and make them executable
sudo cp ./Script/*.sh /home/pi
sudo chmod +x /home/pi/*.sh

#Create link with Preview folder into web folder
sudo ln -s /media/data/Preview /var/www/html/Preview

#Install python lib for server script
sudo apt install python3-pip
sudo pip install paho-mqtt mysql-connector-python
sudo cp ./server.py /home/pi/

#Add the start script in crontab
(sudo crontab -l 2>/dev/null; echo '@reboot sudo su pi -c "/home/pi/mount.sh &" &') | sudo crontab -
sudo reboot