CREATE TABLE versets (
  id SERIAL PRIMARY KEY,
  source VARCHAR(64) NOT NULL,
  verset TEXT NOT NULL,
  date_affichage DATE NOT NULL UNIQUE
);

CREATE TABLE activites (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255),
    date_evenement DATE NOT NULL,
    heure_evenement TIME NOT NULL,
    conseil TEXT
);

CREATE TABLE enseignements (
    id SERIAL PRIMARY KEY,
    type_enseignement VARCHAR(20) NOT NULL,
    titre VARCHAR(255) NOT NULL,
    pasteur VARCHAR(100) NOT NULL,
    date_enseignement DATE NOT NULL,
    image_url VARCHAR(255),
    media_url VARCHAR(255) NOT NULL
);
