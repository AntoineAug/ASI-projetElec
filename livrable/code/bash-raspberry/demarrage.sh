#!/bin/bash
cd /var/www/
sudo su
sudo chromium --proxy-pac-url='http://localhost/proxy.pac' --user-data-dir='/tmp' http://localhost/P6-raspy/index.php
