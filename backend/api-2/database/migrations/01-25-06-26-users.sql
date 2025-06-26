CREATE DATABASE IF NOT EXISTS clockwise;

CREATE USER IF NOT EXISTS 'admin_u_rw'@'%' identified by 'Loc@lhost';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE TEMPORARY TABLES, LOCK TABLES, EXECUTE ON clockwise.* to 'admin_u_rw'@'%';
