CREATE TABLE mailing_verzendtaken (
    mailing_id INT NOT NULL PRIMARY KEY,
    status VARCHAR(16) NOT NULL,
    volgende_poging DATETIME NOT NULL,
    laatste_fout TEXT NULL,
    bezig_adres INT NULL
) ENGINE=InnoDB;

CREATE TABLE mailing_verzendklok (
    id INT NOT NULL PRIMARY KEY,
    volgende_blok DATETIME NOT NULL
) ENGINE=InnoDB;

INSERT INTO mailing_verzendklok (id, volgende_blok) VALUES (1, '2000-01-01 00:00:00');
