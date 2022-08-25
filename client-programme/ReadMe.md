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

# MESSAGE MQTT:

| Topic                         | Message            | Action                                                                                                 |
| ----------------------------- | ------------------ | ------------------------------------------------------------------------------------------------------ |
| Photo/all                     | **Directory_name** | take picture and store them in directory send in message with name  **mac_address.jpg**                |
| Photo/**mac_address**         | **what_you_want**  | take picture and store them in **Preview** directory with name **mac_address.jpg**                     |
| Reboot/all                    | **why**            | Reboot all rpi and write why in log file                                                               |
| Reboot/**mac_address**        | **why**            | Reboot rpi with the name mac_address name and write why in log file                                    |
| Shutdown/all                  | **why**            | Shutdown all rpi and write why in log file                                                             |
| Shutdown/**mac_address**      | **why**            | Shutdown rpi with the name mac_address name and write why in log file                                  |
| IsAlive/all                   | is alive           | All rpi reply by sending their name to **IsAlive** topic                                               |
| IsAlive/**mac_address**       | is alive           | Rpi with the name mac_address reply by sending their name to **IsAlive** topic and make blue led flash |
| IsAlive/**mac_address**/ok    | is alive           | Stop blue led flash                                                                                    |

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
