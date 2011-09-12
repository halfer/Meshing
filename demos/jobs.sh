#!/bin/bash

# Only run this file from the project root
if [ ! -f "p2p" ]; then
	echo 'Error: must be run from the P2P root folder'
	exit 1
fi

# Rebuild system tables on db
./p2p system:build --database --verbose

# Add new connections
./p2p connection:add --name jobs_conn_1 --adaptor pgsql --database p2p_jobs --host localhost --user jon
./p2p connection:add --name jobs_conn_2 --adaptor pgsql --database p2p_jobs --host localhost --user jon

# Add a schema
./p2p schema:add --name jobs --file demos/jobs.xml

# @todo Add some nodes
# ./p2p node:add --name node_jobs_1 --connection jobs_conn_1 --schema jobs
# ./p2p node:add --name node_jobs_2 --connection jobs_conn_2 --schema jobs

# @todo Add some trust
