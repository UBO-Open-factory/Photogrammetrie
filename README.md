# Photogrammetrie
This Python programme allows you to use several RaspberryPi (RPI) to take pictures of a real object.

You can use as many RPI as you want, they just have to conect them on the same wired network.

# Requirements
For this project you nead :
- As many Raspberry Pi 3+ as you want with hardware camera.
- DSLR with USB control.
- a physical structure to hold all the RPIs. So all the RPI can have a different point of view of the subject you want to scanne.
- a server (to store photos).

# Client image Disk
An image disk (.img) have been made for all your RPI. [You can found it here](./client-Install/Client_img/RPI_06.07.22_2.75Go.rar)



# Folders description

```
+---client-Install
|   +---Client
|   |   +---config
|   |   \---script
|   +---Client_img
|   +---MQTT_broker
|   \---Python-venv
+---client-programme
+---server-test
|   +---html
|   \---Script
\---structure
    +---fichiers proto
    +---files
    \---STL-for-raspberrypi
        \---images
```

## FOLDER structure
Contains the plan to build the physical structure parts.

## SUB-FOLDER : STL-for-raspberrypi
Contains all the STL files you need to build the RPI box. 

Files description can be find in file [notice de montage (FR)](./structure/STL-for-raspberrypi/notice%20de%20montage%20raspberry%20pi.pdf)

## SUB-FOLDER : files
Contains all the files you need to build the physical structure.


## FOLDER : client-install
This folder contains all the scripts needed to install:
- **Client** : The client on RPI
- **Client_img** : The last .img image disk ready to be flash with [Balena Etcher](https://www.balena.io/etcher/) or [Raspberry Pi Imager](https://www.raspberrypi.com/news/raspberry-pi-imager-imaging-utility/)

- **MQTT_brocker** : The MQTT broker on linux with mosquitto
- **python-venv** : The python virtual environment on NAS share directory

## FOLDER : client-programme
- Contains all the python programs and scripts necessary for the proper functioning of the client.


## FOLDER : server-test
- Contains the script to install a test web server on the computer containing the MQTT broker to test the proper functioning of the client.
