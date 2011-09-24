#!/bin/bash

# Only run this file from the project root
if [ ! -f "meshing" ]; then
	echo 'Error: must be run from the Meshing root folder'
	exit 1
fi

# Rebuild system tables on db
./meshing system:build --database --verbose

# Add new connections
./meshing connection:add --name conn_jobs_1 --adaptor pgsql --database db_jobs_1 --host localhost --user jon
./meshing connection:add --name conn_jobs_2 --adaptor pgsql --database db_jobs_2 --host localhost --user jon

# Add a schema
./meshing schema:add --name jobs --file demos/jobs.xml

# @todo Add some nodes
./meshing node:add --name node_jobs_1 --connection conn_jobs_1 --schema jobs
# ./meshing node:add --name node_jobs_2 --connection conn_jobs_2 --schema jobs

# @todo Add some trust
