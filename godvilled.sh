#!/bin/sh

echo
echo "initialize service..."
echo
echo "checking remoute server..."
if ping -c 1 godville.net | grep "Unknown host" > /dev/null
then
  echo "error: host is not reachable"
  exit 0
else
  echo "server is online..."
fi

echo "starting daemon..."
while :
do
  php service.php
  sleep 30
done
