#!/usr/bin/env bash

docker run --rm --volume "$PWD:/app" -w /app php:8.4.2-cli-alpine php "$@"