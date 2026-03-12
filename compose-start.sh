#!/usr/bin/env bash
# helper script invoked from Makefile to start docker compose with
# automatic platform/WAHA_IMAGE detection.
set -e

docker compose -f docker-compose.yaml down

PLATFORM=$(./platform.sh)
if echo "$PLATFORM" | grep -q '^linux/arm'; then
    WAHA_IMAGE=devlikeapro/waha:arm
else
    WAHA_IMAGE=devlikeapro/waha:latest
fi

# build & up with the env vars injected
PLATFORM="$PLATFORM" WAHA_IMAGE="$WAHA_IMAGE" \
    docker compose -f docker-compose.yaml build app
PLATFORM="$PLATFORM" WAHA_IMAGE="$WAHA_IMAGE" \
    docker compose -f docker-compose.yaml up -d
