CREATE DATABASE IF NOT EXISTS projet_io2 CHARACTER SET utf8;

CREATE OR REPLACE TABLE  projet_io2.users
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    mail VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(60) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE NOT NULL
    
);

CREATE TABLE IF NOT EXISTS projet_io2.avis
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    autor_id INT NOT NULL,
    contenu TEXT NOT NULL,
    film VARCHAR(50) NOT NULL,
    signale BOOLEAN DEFAULT FALSE NOT NULL
   
);


CREATE TABLE IF NOT EXISTS projet_io2.films
(
   id INT AUTO_INCREMENT PRIMARY KEY,
   film varchar(255) NOT NULL,
   annee int(11) NOT NULL
);
