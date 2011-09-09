
-----------------------------------------------------------------------
-- p2p_connection
-----------------------------------------------------------------------

DROP TABLE "p2p_connection" CASCADE;

CREATE TABLE "p2p_connection"
(
	"id" serial NOT NULL,
	"name" VARCHAR(100) NOT NULL,
	"adaptor" VARCHAR(20) NOT NULL,
	"host" VARCHAR(100) NOT NULL,
	"user" VARCHAR(100),
	"password" VARCHAR(100),
	PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- p2p_own_node
-----------------------------------------------------------------------

DROP TABLE "p2p_own_node" CASCADE;

CREATE TABLE "p2p_own_node"
(
	"id" serial NOT NULL,
	"schema_id" INTEGER NOT NULL,
	"short_name" VARCHAR(30) NOT NULL,
	"connection_id" INTEGER NOT NULL,
	"is_enabled" BOOLEAN DEFAULT 'f' NOT NULL,
	PRIMARY KEY ("id"),
	CONSTRAINT "p2p_own_node_U_1" UNIQUE ("short_name")
);

-----------------------------------------------------------------------
-- p2p_schema
-----------------------------------------------------------------------

DROP TABLE "p2p_schema" CASCADE;

CREATE TABLE "p2p_schema"
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
-- p2p_schema_table
-----------------------------------------------------------------------

DROP TABLE "p2p_schema_table" CASCADE;

CREATE TABLE "p2p_schema_table"
(
	"id" serial NOT NULL,
	"schema_id" INTEGER NOT NULL,
	"name" VARCHAR(50) NOT NULL,
	"row_ord_current" INTEGER,
	PRIMARY KEY ("id")
);

ALTER TABLE "p2p_own_node" ADD CONSTRAINT "p2p_own_node_FK_1"
	FOREIGN KEY ("schema_id")
	REFERENCES "p2p_schema" ("id");

ALTER TABLE "p2p_own_node" ADD CONSTRAINT "p2p_own_node_FK_2"
	FOREIGN KEY ("connection_id")
	REFERENCES "p2p_connection" ("id");

ALTER TABLE "p2p_schema_table" ADD CONSTRAINT "p2p_schema_table_FK_1"
	FOREIGN KEY ("schema_id")
	REFERENCES "p2p_schema" ("id");
