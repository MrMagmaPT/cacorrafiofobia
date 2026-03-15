-- MariaDB RPG schema — STEP 2: RPG table creation
-- Run this AFTER php artisan migrate (Laravel users table must exist first)
-- Expects session variable: @DB_NAME

SET @db_name = COALESCE(@DB_NAME, 'cacorrafiofobia');

SET @sql = CONCAT('USE `', REPLACE(@db_name, '`', '``'), '`');
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- -------------------------------------------------------
-- Independent lookup tables (no FKs, create first)
-- -------------------------------------------------------

CREATE TABLE IF NOT EXISTS `races` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_races_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `classes` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_classes_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `items` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `type` ENUM('weapon', 'armor', 'consumable', 'accessory', 'material', 'quest', 'misc') NOT NULL,
    `tier` INT NOT NULL DEFAULT 1,
    `price` FLOAT NOT NULL DEFAULT 0,
    `size` FLOAT NOT NULL DEFAULT 0,
    `image` TEXT NULL,
    `name` VARCHAR(200) NOT NULL,
    `description` TEXT NULL,
    `bonus` FLOAT NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `idx_items_type` (`type`),
    KEY `idx_items_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `skills` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    `description` TEXT NULL,
    `bonus` FLOAT NOT NULL DEFAULT 0,
    `type` ENUM('active', 'passive', 'support', 'ultimate') NOT NULL DEFAULT 'active',
    `mana_cost` INT NOT NULL DEFAULT 0,
    `hp_cost` INT NOT NULL DEFAULT 0,
    `acted_on_bonus` ENUM('hp', 'mana', 'defence', 'magic', 'int', 'ma', 'uc', 'lu', 'agi', 'str') NOT NULL DEFAULT 'hp',
    PRIMARY KEY (`id`),
    KEY `idx_skills_type` (`type`),
    KEY `idx_skills_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `magic` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `lvl` INT NOT NULL DEFAULT 1,
    `mana_cost` FLOAT NOT NULL DEFAULT 0,
    `tier` INT NOT NULL DEFAULT 1,
    `name` VARCHAR(200) NOT NULL,
    `effect` TEXT NULL,
    `description` TEXT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_magic_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- player_characters — links to Laravel users.id
-- Laravel users table must already exist at this point
-- -------------------------------------------------------

CREATE TABLE IF NOT EXISTS `player_characters` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `laravel_user_id` BIGINT UNSIGNED NOT NULL,   -- FK to Laravel users.id (BIGINT UNSIGNED)
    `age` INT NULL,
    `name` VARCHAR(200) NOT NULL,
    `race_id` INT UNSIGNED NULL,
    `subrace_id` INT UNSIGNED NULL,
    `class_id` INT UNSIGNED NULL,
    `subclass_id` INT UNSIGNED NULL,
    `lvl` INT NOT NULL DEFAULT 1,
    `alignment` VARCHAR(200) NULL,
    `mana` FLOAT NOT NULL DEFAULT 0,
    `defence` FLOAT NOT NULL DEFAULT 0,
    `magic` FLOAT NOT NULL DEFAULT 0,
    `int_stat` INT NOT NULL DEFAULT 0,
    `ma` INT NOT NULL DEFAULT 0,
    `uc` INT NOT NULL DEFAULT 0,
    `lu` INT NOT NULL DEFAULT 0,
    `com` INT NOT NULL DEFAULT 0,
    `agi` INT NOT NULL DEFAULT 0,
    `str_stat` INT NOT NULL DEFAULT 0,
    `md` INT NOT NULL DEFAULT 0,
    `con` INT NOT NULL DEFAULT 0,
    `res` INT NOT NULL DEFAULT 0,
    `money` FLOAT NOT NULL DEFAULT 0,
    `hp` FLOAT NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `idx_player_characters_laravel_user_id` (`laravel_user_id`),
    KEY `idx_player_characters_race_id` (`race_id`),
    KEY `idx_player_characters_subrace_id` (`subrace_id`),
    KEY `idx_player_characters_class_id` (`class_id`),
    KEY `idx_player_characters_subclass_id` (`subclass_id`),
    CONSTRAINT `fk_player_characters_laravel_user` FOREIGN KEY (`laravel_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_player_characters_race` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk_player_characters_subrace` FOREIGN KEY (`subrace_id`) REFERENCES `races` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk_player_characters_class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk_player_characters_subclass` FOREIGN KEY (`subclass_id`) REFERENCES `classes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- Join/pivot tables (depend on player_characters and items/skills/magic)
-- -------------------------------------------------------

CREATE TABLE IF NOT EXISTS `inventory` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `item_id` INT UNSIGNED NOT NULL,
    `player_character_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_inventory_character_item` (`player_character_id`, `item_id`),
    KEY `idx_inventory_item_id` (`item_id`),
    KEY `idx_inventory_player_character_id` (`player_character_id`),
    CONSTRAINT `fk_inventory_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_inventory_player_character` FOREIGN KEY (`player_character_id`) REFERENCES `player_characters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `skills_users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `skill_id` INT UNSIGNED NOT NULL,
    `player_character_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_skills_users_skill_character` (`skill_id`, `player_character_id`),
    KEY `idx_skills_users_player_character_id` (`player_character_id`),
    CONSTRAINT `fk_skills_users_skill` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_skills_users_player_character` FOREIGN KEY (`player_character_id`) REFERENCES `player_characters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `magic_circles` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `circle_id` INT UNSIGNED NOT NULL,
    `player_character_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_magic_circles_circle_character` (`circle_id`, `player_character_id`),
    KEY `idx_magic_circles_player_character_id` (`player_character_id`),
    CONSTRAINT `fk_magic_circles_circle` FOREIGN KEY (`circle_id`) REFERENCES `magic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_magic_circles_player_character` FOREIGN KEY (`player_character_id`) REFERENCES `player_characters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

