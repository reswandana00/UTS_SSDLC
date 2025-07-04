INSERT INTO users (username, password, role, access_expires) 
VALUES (
    'admin', 
    '$2y$10$7U6VvOLRQrbZKxjeGavYjeKFmK6R8qhbHupMyM2CMAGZejUewMIq2', 
    'admin', 
    DATE_ADD(NOW(), INTERVAL 10 MINUTE)
);
-- Password: admin123
