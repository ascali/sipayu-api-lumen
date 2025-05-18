#!/bin/bash

# Start Nginx
service nginx start

# Start PM2
pm2 start --no-daemon artisan --interpreter php --name lumen-app -- queue:work