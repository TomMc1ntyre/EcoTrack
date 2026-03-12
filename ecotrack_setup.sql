-- EcoTrack Database Setup
-- Run this in phpMyAdmin

CREATE DATABASE IF NOT EXISTS ecotrack;
USE ecotrack;

-- Users table (Laravel default + role)
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    points INT DEFAULT 10,
    icon VARCHAR(50) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Logs table
CREATE TABLE IF NOT EXISTS logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    category_id BIGINT UNSIGNED NOT NULL,
    description VARCHAR(255) NULL,
    points_earned INT DEFAULT 0,
    logged_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Goals table
CREATE TABLE IF NOT EXISTS goals (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    target_count INT DEFAULT 1,
    current_count INT DEFAULT 0,
    status ENUM('active', 'completed', 'cancelled') DEFAULT 'active',
    deadline DATE NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Score history table
CREATE TABLE IF NOT EXISTS score_history (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    points INT DEFAULT 0,
    description VARCHAR(255) NULL,
    type ENUM('earned', 'deducted') DEFAULT 'earned',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert default categories
INSERT INTO categories (name, description, points, icon, created_at, updated_at) VALUES
('Recycled', 'Recycled materials properly', 10, '♻️', NOW(), NOW()),
('Composted', 'Composted organic waste', 15, '🌱', NOW(), NOW()),
('Reduced Plastic', 'Avoided single-use plastic', 10, '🚫', NOW(), NOW()),
('Used Reusable Bag', 'Used a reusable bag', 5, '🛍️', NOW(), NOW()),
('Public Transport', 'Used public transportation', 10, '🚌', NOW(), NOW()),
('Walked/Biked', 'Walked or biked instead of driving', 10, '🚶', NOW(), NOW()),
('Saved Energy', 'Turned off lights/appliances', 5, '💡', NOW(), NOW()),
('Water Conservation', 'Saved water', 5, '💧', NOW(), NOW());
