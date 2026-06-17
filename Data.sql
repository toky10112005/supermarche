-- Table Produit
CREATE TABLE produit (
    id_produit INTEGER PRIMARY KEY AUTOINCREMENT,
    designation TEXT NOT NULL,
    prix REAL NOT NULL,
    quantite_stock INTEGER NOT NULL
);

-- Table Caisse
CREATE TABLE caisse (
    id_caisse INTEGER PRIMARY KEY AUTOINCREMENT,
    numero_caisse TEXT NOT NULL,
    caissier TEXT
);

-- Table Achat
CREATE TABLE achat (
    id_achat INTEGER PRIMARY KEY AUTOINCREMENT,
    id_produit INTEGER NOT NULL,
    id_caisse INTEGER NOT NULL,
    quantite INTEGER NOT NULL,
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_produit) REFERENCES produit(id_produit),
    FOREIGN KEY (id_caisse) REFERENCES caisse(id_caisse)
);

-- Insertion des produits
INSERT INTO produit (designation, prix, quantite_stock) VALUES
('Riz 1kg', 3500, 100),
('Huile 1L', 8000, 50),
('Sucre 1kg', 4200, 80),
('Savon', 1500, 120),
('Lait 1L', 4500, 60);

-- Insertion des caisses
INSERT INTO caisse (numero_caisse, caissier) VALUES
('Caisse 1', 'Jean'),
('Caisse 2', 'Marie');