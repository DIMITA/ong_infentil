-- Run once when the PostgreSQL volume is first created.
-- The database and user are already created via env vars in docker-compose;
-- this script adds useful extensions.

CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
CREATE EXTENSION IF NOT EXISTS "unaccent";
CREATE EXTENSION IF NOT EXISTS "pg_trgm";
