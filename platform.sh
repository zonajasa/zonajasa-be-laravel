#!/usr/bin/env bash
# detect the host architecture and echo a Docker platform string
# usage: PLATFORM=$(./scripts/platform.sh)
# returns linux/amd64, linux/arm64, linux/arm/v7, etc.

arch=$(uname -m)
case "$arch" in
  x86_64|amd64)
    echo "linux/amd64" ;;
  aarch64|arm64)
    echo "linux/arm64" ;;
  armv7l|armv7)
    echo "linux/arm/v7" ;;
  i386|i686)
    echo "linux/386" ;;
  *)
    # fallback to amd64 if unknown
    echo "linux/amd64" ;;
esac
