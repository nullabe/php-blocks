#!/usr/bin/env bash

docker exec -u $UID phpblocks_api /bin/bash -c 'cd /srv/phpblocks_api && composer dump-autoload'
docker exec -u $UID phpblocks_api /bin/bash -c 'cd /srv/phpblocks_api && php ./vendor/bin/phpunit ./tests --configuration ./tests/phpunit.xml'