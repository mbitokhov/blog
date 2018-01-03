#!/bin/bash

php artisan queue:work --tries 5 --delay 3600 &

$($@)
sleep infinity

