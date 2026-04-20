#!/usr/bin/env bash
# helper script invoked from Makefile to start docker compose with
# automatic platform/WAHA_IMAGE detection.
set -e

# load variables from .env so BUILD (and others) are available
if [ -f .env ]; then
    # shellcheck disable=SC1091
    set -o allexport
    source .env
    set +o allexport
fi

docker compose -f docker-compose.yaml down #stop

PLATFORM=$(./platform.sh)
if echo "$PLATFORM" | grep -q '^linux/arm'; then
    WAHA_IMAGE=devlikeapro/waha:arm
else
    WAHA_IMAGE=devlikeapro/waha:latest
fi

if [ "$BUILD" = true ]; then
# build & up with the env vars injected
PLATFORM="$PLATFORM" WAHA_IMAGE="$WAHA_IMAGE" \
    docker compose -f docker-compose.yaml --profile rebuild up -d
else
PLATFORM="$PLATFORM" WAHA_IMAGE="$WAHA_IMAGE" \
    docker compose -f docker-compose.yaml --profile rerun up -d #hanya perlu di start aja jika app berasal dari docker registry
fi