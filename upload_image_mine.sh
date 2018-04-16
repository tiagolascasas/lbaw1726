#!/bin/bash

# Stop execution if a step fails
set -e

DOCKER_USERNAME=3rdvision # Replace by your docker hub username
IMAGE_NAME=lbaw

# Ensure that dependencies are available
composer install
php artisan clear-compiled
php artisan optimize

docker build -t $DOCKER_USERNAME/$IMAGE_NAME .
docker push $DOCKER_USERNAME/$IMAGE_NAME
