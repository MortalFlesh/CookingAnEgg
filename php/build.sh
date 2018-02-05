#!/usr/bin/env bash
composer install --optimize-autoloader

docker pull php:7.1-cli
docker build -t cooking .
