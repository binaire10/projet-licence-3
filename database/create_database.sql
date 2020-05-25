CREATE TABLE `Utilisateur` (
    `id` int NOT NULL,
    `identifiant` varchar(255) NOT NULL,
    `email` varchar(255) DEFAULT NULL,
    `hashpassword` varchar(255) DEFAULT NULL
);

ALTER TABLE `Utilisateur`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `identifiant` (`identifiant`),
    ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `Utilisateur`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
