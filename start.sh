#!/bin/bash

# Navigate to the root directory (if not already there)
cd "$(dirname "$0")"

# Navigate to the backend directory
cd /usr/src/app/backend

# Run migrations and set application key
php artisan key:generate

# Build and start the application fresh
docker-compose up --build
