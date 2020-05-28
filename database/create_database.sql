CREATE TABLE `Utilisateur` (
                               `id` int NOT NULL AUTO_INCREMENT,
                               `identifiant` varchar(255) NOT NULL,
                               `email` varchar(255) DEFAULT NULL,
                               `hashpassword` varchar(255) DEFAULT NULL,
                               PRIMARY KEY (`id`),
                               UNIQUE (`identifiant`),
                               UNIQUE (`email`)
);

CREATE TABLE `Token` (
                         `token` VARCHAR(32) NOT NULL,
                         `service` int,
                         `id_user` int NOT NULL,
                         PRIMARY KEY(`token`, `service`),
                         UNIQUE (`id_user`),
                         FOREIGN KEY (`id_user`) REFERENCES `Utilisateur`(`id`)
);

CREATE TABLE `Adherent` (
                            `id` int NOT NULL,
                            `nom` VARCHAR(255) NOT NULL,
                            `adresse` VARCHAR(255) NOT NULL,
                            `date_cotisation` DATE,
                            PRIMARY KEY(`id`),
                            FOREIGN KEY (`id`) REFERENCES `Utilisateur`(`id`)
);

CREATE TABLE `Bibliothecaire` (
                                  `id` int NOT NULL ,
                                  `nom` VARCHAR(255) NOT NULL,
                                  PRIMARY KEY(`id`),
                                  FOREIGN KEY (`id`) REFERENCES `Utilisateur`(`id`)
);

CREATE TABLE `Livre` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `cote` VARCHAR(255) NOT NULL,
                         `titre` VARCHAR(255) NOT NULL,
                         `resumer` TEXT NOT NULL,
                         `image_type` VARCHAR(255) NOT NULL,
                         `image` BLOB NOT NULL,
                         `format` VARCHAR(255) NOT NULL,
                         PRIMARY KEY(`id`)
);

CREATE TABLE `Exemplaire` (
                              `id` int NOT NULL,
                              `id_livre` int NOT NULL,
                              `date_achat` DATE NOT NULL,
                              PRIMARY KEY(`id`, `id_livre`),
                              FOREIGN KEY (`id_livre`) REFERENCES `Livre`(`id`)
);

CREATE TABLE `HistoriqueEmprunt` (
                                     `id` int NOT NULL AUTO_INCREMENT,
                                     `id_exemplaire` int NOT NULL,
                                     `id_livre` int NOT NULL,
                                     `id_user` int NOT NULL,
                                     `date_debut` int NOT NULL,
                                     `date_retour` int NOT NULL,
                                     PRIMARY KEY(`id`),
                                     FOREIGN KEY (`id_exemplaire`, `id_livre`) REFERENCES `Exemplaire`(`id`, `id_livre`),
                                     FOREIGN KEY (`id_user`) REFERENCES `Utilisateur`(`id`)
);

CREATE TABLE `EmpruntCourant` (
                                  `id` int NOT NULL AUTO_INCREMENT,
                                  `id_exemplaire` int NOT NULL,
                                  `id_livre` int NOT NULL,
                                  `id_emprunt` int NOT NULL,
                                  `id_user` int NOT NULL,
                                  `date_debut` int NOT NULL,
                                  PRIMARY KEY(`id`),
                                  FOREIGN KEY (`id_emprunt`) REFERENCES `HistoriqueEmprunt`(`id`),
                                  FOREIGN KEY (`id_exemplaire`, `id_livre`) REFERENCES `Exemplaire`(`id`, `id_livre`),
                                  FOREIGN KEY (`id_user`) REFERENCES `Utilisateur`(`id`)
);

CREATE TABLE `Lecture` (
                           `id_user` int NOT NULL,
                           `id_livre` int NOT NULL,
                           `commentaire` VARCHAR(255),
                           `status` VARCHAR(100),
                           PRIMARY KEY (`id_user`, `id_livre`),
                           FOREIGN KEY (`id_user`) REFERENCES `Utilisateur`(`id`),
                           FOREIGN KEY (`id_livre`) REFERENCES `Livre`(`id`)
);

CREATE TABLE `Auteur` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `nom` VARCHAR(255) NOT NULL,
                          PRIMARY KEY (`id`)
);

CREATE TABLE `A_ECRIT` (
                          `id_auteur` int NOT NULL,
                          `id_livre` int NOT NULL,
                          PRIMARY KEY (`id_auteur`, `id_livre`),
                          FOREIGN KEY (`id_auteur`) REFERENCES `Auteur`(`id`),
                          FOREIGN KEY (`id_livre`) REFERENCES `Livre`(`id`)
);