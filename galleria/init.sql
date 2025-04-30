CREATE DATABASE IF NOT EXISTS galleriadb;

USE galleriadb;

CREATE TABLE IF NOT EXISTS utenti (
    ID_utente INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password_hash VARCHAR(64) NOT NULL
);

CREATE TABLE IF NOT EXISTS immagini (
    ID_immagine INT AUTO_INCREMENT PRIMARY KEY,
    FK_ID_utente INT NOT NULL,
    data_upload VARCHAR(50) NOT NULL,
    descrizione TEXT,
    CONSTRAINT utente FOREIGN KEY (FK_ID_utente) REFERENCES utenti(ID_utente) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS likes (
    FK_ID_utente INT REFERENCES utenti(ID_utente),
    FK_ID_immagine INT REFERENCES immagini(ID_immagine),
    CONSTRAINT likes PRIMARY KEY (FK_ID_utente, FK_ID_immagine)
);

GRANT INSERT, UPDATE, DELETE, SELECT ON galleriadb.* TO 'jbergamo'@'%' IDENTIFIED BY 'lozanusso';