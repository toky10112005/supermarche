CREATE TABLE produit (
    id_produit INTEGER PRIMARY KEY AUTOINCREMENT,
    designation TEXT NOT NULL,
    prix REAL NOT NULL,
    quantite_stock INTEGER NOT NULL
);

CREATE TABLE caisse (
    id_caisse INTEGER PRIMARY KEY AUTOINCREMENT,
    numero_caisse TEXT NOT NULL,
    caissier TEXT
);

CREATE TABLE achat (
    id_achat INTEGER PRIMARY KEY AUTOINCREMENT,
    id_produit INTEGER NOT NULL,
    id_caisse INTEGER NOT NULL,
    quantite INTEGER NOT NULL,
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
    cloture INTEGER NOT NULL DEFAULT 0,

    FOREIGN KEY (id_produit) REFERENCES produit(id_produit),
    FOREIGN KEY (id_caisse) REFERENCES caisse(id_caisse)
);

CREATE TABLE utilisateur (
    id_utilisateur INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_utilisateur TEXT NOT NULL UNIQUE,
    mot_de_passe TEXT NOT NULL
);

INSERT INTO produit (designation, prix, quantite_stock) VALUES
('Riz 1kg', 3500, 100),
('Huile 1L', 8000, 50),
('Sucre 1kg', 4200, 80),
('Savon', 1500, 120),
('Lait 1L', 4500, 60);

INSERT INTO caisse (numero_caisse, caissier) VALUES
('Caisse 1', 'Jean'),
('Caisse 2', 'Marie');

INSERT INTO utilisateur (nom_utilisateur, mot_de_passe) VALUES
('admin', 'admin'),
('caissier1', '1234');