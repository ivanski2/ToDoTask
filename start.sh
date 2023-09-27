#!/bin/bash

# Check if directory exists and remove it
if [ -d "/home/ivanski/Desktop/Task/to-do-list/nginx/default.conf" ]; then
    rm -rf /home/ivanski/Desktop/Task/to-do-list/nginx/default.conf
fi

# Check if file doesn't exist and create it
if [ ! -f "/home/ivanski/Desktop/Task/to-do-list/nginx/default.conf" ]; then
    touch /home/ivanski/Desktop/Task/to-do-list/nginx/default.conf
    echo "server {...}" > /home/ivanski/Desktop/Task/to-do-list/nginx/default.conf # you can replace "server {...}" with actual content
fi

# The rest of your start.sh script
docker-compose up -d

#!/bin/bash
docker-compose up -d --build
