-- Bergamasco Jacopo, Mandra Loris, Polo Nicolò - Mieli - 5AIA, A.S. 2024-2025

CREATE DATABASE mielidb;

USE mielidb;

CREATE TABLE Tipi_Miele (
    ID_tipo_miele INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE Localita (
    ID_localita INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    regione VARCHAR(50) NOT NULL,
    provincia VARCHAR(50) NOT NULL,
    comune VARCHAR(50) NOT NULL
);

CREATE TABLE Mieli (
    ID_miele INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descrizione TEXT,
    FK_ID_tipo_miele INT NOT NULL,
    CONSTRAINT tipo_miele FOREIGN KEY (FK_ID_tipo_miele) REFERENCES Tipi_Miele(ID_tipo_miele) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE Apicoltori (
    ID_apicoltore INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    indirizzo TEXT,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(64) NOT NULL,
    telefono VARCHAR(20)
);

CREATE TABLE Apiari (
    ID_apiario INT AUTO_INCREMENT PRIMARY KEY,
    numero_arnie INT NOT NULL,
    FK_ID_localita INT NOT NULL,
    FK_ID_apicoltore INT NOT NULL,
    FK_ID_miele INT NOT NULL,
    CONSTRAINT localita   FOREIGN KEY (FK_ID_localita)   REFERENCES Localita(ID_localita)     ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT apicoltore FOREIGN KEY (FK_ID_apicoltore) REFERENCES Apicoltori(ID_apicoltore) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT miele      FOREIGN KEY (FK_ID_miele)      REFERENCES Mieli(ID_miele)           ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Produzioni (
    anno INT NOT NULL,
    quantita INT NOT NULL,
    FK_ID_apiario INT NOT NULL,
    CONSTRAINT apiario FOREIGN KEY (FK_ID_apiario) REFERENCES Apiari(ID_apiario) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT PK_produzione PRIMARY KEY (anno, FK_ID_apiario)
);

INSERT INTO `apiari` (`ID_apiario`, `numero_arnie`, `FK_ID_localita`, `FK_ID_apicoltore`, `FK_ID_miele`) VALUES
    (1, 20, 3, 1, 1),
    (2, 1, 2, 2, 4),
    (3, 69, 1, 3, 2),
    (4, 25, 3, 4, 3);

INSERT INTO `apicoltori` (`ID_apicoltore`, `nome`, `cognome`, `indirizzo`, `email`, `password`, `telefono`) VALUES
    (1, 'Marco', 'Bortoluzzi', 'Via dei Geni, 46', 'marco.bortoluzzi.studente@itstkennedy.edu.it', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '+396744926789'),
    (2, 'Nicolò', 'Polo', 'Via Marco Polo, 69', 'nicolo.polo.studente@itstkennedy.edu.it', '1317dfa6a0c51245a1fbd37c6de9819ac469d2e5f71f70a42eec6c6181a30fa7', '+393271929197'),
    (3, 'Jacopo', 'Bergamasco', 'Via ITS, 17', 'berga@boss.com', '1d2a4dba09fdaca68c0a9ea9e379338b80cd2af523024c411abefac3995778be', '+393290351231'),
    (4, 'Gabriel', 'Mandra', 'Via Mandria, 72, Romania', 'loris.mandra.studente@itstkennedy.edu.it', 'f411425ff6bbfb58adaf823a43a95072fac4c2e2b478dc7383b8a9ae3ef97e93', '+393518005705');

INSERT INTO `localita` (`ID_localita`, `nome`, `regione`, `provincia`, `comune`) VALUES
    (1, 'Fiume Veneto', 'Friuli', 'PN', 'Fiume Veneto'),
    (2, 'Polandia', 'Polo Nord', 'Polonia', 'Polaretto'),
    (3, 'Sesto Al Reghena', 'Friuli', 'Pordenone', 'Sesto al Reghena');

INSERT INTO `mieli` (`ID_miele`, `nome`, `descrizione`, `FK_ID_tipo_miele`) VALUES
    (1, 'Millefiori', 'buono', 1),
    (2, 'Erica', 'molto buono', 2),
    (3, 'Asfodelo', 'dolce', 3),
    (4, 'Miele delle Dolomiti bellunesi', 'molto montanaro', 4);

INSERT INTO `produzioni` (`anno`, `quantita`, `FK_ID_apiario`) VALUES
    (2023, 21, 1),
    (2024, 20, 2),
    (2024, 104, 3),
    (2024, 20, 4);

INSERT INTO `tipi_miele` (`ID_tipo_miele`, `nome`) VALUES
    (1, 'Identità nazionale'),
    (2, 'Identità regionale'),
    (3, 'Identità territoriale'),
    (4, 'DOP');

GRANT INSERT, UPDATE, DELETE, SELECT ON mielidb.* TO 'mieliusr'@'%' IDENTIFIED BY 'itispolo'; 