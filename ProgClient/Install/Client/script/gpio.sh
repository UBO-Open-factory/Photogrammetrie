#----------------------------------------------------------------------------
# Created By  : Titouan Melon
# Usage       : gpio.sh <0|1>
# Created Date: 23/06/22
# version ='1.0'
# ---------------------------------------------------------------------------

# Turn on pin 23 only or pin 18 and 23

#Script ---------------------------------------------------------------------
#Turn on pin 23 (red led)
if [ $1 = 0 ]; then
        echo "23" > /sys/class/gpio/export
        echo "out" > /sys/class/gpio/gpio23/direction
        echo "1" > /sys/class/gpio/gpio23/value
fi

#Turn on pin 18 and 23 (blue and red led)
if [ $1 = 1 ]; then
        echo "23" > /sys/class/gpio/export
        echo "out" > /sys/class/gpio/gpio23/direction
        echo "1" > /sys/class/gpio/gpio23/value

        echo "18" > /sys/class/gpio/export
        echo "out" > /sys/class/gpio/gpio18/direction
        echo "1" > /sys/class/gpio/gpio18/value
fi
# ---------------------------------------------------------------------------