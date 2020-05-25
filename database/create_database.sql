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
