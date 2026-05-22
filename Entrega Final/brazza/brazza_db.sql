-- brazza_db.sql

CREATE DATABASE IF NOT EXISTS brazza_db;
USE brazza_db;

-- USUARIOS
CREATE TABLE users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(50)  NOT NULL UNIQUE,
    email      VARCHAR(100) NOT NULL UNIQUE,
    password   VARCHAR(100) NOT NULL,
    role       ENUM('admin','user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- CORTES
CREATE TABLE food (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    image       VARCHAR(255),
    price       DECIMAL(8,2) DEFAULT NULL,
    show_price  TINYINT(1)   DEFAULT 1,
    active      TINYINT(1)   DEFAULT 1,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- BEBIDAS
CREATE TABLE drinks (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    image       VARCHAR(255),
    price       DECIMAL(8,2) DEFAULT NULL,
    show_price  TINYINT(1)   DEFAULT 1,
    active      TINYINT(1)   DEFAULT 1,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- POSTRES
CREATE TABLE desserts (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    image       VARCHAR(255),
    price       DECIMAL(8,2) DEFAULT NULL,
    show_price  TINYINT(1)   DEFAULT 1,
    active      TINYINT(1)   DEFAULT 1,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- RESERVACIONES
CREATE TABLE reservations (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT          NOT NULL,
    name       VARCHAR(100) NOT NULL,
    guests     INT          NOT NULL,
    date       DATE         NOT NULL,
    time       TIME         NOT NULL,
    notes      TEXT,
    status     ENUM('pending','confirmed','cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- RESEÑAS
CREATE TABLE reviews (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT          NOT NULL,
    author_name VARCHAR(100) NOT NULL,
    visit_date  DATE         NOT NULL,
    comment     TEXT         NOT NULL,
    stars       TINYINT      NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- DATOS INICIALES

-- Usuario admin por defecto  (password: admin123)
INSERT INTO users (username, email, password, role)
VALUES ('admin', 'admin@brazza.com', 'admin123', 'admin');

-- Cortes de ejemplo
INSERT INTO food (name, description, price, show_price, active) VALUES
('Picanha',       'Corte estrella de la churrascaria brasileña', 250.00, 1, 1),
('Fraldinha',     'Suave y jugosa, sal gruesa',                  220.00, 1, 1),
('Costillas BBQ', 'Marinadas 24 hrs, ahumadas en leña',          280.00, 1, 1),
('Maminha',       'Tierna falda al punto perfecto',              210.00, 1, 1);

-- Bebidas de ejemplo
INSERT INTO drinks (name, description, price, show_price, active) VALUES
('Caipirinha',       'Cóctel brasileño con cachaça y limón', 120.00, 1, 1),
('Agua Mineral',     'Agua mineral fría 600 ml',              40.00, 1, 1),
('Cerveza Artesanal','Cerveza artesanal local 355 ml',         90.00, 1, 1);

-- Postres de ejemplo
INSERT INTO desserts (name, description, price, show_price, active) VALUES
('Pudim',      'Postre brasileño de leche condensada', 80.00, 1, 1),
('Brigadeiro', 'Dulce brasileño de chocolate',         60.00, 1, 1);
