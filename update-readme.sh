#!/bin/bash

# Exit on error
set -e

# Define the stable tag
STABLE_TAG=$(grep "^Stable tag:" readme.txt | awk -F ':' '{print $2}' | tr -d '[:space:]')

# Define the source and destination paths
SOURCE_FILE="readme.txt"
TRUNK_DEST=".wordpress-org/trunk/readme.txt"
TAG_DEST=".wordpress-org/tags/$STABLE_TAG/readme.txt"

# Copy the readme.txt file to the trunk directory
echo "Copying readme.txt to trunk..."
cp "$SOURCE_FILE" "$TRUNK_DEST"

# Copy the readme.txt file to the stable tag directory
echo "Copying readme.txt to stable tag directory..."
cp "$SOURCE_FILE" "$TAG_DEST"

echo "Successfully updated readme.txt in .wordpress-org."
