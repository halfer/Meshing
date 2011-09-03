
-----------------------------------------------------------------------
-- connection
-----------------------------------------------------------------------

DROP TABLE "connection" CASCADE;

CREATE TABLE "connection"
(
	"id" serial NOT NULL,
	"host" VARCHAR(100) NOT NULL,
	"user" VARCHAR(100),
	"password" VARCHAR(100),
	PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- own_node
-----------------------------------------------------------------------

DROP TABLE "own_node" CASCADE;

CREATE TABLE "own_node"
(
	"id" serial NOT NULL,
	"schema_id" INTEGER NOT NULL,
	"short_name" VARCHAR(30) NOT NULL,
	"connection_id" INTEGER NOT NULL,
	"is_enabled" BOOLEAN DEFAULT 'f' NOT NULL,
	PRIMARY KEY ("id"),
	CONSTRAINT "own_node_U_1" UNIQUE ("short_name")
);

-----------------------------------------------------------------------
-- schema
-----------------------------------------------------------------------

DROP TABLE "schema" CASCADE;

CREATE TABLE "schema"
(
	"id" serial NOT NULL,
	"xml" TEXT NOT NULL,
	"name" VARCHAR(100) NOT NULL,
	"description" VARCHAR(255),
	"author" VARCHAR(100),
	"contact" VARCHAR(200),
	"url" VARCHAR(100),
	"date_release" DATE,
	"schema_version" FLOAT,
	"software_version" FLOAT,
	"history" TEXT,
	"installed_at" TIMESTAMP NOT NULL,
	PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- schema_table
-----------------------------------------------------------------------

DROP TABLE "schema_table" CASCADE;

CREATE TABLE "schema_table"
(
	"id" serial NOT NULL,
	"schema_id" INTEGER NOT NULL,
	"name" VARCHAR(50) NOT NULL,
	"row_ord_current" INTEGER,
	PRIMARY KEY ("id")
);

ALTER TABLE "own_node" ADD CONSTRAINT "own_node_FK_1"
	FOREIGN KEY ("schema_id")
	REFERENCES "schema" ("id");

ALTER TABLE "own_node" ADD CONSTRAINT "own_node_FK_2"
	FOREIGN KEY ("connection_id")
	REFERENCES "connection" ("id");

ALTER TABLE "schema_table" ADD CONSTRAINT "schema_table_FK_1"
	FOREIGN KEY ("schema_id")
	REFERENCES "schema" ("id");
