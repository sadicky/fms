-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 08 avr. 2025 à 18:25
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fms`
--

-- --------------------------------------------------------

--
-- Structure de la table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `bank_id` int(11) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `montant` int(11) NOT NULL,
  `numero_compte` varchar(50) NOT NULL,
  `devise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_bank`
--

INSERT INTO `tbl_bank` (`bank_id`, `bank`, `montant`, `numero_compte`, `devise_id`) VALUES
(1, 'Caisse 1 en $', 90, '0000000', 1),
(2, 'Caisse 2 en FC', 832350, '0000000', 2),
(3, 'SMICO $', 45, '000001', 1),
(4, 'SMICO FC', 0, '000002', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_bank_transaction`
--

CREATE TABLE `tbl_bank_transaction` (
  `transaction_id` int(11) NOT NULL,
  `bankt` varchar(50) NOT NULL,
  `bankr` int(11) NOT NULL,
  `montant` int(11) DEFAULT NULL,
  `datet` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_bank_transaction`
--

INSERT INTO `tbl_bank_transaction` (`transaction_id`, `bankt`, `bankr`, `montant`, `datet`, `user_id`) VALUES
(1, 'Caisse 1 en $', 3, 45, '2025-03-25 12:43:15', 3);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_carburant`
--

CREATE TABLE `tbl_carburant` (
  `id_carburant` int(11) NOT NULL,
  `id_type` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `dateprix` datetime DEFAULT NULL,
  `statut` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_carburant`
--

INSERT INTO `tbl_carburant` (`id_carburant`, `id_type`, `qty`, `prix`, `dateprix`, `statut`) VALUES
(1, 1, 64841, 3400, '2024-10-28 14:57:32', '1'),
(2, 2, 39785, 3650, '2024-10-29 14:57:32', '1');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_depenses`
--

CREATE TABLE `tbl_depenses` (
  `depense_id` int(11) NOT NULL,
  `beneficiaire` varchar(100) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `motif` varchar(150) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `devise_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_depenses`
--

INSERT INTO `tbl_depenses` (`depense_id`, `beneficiaire`, `tel`, `motif`, `montant`, `devise_id`, `date`, `user_id`) VALUES
(4, 'dame melissa', '243979268522', 'trasport', 300000, 2, '2024-10-29', 5);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_devise`
--

CREATE TABLE `tbl_devise` (
  `devise_id` int(11) NOT NULL,
  `devise` varchar(200) DEFAULT NULL,
  `short` varchar(200) NOT NULL,
  `taux` varchar(200) NOT NULL,
  `statut` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_devise`
--

INSERT INTO `tbl_devise` (`devise_id`, `devise`, `short`, `taux`, `statut`) VALUES
(1, 'Dollar US', '$', '1', '1'),
(2, 'Franc Congolais', 'FC', '2800', '0');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_fournisseur`
--

CREATE TABLE `tbl_fournisseur` (
  `fournisseur_id` int(11) NOT NULL,
  `fournisseur` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `statut` varchar(20) NOT NULL,
  `representant` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_fournisseur`
--

INSERT INTO `tbl_fournisseur` (`fournisseur_id`, `fournisseur`, `tel`, `adresse`, `email`, `statut`, `representant`) VALUES
(1, 'Spaceline', '0995691247', 'Jabe', 'dsadicky@gmail.com', 'Active', 'Sadicky Dave'),
(2, 'ABC Building', '0995691247', 'Bukavu', 'abc@gmail.com', 'Active', 'Willondja');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `carburant_id` int(11) DEFAULT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `livreur` varchar(100) DEFAULT NULL,
  `matricule` varchar(100) NOT NULL,
  `prixa` int(11) NOT NULL,
  `littre` int(11) DEFAULT NULL,
  `datel` date NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `carburant_id`, `fournisseur_id`, `livreur`, `matricule`, `prixa`, `littre`, `datel`, `user_id`) VALUES
(4, 1, 1, 'Kassim', '3620159', 3000, 25000, '2024-10-29', 3),
(5, 2, 2, 'Kassim', '3620159', 3000, 40000, '2024-10-29', 3),
(6, 1, 2, 'Kassim', '3620159', 3000, 40000, '2024-10-29', 3);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_paiement`
--

CREATE TABLE `tbl_paiement` (
  `payment_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `montant` int(11) DEFAULT NULL,
  `devise_id` int(11) NOT NULL,
  `mois` varchar(20) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_pompe`
--

CREATE TABLE `tbl_pompe` (
  `pompe_id` int(11) NOT NULL,
  `pompe` varchar(100) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `statut` varchar(50) DEFAULT NULL,
  `cpt` varchar(30) DEFAULT NULL,
  `carburant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_pompe`
--

INSERT INTO `tbl_pompe` (`pompe_id`, `pompe`, `code`, `statut`, `cpt`, `carburant_id`) VALUES
(3, 'Pompe 1 - Essence', 'P1E', 'Active', '159', 1),
(4, 'Pompe 2 - Mazout', 'P2M', 'Active', '215', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_salaire`
--

CREATE TABLE `tbl_salaire` (
  `salaire_id` int(11) NOT NULL,
  `salaire` int(11) DEFAULT NULL,
  `devise_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_salaire`
--

INSERT INTO `tbl_salaire` (`salaire_id`, `salaire`, `devise_id`, `staff_id`) VALUES
(3, 150, 1, 15);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staff_id` int(11) NOT NULL,
  `noms` varchar(100) NOT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `adress` varchar(150) DEFAULT NULL,
  `role` varchar(150) DEFAULT NULL,
  `statut` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_staff`
--

INSERT INTO `tbl_staff` (`staff_id`, `noms`, `tel`, `adress`, `role`, `statut`) VALUES
(15, 'Sadiki Djuma', '61452288', 'Nyamianda', 'pompiste', '1');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_tiers`
--

CREATE TABLE `tbl_tiers` (
  `tier_id` int(11) NOT NULL,
  `tiers` varchar(100) DEFAULT NULL,
  `tel` varchar(200) DEFAULT NULL,
  `type` enum('C','F','D') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_tiers`
--

INSERT INTO `tbl_tiers` (`tier_id`, `tiers`, `tel`, `type`) VALUES
(1, 'Passager', '', NULL),
(2, 'SADICKY Dave', '+25769124727', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_types`
--

CREATE TABLE `tbl_types` (
  `id_type` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `unity` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_types`
--

INSERT INTO `tbl_types` (`id_type`, `type`, `unity`) VALUES
(1, 'Essence', 'L'),
(2, 'Mazout', 'L');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `statut` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `username`, `role`, `password`, `statut`) VALUES
(3, 'admin', 'admin', '$2y$10$8n4rDPXmmrCIgp8r/i2KaOWlVgJ9VsWHrrBeoeUuxzJGvx48s01p.', '1'),
(4, 'sadicky', 'caissier', '$2y$10$WG.DT.ISgb5m/g6oG9yR/OSMHrV4mqPDiMFp.OPaT8ERvk6gCmuHu', '1'),
(5, 'esther', 'caissier', '$2y$10$k.nnmcSYCsyytr455v6VcuI7gGCYYYSCGaERDXbBS5Ys9Wt.wYTKG', '1');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_vente`
--

CREATE TABLE `tbl_vente` (
  `vente_id` int(11) NOT NULL,
  `pompe_id` int(11) NOT NULL,
  `datev` date DEFAULT NULL,
  `tiers_id` int(11) DEFAULT NULL,
  `mtotal` varchar(40) DEFAULT NULL,
  `bindex` varchar(40) DEFAULT NULL,
  `aindex` varchar(40) DEFAULT NULL,
  `paye` float DEFAULT NULL,
  `reste` float DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `devise_id` int(11) DEFAULT NULL,
  `annuler` enum('0','1') DEFAULT NULL,
  `pompiste` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_vente`
--

INSERT INTO `tbl_vente` (`vente_id`, `pompe_id`, `datev`, `tiers_id`, `mtotal`, `bindex`, `aindex`, `paye`, `reste`, `date`, `devise_id`, `annuler`, `pompiste`) VALUES
(4, 3, '2024-10-29', 1, '340000.00', '0', '100', 300000, 40000, '2024-10-29', 2, NULL, 15),
(5, 4, '2024-10-29', 1, '547500.00', '0', '150', 547500, 0, '2024-10-29', 2, NULL, NULL),
(6, 4, '2024-10-29', 2, '237250.00', '150', '215', 237250, 0, '2024-10-29', 2, NULL, NULL),
(7, 3, '2024-10-29', 2, '135.00', '100', '145', 135, 0, '2024-10-29', 1, NULL, NULL),
(8, 3, '2024-10-29', 2, '47600.00', '145', '159', 47600, 0, '2024-10-29', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_vente_carburant`
--

CREATE TABLE `tbl_vente_carburant` (
  `vc_id` int(11) NOT NULL,
  `vente_id` int(11) DEFAULT NULL,
  `carburant_id` int(11) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `prix` varchar(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `statut` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tbl_vente_carburant`
--

INSERT INTO `tbl_vente_carburant` (`vc_id`, `vente_id`, `carburant_id`, `qty`, `prix`, `total`, `statut`) VALUES
(5, 4, 1, 100, '3400', 340000, NULL),
(6, 5, 2, 150, '3650', 547500, NULL),
(7, 6, 2, 65, '3650', 237250, NULL),
(8, 7, 1, 45, '3', 135, NULL),
(9, 8, 1, 14, '3400', 47600, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Index pour la table `tbl_bank_transaction`
--
ALTER TABLE `tbl_bank_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Index pour la table `tbl_carburant`
--
ALTER TABLE `tbl_carburant`
  ADD PRIMARY KEY (`id_carburant`);

--
-- Index pour la table `tbl_depenses`
--
ALTER TABLE `tbl_depenses`
  ADD PRIMARY KEY (`depense_id`),
  ADD KEY `devise_id` (`devise_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `tbl_devise`
--
ALTER TABLE `tbl_devise`
  ADD PRIMARY KEY (`devise_id`);

--
-- Index pour la table `tbl_fournisseur`
--
ALTER TABLE `tbl_fournisseur`
  ADD PRIMARY KEY (`fournisseur_id`);

--
-- Index pour la table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `carburant_id` (`carburant_id`),
  ADD KEY `fournisseur_id` (`fournisseur_id`,`user_id`);

--
-- Index pour la table `tbl_paiement`
--
ALTER TABLE `tbl_paiement`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `salaire_id` (`staff_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Index pour la table `tbl_pompe`
--
ALTER TABLE `tbl_pompe`
  ADD PRIMARY KEY (`pompe_id`);

--
-- Index pour la table `tbl_salaire`
--
ALTER TABLE `tbl_salaire`
  ADD PRIMARY KEY (`salaire_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Index pour la table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Index pour la table `tbl_tiers`
--
ALTER TABLE `tbl_tiers`
  ADD PRIMARY KEY (`tier_id`);

--
-- Index pour la table `tbl_types`
--
ALTER TABLE `tbl_types`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `tbl_vente`
--
ALTER TABLE `tbl_vente`
  ADD PRIMARY KEY (`vente_id`),
  ADD KEY `pompe_id` (`pompe_id`),
  ADD KEY `tiers_id` (`tiers_id`,`devise_id`,`pompiste`);

--
-- Index pour la table `tbl_vente_carburant`
--
ALTER TABLE `tbl_vente_carburant`
  ADD PRIMARY KEY (`vc_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `tbl_bank_transaction`
--
ALTER TABLE `tbl_bank_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tbl_carburant`
--
ALTER TABLE `tbl_carburant`
  MODIFY `id_carburant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `tbl_depenses`
--
ALTER TABLE `tbl_depenses`
  MODIFY `depense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tbl_devise`
--
ALTER TABLE `tbl_devise`
  MODIFY `devise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tbl_fournisseur`
--
ALTER TABLE `tbl_fournisseur`
  MODIFY `fournisseur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `tbl_paiement`
--
ALTER TABLE `tbl_paiement`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tbl_pompe`
--
ALTER TABLE `tbl_pompe`
  MODIFY `pompe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tbl_salaire`
--
ALTER TABLE `tbl_salaire`
  MODIFY `salaire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `tbl_tiers`
--
ALTER TABLE `tbl_tiers`
  MODIFY `tier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tbl_types`
--
ALTER TABLE `tbl_types`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `tbl_vente`
--
ALTER TABLE `tbl_vente`
  MODIFY `vente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `tbl_vente_carburant`
--
ALTER TABLE `tbl_vente_carburant`
  MODIFY `vc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tbl_carburant`
--
ALTER TABLE `tbl_carburant`
  ADD CONSTRAINT `tbl_carburant_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `tbl_types` (`id_type`);

--
-- Contraintes pour la table `tbl_depenses`
--
ALTER TABLE `tbl_depenses`
  ADD CONSTRAINT `tbl_depenses_ibfk_1` FOREIGN KEY (`devise_id`) REFERENCES `tbl_devise` (`devise_id`);

--
-- Contraintes pour la table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`carburant_id`) REFERENCES `tbl_carburant` (`id_carburant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tbl_pompe`
--
ALTER TABLE `tbl_pompe`
  ADD CONSTRAINT `tbl_pompe_ibfk_1` FOREIGN KEY (`carburant_id`) REFERENCES `tbl_carburant` (`id_carburant`);

--
-- Contraintes pour la table `tbl_salaire`
--
ALTER TABLE `tbl_salaire`
  ADD CONSTRAINT `tbl_salaire_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `tbl_staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
