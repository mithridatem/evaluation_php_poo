-- Base
CREATE DATABASE IF NOT EXISTS games CHARACTER SET utf8mb4;

USE games;

CREATE TABLE IF NOT EXISTS console (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(50) NOT NULL,
    manufacturer VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS video_game (
    id INT  PRIMARY KEY AUTO_INCREMENT NOT NULL,
    title VARCHAR(50) NOT NULL,
    `type` VARCHAR(50),
    publish_at DATE NOT NULL,
    id_console INT NOT NULL,
    CONSTRAINT fk_publish_console
    FOREIGN KEY(id_console)
    REFERENCES console(id)
    ON DELETE CASCADE
);


-- Insertion des données dans les tables
INSERT INTO console (`name`, manufacturer) VALUES
('PlayStation 5', 'Sony'),
('Switch', 'Nintendo'),
('Xbox Series X', 'Microsoft'),
('Steam Deck', 'Valve');
