-- SQL DDL Intro aus der Übung
-- TODO: RELATIONEN
-- Ihre Datenbank auswählen, ändern Sie den Namen entsprechend...
USE `db3166667`;

-- Tabelle löschen, falls Sie existiert
DROP TABLE IF EXISTS `Benutzer`;
DROP TABLE IF EXISTS `Bilder`;
DROP TABLE IF EXISTS  `Bestellungen`;
DROP TABLE IF EXISTS `Mahlzeiten`;
DROP TABLE IF EXISTS `Preise`;
DROP TABLE IF EXISTS `Gaeste`;
DROP TABLE IF EXISTS `FH_Angehörige`;
DROP TABLE IF EXISTS `Deklarationen`;
DROP TABLE IF EXISTS `Kategorien`;
DROP TABLE IF EXISTS `Mitarbeiter`;
DROP TABLE IF EXISTS `Studenten`;
DROP TABLE IF EXISTS `Fachbereiche`;
DROP TABLE IF EXISTS `Kommentare`;
DROP TABLE IF EXISTS `Zutaten`;




-- Empfohlen ist, zuerst die Attribute der Tabellen anzulegen und die Relationen
-- anschließend vorzunehmen. dabei werden Sie erkennen, dass nicht jede Lösch-
-- reihenfolge (DROP) funktioniert.

CREATE TABLE IF NOT EXISTS Benutzer (
	Nummer INT UNSIGNED NOT NULL UNIQUE,
	`E-Mail` VARCHAR(255) NOT NULL UNIQUE, -- Backticks wegen Minus im namen
	Bild VARBINARY(1000), -- verbessern Sie die Datentypen, wenn nötig
	Nutzername VARCHAR(50) NOT NULL UNIQUE,-- NOT NULL weil nicht optional
	AnlegeDatum DATETIME NOT NULL,
	Vorname VARCHAR(255) NOT NULL,
	Nachname VARCHAR(255) NOT NULL,
	Aktiv BOOL NOT NULL,
	`Hash` VARCHAR(60) NOT NULL,
	LetzterLogin TIMESTAMP DEFAULT 0,
	Geburtsdatum DATE,
	PRIMARY KEY (Nummer)
);

CREATE TABLE IF NOT EXISTS Bilder (
	ID INT UNSIGNED AUTO_INCREMENT NOT NULL,
	`Alt-Text` BOOL NOT NULL, -- denken Sie auch hier an Backticks
	Titel VARCHAR(255),
	Binärdaten VARBINARY(255) NOT NULL,
	PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Bestellungen (
  Nummer INT UNSIGNED NOT NULL,
  BestellZeitpunkt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL, -- Hier musste ich die reihenfolge ändern da es sonst zu problemen gekommen ist
  AbholZeitpunkt TIMESTAMP CHECK(AbholZeitpunkt > BestellZeitpunkt),
  Endpreis Double(4,2),
  PRIMARY KEY (Nummer)

);

CREATE TABLE  IF NOT EXISTS Mahlzeiten(
    ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Beschreibung VARCHAR(255) NOT NULL,
    Vorrat INT UNSIGNED NOT NULL DEFAULT 0,
    Verfuegbar BOOL DEFAULT 0,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Preise(
    Jahr YEAR NOT NULL,
    Gastpreis DOUBLE(2,2) UNSIGNED NOT NULL,
    Studentpreis DOUBLE(2,2) UNSIGNED CHECK ( Studentpreis > `MA-Preis`),
    `MA-Preis` DOUBLE(2,2) UNSIGNED
);

CREATE TABLE IF NOT EXISTS Kategorien (
    ID INT NOT NULL AUTO_INCREMENT,
    Bezeichnung VARCHAR(255) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Zutaten(
    ID INT(5) UNSIGNED NOT NULL,
    Name VARCHAR(255) NOT NULL,
    Bio BOOLEAN NOT NULL DEFAULT FALSE, -- Sinnvolle Default werte..
    Vegan BOOLEAN NOT NULL DEFAULT FALSE,
    Glutenfrei BOOLEAN NOT NULL DEFAULT FALSE,
    Vegetarisch BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Kommentare(
    ID INT UNSIGNED AUTO_INCREMENT NOT NULL,
    Bemerkung VARCHAR(255),
    Bewertung INT(2) NOT NULL CHECK(Bewertung between 0 and 10), -- TODO: Default Wert
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Studenten(
    Martikelnummer INT UNSIGNED NOT NULL UNIQUE CHECK ( Martikelnummer between 8 and 9 ),
    Studiengang VARCHAR(3) NOT NULL,
    CONSTRAINT checkstudiengang CHECK(
        studiengang = 'INF' OR
        studiengang = 'ET' OR
        studiengang = 'MCD' OR
        studiengang = 'ISE' OR
        studiengang = 'WI'
        )

);

CREATE TABLE IF NOT EXISTS  Mitarbeiter(
    Büro VARCHAR(255), -- TODO: Change
    Telefon INT UNSIGNED
);

-- FIXME: Fix this
CREATE TABLE IF NOT EXISTS FH_Angehörige(
 ID INT
);

CREATE TABLE  IF NOT EXISTS Gaeste(
    Grund VARCHAR(254) NOT NULL, -- TODO: Date 7 Days in future
    Ablaufdatum DATE
);

CREATE TABLE IF NOT EXISTS Fachbereiche(
    ID INT UNSIGNED AUTO_INCREMENT,
    Name VARCHAR(255),
    Website VARCHAR(255),
    PRIMARY KEY (ID)
);

CREATE TABLE  IF NOT EXISTS Deklarationen(
    Zeichen VARCHAR(2) CHECK (Zeichen BETWEEN 1 and 2),
    Beschriftung VARCHAR(32),
    PRIMARY KEY (Zeichen)
);
