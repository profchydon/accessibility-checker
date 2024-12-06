#!/bin/bash

# Navigate to the root directory (if not already there)
cd "$(dirname "$0")"

# Build and start the application fresh
docker-compose up --build
