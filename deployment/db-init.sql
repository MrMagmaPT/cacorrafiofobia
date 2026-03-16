-- MariaDB bootstrap for Laravel app — STEP 1: DB & user creation only
-- Run this BEFORE php artisan migrate
-- Expects session variables: @DB_NAME, @DB_USER, @DB_PASS
-- RPG table schema is in db-schema.sql — run that AFTER migrations

SET @db_name = COALESCE(@DB_NAME, 'cacorrafiofobia');
SET @db_user = COALESCE(@DB_USER, 'cacorrafiofobia_user');
SET @db_pass = COALESCE(@DB_PASS, 'carro123');

SET @sql = CONCAT(
    'CREATE DATABASE IF NOT EXISTS `',
    REPLACE(@db_name, '`', '``'),
    '` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = CONCAT(
    "CREATE USER IF NOT EXISTS '",
    REPLACE(@db_user, "'", "''"),
    "'@'localhost' IDENTIFIED BY '",
    REPLACE(@db_pass, "'", "''"),
    "'"
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = CONCAT(
    "GRANT ALL PRIVILEGES ON `",
    REPLACE(@db_name, '`', '``'),
    "`.* TO '",
    REPLACE(@db_user, "'", "''"),
    "'@'localhost'"
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

FLUSH PRIVILEGES;

