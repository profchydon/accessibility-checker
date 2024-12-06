#!/bin/bash

# Navigate to the root directory (if not already there)
cd "$(dirname "$0")"

# Stop and remove containers, networks, and volumes
docker-compose down --volumes

# Remove backend and frontend images
docker rmi -f $(docker images -q backend frontend 2>/dev/null) || echo "No backend/frontend images to remove"

# Start Docker Compose with a fresh build
docker-compose up --build
