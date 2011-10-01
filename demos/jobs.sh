#!/bin/bash

# Set up some database details (credentials same for all dbs, for the purposes of this demo)
databaseAdaptor=pgsql
databaseUser=jon

# These dbs need to be created manually by the user
db1_name=meshing_jobs_1
db2_name=meshing_jobs_2

# Only run this file from the project root
if [ ! -f "meshing" ]; then
	echo 'Error: must be run from the Meshing root folder'
	exit 1
fi

# Remove some generated stuff
rm -rf ./database/connections/*
rm -rf ./database/schemas/*
# @todo Can't easily delete models/* as it will remove models/system/* - need to move to alt. loc.

# Rebuild system tables on db
./meshing system:build --database --verbose

# Add new connections (exit if either won't connect)
./meshing connection:add \
	--name conn_jobs_1 \
	--adaptor $databaseAdaptor --database $db1_name --host localhost --user $databaseUser \
	--test || exit 2
./meshing connection:add \
	--name conn_jobs_2 \
	--adaptor $databaseAdaptor --database $db2_name \ --host localhost --user $databaseUser \
	--test || exit 2

# Add a schema
./meshing schema:add --name jobs --file demos/jobs.xml

# Add some nodes, delete old nodes if present (or exit if either throws an exception)
./meshing node:add --name node_jobs_1 --connection conn_jobs_1 --schema jobs --force || exit 2
./meshing node:add --name node_jobs_2 --connection conn_jobs_2 --schema jobs --force || exit 2

# Add some trust (poss types are: read, write_audit, write_delay, write_full)
./meshing trust:add \
	--local-from=node_jobs_1 --local-to=node_jobs_2 --trust-type=write_full
./meshing trust:add \
	--local-from=node_jobs_2 --local-to=node_jobs_1 --trust-type=write_full

# @todo Start the nodes
#./meshing node:start --name node_jobs_1
#./meshing node:start --name node_jobs_2
