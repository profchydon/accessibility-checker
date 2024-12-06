#!/bin/bash

# Navigate to the root directory (if not already there)
cd "$(dirname "$0")"

# Start Docker Compose
docker down
docker-compose up --build