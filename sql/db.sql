CREATE DATABASE MaraFood CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE MaraFood;

CREATE TABLE users (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(50)  NOT NULL UNIQUE,
    email      VARCHAR(100) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP   
);

CREATE TABLE categories (
    id   INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO categories (name) VALUES
    ('Entrées'), ('Plats principaux'), ('Desserts'), ('Boissons');

CREATE TABLE recipes (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title        VARCHAR(150) NOT NULL,
    ingredients  TEXT NOT NULL,
    instructions TEXT NOT NULL,
    prep_time    SMALLINT UNSIGNED NOT NULL,           
    cook_time    SMALLINT UNSIGNED DEFAULT 0,
    portions     TINYINT UNSIGNED NOT NULL DEFAULT 4,  
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    user_id      INT UNSIGNED NOT NULL,
    category_id  INT UNSIGNED DEFAULT NULL,

    CONSTRAINT fk_recipe_user
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_recipe_category
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,

    INDEX idx_user_id     (user_id),
    INDEX idx_category_id (category_id)
);

-- Bonus : table favoris
CREATE TABLE favorites (
    user_id   INT UNSIGNED NOT NULL,
    recipe_id INT UNSIGNED NOT NULL,
    added_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, recipe_id),
    CONSTRAINT fk_fav_user   FOREIGN KEY (user_id)   REFERENCES users(id)   ON DELETE CASCADE,
    CONSTRAINT fk_fav_recipe FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE
);