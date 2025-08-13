-- Création de la base
CREATE DATABASE IF NOT EXISTS event_platform;
USE event_platform;

-- Création de la table des participants
CREATE TABLE IF NOT EXISTS participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100),
    telephone VARCHAR(20),
    evenement VARCHAR(100),
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Données de test
INSERT INTO participants (nom, email, telephone, evenement) VALUES
('maryemzahmoul', 'maryem@example.com', '22222222', 'Conférence IA'),
('ameniamri', 'ameni@example.com', '12345678', 'Atelier DevOps');
