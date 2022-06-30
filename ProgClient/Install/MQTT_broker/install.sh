#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 23/06/22
# version ='1.0'
# ---------------------------------------------------------------------------

# Install the mqtt broker mosquitto and set the config for listener

#Script ---------------------------------------------------------------------
sudo apt install mosquitto
echo "listener 1883" >> /etc/mosquitto/conf.d/default.conf
echo "allow_anonymous" true >> /etc/mosquitto/conf.d/default.conf
sudo reboot
# ---------------------------------------------------------------------------