#!/usr/bin/env bash

cp .env.production .env
composer create-project
./vendor/bin/phpunit