CREATE DATABASE IF NOT EXISTS least1 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE least1;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL
	access_expires DATETIME
);


INSERT INTO users (username, password, role, access_expires) 
VALUES (
    'admin', 
    '$2y$10$7U6VvOLRQrbZKxjeGavYjeKFmK6R8qhbHupMyM2CMAGZejUewMIq2', 
    'admin', 
    DATE_ADD(NOW(), INTERVAL 10 MINUTE)
);
-- Password: admin123
