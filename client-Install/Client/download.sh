mkdir Client
cd Client
wget https://github.com/UBO-Open-factory/Photogrammetrie/raw/ClientRPI/client-Install/Client/install.sh

mkdir config
cd config
wget https://github.com/UBO-Open-factory/Photogrammetrie/raw/ClientRPI/client-Install/Client/config/watchdog.conf
wget https://github.com/UBO-Open-factory/Photogrammetrie/raw/ClientRPI/client-Install/Client/config/mqttClient 
wget https://github.com/UBO-Open-factory/Photogrammetrie/raw/ClientRPI/client-Install/Client/config/timesyncd.conf
wget https://github.com/UBO-Open-factory/Photogrammetrie/raw/ClientRPI/client-Install/Client/config/user.conf
cd ..

mkdir script
cd script
wget https://github.com/UBO-Open-factory/Photogrammetrie/raw/ClientRPI/client-Install/Client/script/connect.sh
wget https://github.com/UBO-Open-factory/Photogrammetrie/raw/ClientRPI/client-Install/Client/script/gpio.sh