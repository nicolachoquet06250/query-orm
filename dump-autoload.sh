#!/usr/bin/env bash

docker run --rm --volume "$PWD:/app" composer/composer dump-autoload