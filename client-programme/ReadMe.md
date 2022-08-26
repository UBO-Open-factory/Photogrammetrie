# CODE ERREUR

| Red led       | Blue led      | State                                                                                           |
| ------------- | ------------- | ----------------------------------------------------------------------------------------------- |
| Off           | Off           | Rpi off or no link with the switch                                                              |
| On            | Off           | Error when mount share directory                                                                |
| Flashes       | Off           | Error whith connection to the MQTT broker                                                       |
| Flashes       | On            | The Rpi is connect and disconnect multiple times maybe two rpi have the same name               |
| On            | On            | The python programm have crashed                                                                |

# CODE LED BLUE

The blue led can flash if you send the message to do this to identificate the rpi

# MESSAGE MQTT

| Topic                         | Message            | Action                                                                                                 | Exemple 									  					    |
| ----------------------------- | ------------------ | ------------------------------------------------------------------------------------------------------ | --------------------------------------------------------------------|
| Photo/all                     | **Directory_name** | take picture and store them in directory send in message with name  **mac_address.jpg**                |-topic: Photo/all -message: 'Project_directory'                      |
| Photo/**mac_address**         | **what_you_want**  | take picture and store them in **Preview** directory with name **mac_address.jpg**                     |-topic: Photo/34-fr-34-fr-34 -message: ''                            |
| Reboot/all                    | **why**            | Reboot all rpi and write why in log file                                                               |-topic: Reboot/all -message: 'reboot_for_maintenance'                |
| Reboot/**mac_address**        | **why**            | Reboot rpi with the name mac_address name and write why in log file                                    |-topic: Reboot/34-fr-34-fr-34 -message: 'reboot_for_refresh'         |
| Shutdown/all                  | **why**            | Shutdown all rpi and write why in log file                                                             |-topic: Shutdown/all -message: 'shutdown_for_maintenance'            |
| Shutdown/**mac_address**      | **why**            | Shutdown rpi with the name mac_address name and write why in log file                                  |-topic: Shutdown/34-fr-34-fr-34 -message: 'shutdown_for_replacement' |
| IsAlive/all                   | is alive           | All rpi reply by sending their name to **IsAlive** topic                                               |-topic: IsAlive/all -message: 'is alive'                             |
| IsAlive/**mac_address**       | is alive           | Rpi with the name mac_address reply by sending their name to **IsAlive** topic and make blue led flash |-topic: IsAlive/34-fr-34-fr-34 -message: 'is alive'                  |
| IsAlive/**mac_address**/ok    | is alive           | Stop blue led flash                                                                                    |-topic: IsAlive/34-fr-34-fr-34/ok -message: 'is alive'               |

All **bold** part may be changed for write the good mac address and the good message

# PROGRAMME
| Name        | Function                                 |
|------------ | ---------------------------------------- |
|connect.sh   | Script start at the boot of rpi          |
|boot.py      | send mac_address to **Register** topic   |
|Prog.py      | Rpi client                               |
|mac.sh       | write mac_address on '/home/pi/mac' file |
|errorGPIO.py | make red led flashes                     |

# BRANCHEMENTS (sur barre le plus loin de la prise HDMI)

| Name     | Pin  |
|--------- | ---- |
| GND      | 14   |
| LED_BLUE | 12   |
| LED_RED  | 16   |

![alt text](https://www.raspberrypi-spy.co.uk/wp-content/uploads/2012/06/Raspberry-Pi-GPIO-Header-with-Photo-768x512.png)

# LAUNCH ORDER

![arbre]arbre.png
