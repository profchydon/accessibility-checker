#!/bin/bash

# Navigate to the root directory (if not already there)
cd "$(dirname "$0")"

# Remove all images associated with the project (frontend and backend)
docker rmi -f $(docker images -q backend frontend 2>/dev/null) || echo "No backend/frontend images to remove"

# Build and start the application fresh
docker-compose up --build

# Navigate to the backend directory
cd /usr/src/app/backend

# Run migrations and set application key
php artisan key:generate

php artisan config:clear
php artisan cache:clear
php artisan queue:clear
