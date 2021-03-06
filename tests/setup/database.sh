#!/usr/bin/env bash

# Ensure database exists
mysql -e "CREATE DATABASE IF NOT EXISTS ${MAGE2_DB_NAME};"
mysql -e "GRANT ALL PRIVILEGES ON *.* TO ${MAGE2_DB_USER}@${MAGE2_DB_HOST};"