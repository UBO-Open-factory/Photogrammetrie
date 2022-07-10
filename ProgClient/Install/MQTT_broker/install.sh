#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Created Date: 10/07/22
# version ='3.0'
# ---------------------------------------------------------------------------

# Install the mqtt broker mosquitto and set the config for listener

#Script ---------------------------------------------------------------------
sudo apt install mosquitto mosquitto-clients -y
echo "listener 1883" | sudo tee -a /etc/mosquitto/conf.d/default.conf
echo "allow_anonymous true" | sudo tee -a /etc/mosquitto/conf.d/default.conf
sudo reboot
# ---------------------------------------------------------------------------
