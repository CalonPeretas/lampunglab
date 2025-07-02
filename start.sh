#!/bin/bash

# Jalankan migration jika perlu
php artisan migrate --force

# Jalankan Laravel server
php artisan serve --host=0.0.0.0 --port=8080
