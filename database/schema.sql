CREATE TABLE versets (
    id INT NOT NULL AUTO_INCREMENT,
    verset TEXT,
    livre VARCHAR(64),
    date_publication DATE,
    date_creation DATE DEFAULT NOW(),
    PRIMARY KEY(id)
);

CREATE TABLE activites (
    id INT NOT NULL AUTO_INCREMENT,
    titre VARCHAR(256),
    date_activite DATE,
    contenu TEXT,
    PRIMARY KEY(id)
);

-- Les images de l'activité concerné
CREATE TABLE images (
    id INT NOT NULL AUTO_INCREMENT,
    lien VARCHAR(256),
    activites_id INT NOT NULL,
    PRIMARY KEY(id)
);


CREATE TABLE enseignements (
    id INT NOT NULL AUTO_INCREMENT,
    titre VARCHAR(256),
    date_enseignement DATE,
    description TEXT,
    -- Lien de la vidéo ou de l'audio de l'enseignement
    lien VARCHAR(256),
    predicateur VARCHAR(64),
    PRIMARY KEY(id)
);

CREATE TABLE admins (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(64),
    pseudo VARCHAR(64),
    mot_de_passe VARCHAR(128),
    PRIMARY KEY(id)
);