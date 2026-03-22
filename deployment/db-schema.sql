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

CREATE DATABASE IF NOT EXISTS cacorrafiofobia
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE cacorrafiofobia;

-- race
CREATE TABLE race (
  id   INT AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(255) NOT NULL
);

-- class
CREATE TABLE class (
   id   INT AUTO_INCREMENT PRIMARY KEY,
   Name VARCHAR(255) NOT NULL
);

-- stats
CREATE TABLE stats (
   id      INT AUTO_INCREMENT PRIMARY KEY,
   mana    FLOAT,
   defence FLOAT,
   magic   FLOAT,
   Inte     INT,
   Ma      INT,
   Uc      INT,
   Lu      INT,
   Com     INT,
   Agi     INT,
   Str     INT,
   Md      INT,
   Con     INT,
   Res     INT
);

-- character_profile
CREATE TABLE character_profile (
   id          INT AUTO_INCREMENT PRIMARY KEY,
   u_age         INT,
   u_name        VARCHAR(200) NOT NULL,
   race_id     INT NOT NULL,
   SubRace_id  INT NULL,
   class_id    INT NOT NULL,
   subclass_id INT NULL,
   LVL         INT NOT NULL,
   aligment    VARCHAR(255),
   money       FLOAT,
   hp          FLOAT,
   stats_id    INT NOT NULL,

   CONSTRAINT fk_character_profile_race
       FOREIGN KEY (race_id) REFERENCES race(id),
   CONSTRAINT fk_character_profile_subrace
       FOREIGN KEY (SubRace_id) REFERENCES race(id),
   CONSTRAINT fk_character_profile_class
       FOREIGN KEY (class_id) REFERENCES class(id),
   CONSTRAINT fk_character_profile_subclass
       FOREIGN KEY (subclass_id) REFERENCES class(id),
   CONSTRAINT fk_character_profile_stats
       FOREIGN KEY (stats_id) REFERENCES stats(id)
);

-- item
CREATE TABLE item (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  user_id  INT NOT NULL,
  type     ENUM('WEAPON','ARMOR','CONSUMABLE','MISC') NOT NULL,
  Tier     INT,
  price    FLOAT,
  size     FLOAT,
  image    BLOB,              -- or VARCHAR(...) if you prefer URL
  i_name     VARCHAR(255) NOT NULL,
  i_desc     TEXT,
  bonus    FLOAT,

  CONSTRAINT fk_item_user
      FOREIGN KEY (user_id) REFERENCES character_profile(id)
);

-- skill
CREATE TABLE skill (
   id            INT AUTO_INCREMENT PRIMARY KEY,
   user_id       INT NOT NULL,
   s_name          VARCHAR(255) NOT NULL,
   s_desc          TEXT,
   bonus         FLOAT,
   s_type          ENUM('ACTIVE','PASSIVE','TRIGGERED') NOT NULL,
   mana_cost     INT,
   hp_cost       INT,
   bonus_on_stat ENUM('Int','Ma','Uc','Lu','Com','Agi','Str','Md','Con','Res'),

   CONSTRAINT fk_skill_user
       FOREIGN KEY (user_id) REFERENCES character_profile(id)
);

-- magic
CREATE TABLE magic (
   id               INT AUTO_INCREMENT PRIMARY KEY,
   user_id          INT NOT NULL,
   magiccircles_id  INT NOT NULL,
   lvl              INT,
   mana_cost        FLOAT,
   tier             INT,
   m_name             VARCHAR(255) NOT NULL,
   effect           VARCHAR(500),
   m_escription      TEXT,

   CONSTRAINT fk_magic_user
       FOREIGN KEY (user_id) REFERENCES character_profile(id)
);
