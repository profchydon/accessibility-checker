#!/bin/bash

# Navigate to the root directory (if not already there)
cd "$(dirname "$0")"

# Stop and remove all running containers, networks, and volumes associated with the project
docker-compose down --volumes --remove-orphans

# Remove all images associated with the project (frontend and backend)
docker rmi -f $(docker images -q backend frontend 2>/dev/null) || echo "No backend/frontend images to remove"

# Build and start the application fresh
docker-compose up --build
