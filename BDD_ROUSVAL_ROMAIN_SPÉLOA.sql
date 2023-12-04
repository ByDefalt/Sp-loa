-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2023 at 08:52 AM
-- Server version: 10.5.12-MariaDB-0+deb11u1
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zfl2-zrousvaro_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_animation_ani`
--

CREATE TABLE `t_animation_ani` (
  `pad_id` int(10) NOT NULL,
  `cpt_pseudo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_animation_ani`
--

INSERT INTO `t_animation_ani` (`pad_id`, `cpt_pseudo`) VALUES
(1, 'elijah@spéloa.com'),
(1, 'Finn@spéloa.com'),
(1, 'klaus@spéloa.com'),
(1, 'rebeca@spéloa.com'),
(2, 'demon@spéloa.com'),
(2, 'rebeca@spéloa.com'),
(2, 'stefan@spéloa.com'),
(3, 'Finn@spéloa.com'),
(3, 'klaus@spéloa.com');

-- --------------------------------------------------------

--
-- Table structure for table `t_atelier_atl`
--

CREATE TABLE `t_atelier_atl` (
  `atl_numero` int(10) NOT NULL,
  `atl_intitule` varchar(100) NOT NULL,
  `atl_date` datetime DEFAULT NULL,
  `atl_texte` varchar(512) NOT NULL,
  `atl_etat` char(1) NOT NULL,
  `pad_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_atelier_atl`
--

INSERT INTO `t_atelier_atl` (`atl_numero`, `atl_intitule`, `atl_date`, `atl_texte`, `atl_etat`, `pad_id`) VALUES
(1, 'atelier n°1', '2023-02-14 00:00:00', 'L\'atelier de spéléologie est une expérience incroyablement enrichissante et éducative. Les participants en apprennent davantage sur la géologie et la formation des roches, ainsi que sur la faune et la flore qui habitent les grottes. De plus, ils apprennent à travailler en équipe et à faire confiance à leurs équipiers pour naviguer en toute sécurité dans les passages étroits et les grottes sombres.', 'C', 1),
(2, 'atelier n°2', '2023-02-14 00:00:00', 'Introduction à la spéléologie : Découvrez les équipements de base et les techniques de progression en milieu souterrain.', 'C', 1),
(3, 'atelier n°3', '2023-02-14 00:00:00', 'Topographie en spéléologie : Apprenez à lire et à utiliser les plans des cavités pour explorer de nouvelles grottes.', 'P', 1),
(4, 'atelier n°4', '2023-02-14 00:00:00', 'Sécurité en spéléologie : Comprendre les risques liés à l\'exploration souterraine et les mesures de prévention à prendre pour éviter les accidents.', 'C', 2),
(5, 'atelier n°5', '2023-02-14 00:00:00', 'Escalade en spéléologie : Maîtriser les techniques de progression sur parois rocheuses pour atteindre des zones inaccessibles.', 'C', 2),
(6, 'atelier n°6', '2023-02-14 00:00:00', 'Exploration en spéléologie : Découvrir de nouveaux passages, observer les formations géologiques et étudier la biodiversité souterraine.', 'P', 2),
(7, 'atelier n°7', '2023-02-14 00:00:00', 'La biologie en spéléologie : Étudier les espèces cavernicoles et leur adaptation à l\'environnement souterrain.', 'C', 3),
(8, 'atelier n°8', '2023-02-14 00:00:00', 'La géologie en spéléologie : Comprendre la formation des cavités et l\'origine des roches dans lesquelles elles se développent.', 'C', 3),
(9, 'atelier n°9', '2023-02-14 00:00:00', 'La photographie en spéléologie : Apprendre à utiliser l\'éclairage et les angles pour réaliser des photos spectaculaires dans les environnements les plus extrêmes.', 'P', 3);

-- --------------------------------------------------------

--
-- Table structure for table `t_compte_cpt`
--

CREATE TABLE `t_compte_cpt` (
  `cpt_pseudo` varchar(60) NOT NULL,
  `cpt_mot_de_passe` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_compte_cpt`
--

INSERT INTO `t_compte_cpt` (`cpt_pseudo`, `cpt_mot_de_passe`) VALUES
('contact.responsable@spéloa.fr', '3752030ab2c64dd9973ede8d30b39a7c'),
('dean@spéloa.com', '65df8e02aa88a24e7b791b20e29214eb'),
('demon@spéloa.com', 'd8c6df7162b3349fe24566a955c0328c'),
('elijah@spéloa.com', 'e839afdb34e32431f788d607e449912e'),
('Finn@spéloa.com', '990bb95861e58dea5988257a653ba547'),
('klaus@spéloa.com', '8cee7ed33074c1ce70b5315605e03ffb'),
('rebeca@spéloa.com', '107b4c3a09e59b6e014af9722bfa2953'),
('sam@spéloa.com', '1c21c3818ef231c9626032d7948d5991'),
('stefan@spéloa.com', '9cdfb439c7876e703e307864c9167a15'),
('test@test.test', '098f6bcd4621d373cade4e832627b4f6'),
('tristian@spéloa.com', '9f27410725ab8cc8854a2769c7a516b8'),
('vm477@speloa.com', '9cdfb439c7876e703e307864c9167a15');

-- --------------------------------------------------------

--
-- Table structure for table `t_configuration_cfg`
--

CREATE TABLE `t_configuration_cfg` (
  `cfg_nom` varchar(100) NOT NULL,
  `cfg_description` varchar(512) NOT NULL,
  `cfg_mot_du_president` varchar(512) NOT NULL,
  `cfg_numero` int(10) NOT NULL,
  `cfg_adresse_email` varchar(512) NOT NULL,
  `cfg_adress_postale` varchar(150) NOT NULL,
  `cfg_numero_telephone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_configuration_cfg`
--

INSERT INTO `t_configuration_cfg` (`cfg_nom`, `cfg_description`, `cfg_mot_du_president`, `cfg_numero`, `cfg_adresse_email`, `cfg_adress_postale`, `cfg_numero_telephone`) VALUES
('Spéloa', 'spéléologie', 'Chers membres de l\'association de spéléologie,\n\nJe suis honoré de m\'adresser à vous en tant que président de notre association de spéléologie. Nous sommes une communauté de passionnés de la spéléologie, qui partagent une fascination pour l\'exploration des grottes et des cavités souterraines.', 1, 'Spéloa@spéloa.com', '18 downing street', 296784512);

-- --------------------------------------------------------

--
-- Table structure for table `t_news_new`
--

CREATE TABLE `t_news_new` (
  `new_numero` int(10) NOT NULL,
  `new_titre` varchar(60) NOT NULL,
  `new_texte` varchar(512) NOT NULL,
  `new_datePublication` datetime DEFAULT NULL,
  `new_etat` char(1) NOT NULL,
  `cpt_pseudo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_news_new`
--

INSERT INTO `t_news_new` (`new_numero`, `new_titre`, `new_texte`, `new_datePublication`, `new_etat`, `cpt_pseudo`) VALUES
(1, 'La plus grosse stalagmite de france', 'elle mesure 30m', '2023-04-12 00:00:00', 'C', 'klaus@spéloa.com'),
(2, 'découverte d\'un corp', 'le corp d\'une femme de 40 ans decouvert dans la grotte de lascaux', '2023-01-12 00:00:00', 'P', 'rebeca@spéloa.com'),
(3, 'découverte d\'une nouvelle grotte', 'la grotte ferait une longeur de 5km et irait jusqu\'a 5000m en dessous du niveaux de la mer', '2023-01-12 00:00:00', 'C', 'elijah@spéloa.com'),
(4, 'nouvelle peinture préhistorique!!!', 'la découverte de nouvelle peinture préhistorique dans le nouvelle embranchement de la grotte du rocamadour', '2023-04-12 12:19:14', 'P', 'stefan@spéloa.com');

-- --------------------------------------------------------

--
-- Table structure for table `t_pad_pad`
--

CREATE TABLE `t_pad_pad` (
  `pad_id` int(10) NOT NULL,
  `pad_code` char(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pad_intitule` varchar(100) NOT NULL,
  `pad_date_creation` datetime DEFAULT NULL,
  `pad_description` varchar(512) NOT NULL,
  `pad_image` varchar(512) NOT NULL,
  `pad_etat` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pad_pad`
--

INSERT INTO `t_pad_pad` (`pad_id`, `pad_code`, `pad_intitule`, `pad_date_creation`, `pad_description`, `pad_image`, `pad_etat`) VALUES
(1, 'ajod45iu91ey81f', 'Spéléo', '2023-03-02 18:13:58', 'Fait pour les amoureux de la spéléologie', '/data/img0.jpg', 'P'),
(2, 'aj7d45iu95ey81f', 'pad2', '2023-02-14 00:00:00', 'description2', '/data/img1.jpg', 'P'),
(3, 'ajod45iu978e81f', 'pad3', '2023-02-14 00:00:00', 'description3', '/data/img2.jpg', 'C'),
(4, 'qsdu7t9e2c5f87h', 'pad4', '2023-03-02 17:12:07', 'description4', '/data/img3.jpg', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `t_profil_pfl`
--

CREATE TABLE `t_profil_pfl` (
  `pfl_nom` varchar(60) NOT NULL,
  `pfl_prenom` varchar(60) NOT NULL,
  `pfl_role` char(1) NOT NULL,
  `pfl_validite` char(1) NOT NULL,
  `pfl_date` datetime NOT NULL,
  `cpt_pseudo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_profil_pfl`
--

INSERT INTO `t_profil_pfl` (`pfl_nom`, `pfl_prenom`, `pfl_role`, `pfl_validite`, `pfl_date`, `cpt_pseudo`) VALUES
('mikaelson', 'klaus', 'R', 'A', '2023-01-12 00:00:00', 'klaus@spéloa.com'),
('mikaelson', 'rebeca', 'A', 'A', '2023-01-12 00:00:00', 'rebeca@spéloa.com'),
('mikaelson', 'finn', 'A', 'A', '2023-01-12 00:00:00', 'finn@spéloa.com'),
('mikaelson', 'elijah', 'R', 'A', '2023-01-12 00:00:00', 'elijah@spéloa.com'),
('winchester', 'sam', 'A', 'A', '2023-01-12 00:00:00', 'sam@spéloa.com'),
('winchester', 'dean', 'A', 'A', '2023-01-12 00:00:00', 'dean@spéloa.com'),
('salvatore', 'demon', 'R', 'A', '2023-01-12 00:00:00', 'demon@spéloa.com'),
('salvatore', 'stefan', 'R', 'A', '2023-01-12 00:00:00', 'stefan@spéloa.com'),
('Zeke', 'Tristan', 'A', 'D', '2023-03-01 17:15:15', 'tristian@spéloa.com'),
('test', 'test', 'R', 'A', '2023-04-12 18:12:02', 'test@test.test'),
('contact', 'contact', 'R', 'A', '2023-04-12 22:47:03', 'contact.responsable@spéloa.fr'),
('o\\\'bradie', 'vm477', 'A', 'A', '2023-04-13 08:41:48', 'vm477@speloa.com');

-- --------------------------------------------------------

--
-- Table structure for table `t_ressource_res`
--

CREATE TABLE `t_ressource_res` (
  `res_numero` int(10) NOT NULL,
  `res_titre` varchar(100) NOT NULL,
  `res_descriptif` varchar(512) DEFAULT NULL,
  `res_type_ressource` tinyint(1) NOT NULL,
  `res_chemin_acces` varchar(150) NOT NULL,
  `atl_numero` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_ressource_res`
--

INSERT INTO `t_ressource_res` (`res_numero`, `res_titre`, `res_descriptif`, `res_type_ressource`, `res_chemin_acces`, `atl_numero`) VALUES
(1, 'image0', 'image présentation n°0', 0, '/data/img0.jpg', 1),
(2, 'image1', 'image présentation n°1', 0, '/data/img1.jpg', 1),
(3, 'doc n°0', 'doc materiel spéléologie', 1, '/data/doc0.pdf', 1),
(4, 'lien0', 'lien n°0', 2, 'https://fr.wikipedia.org/wiki/Sp%C3%A9l%C3%A9ologie', 2),
(5, 'image2', 'image présentation n°2', 0, '/data/img2.jpg', 2),
(6, 'image3', 'image présentation n°3', 0, '/data/img3.jpg', 2),
(7, 'image4', 'image présentation n°4', 0, '/data/img4.jpg', 3),
(8, 'lien1', 'lien n°1', 2, 'https://ffspeleo.fr/', 3),
(9, 'lien2', 'lien n°2', 2, 'https://www.croque-montagne.fr/112-speleologie-speleo-caving-speleologia-espeleologia', 3),
(10, 'doc1', 'doc n°1', 1, '/data/doc1.pdf', 4),
(11, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 4),
(12, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 4),
(13, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 5),
(14, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 5),
(15, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 5),
(16, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 6),
(17, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 6),
(18, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 6),
(19, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 7),
(20, 'image 40', 'cest une image', 0, 'data/img40.jpg', 7),
(21, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 7),
(22, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 8),
(23, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 8),
(24, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 8),
(25, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 9),
(26, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 9),
(27, 'imagepres0', 'image présentation n°0', 0, '/img/imagepres0.jpg', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_animation_ani`
--
ALTER TABLE `t_animation_ani`
  ADD PRIMARY KEY (`pad_id`,`cpt_pseudo`),
  ADD KEY `fk_t_animation_ani_t_compte_cpt` (`cpt_pseudo`);

--
-- Indexes for table `t_atelier_atl`
--
ALTER TABLE `t_atelier_atl`
  ADD PRIMARY KEY (`atl_numero`),
  ADD KEY `fk_t_atelier_atl_t_pad_pad` (`pad_id`);

--
-- Indexes for table `t_compte_cpt`
--
ALTER TABLE `t_compte_cpt`
  ADD PRIMARY KEY (`cpt_pseudo`);

--
-- Indexes for table `t_configuration_cfg`
--
ALTER TABLE `t_configuration_cfg`
  ADD PRIMARY KEY (`cfg_numero`);

--
-- Indexes for table `t_news_new`
--
ALTER TABLE `t_news_new`
  ADD PRIMARY KEY (`new_numero`),
  ADD KEY `fk_t_news_new_t_compte_cpt` (`cpt_pseudo`);

--
-- Indexes for table `t_pad_pad`
--
ALTER TABLE `t_pad_pad`
  ADD PRIMARY KEY (`pad_id`);

--
-- Indexes for table `t_profil_pfl`
--
ALTER TABLE `t_profil_pfl`
  ADD KEY `fk_t_profil_pfl_t_compte_cpt` (`cpt_pseudo`);

--
-- Indexes for table `t_ressource_res`
--
ALTER TABLE `t_ressource_res`
  ADD PRIMARY KEY (`res_numero`),
  ADD KEY `fk_t_ressource_res_t_atelier_atl` (`atl_numero`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_animation_ani`
--
ALTER TABLE `t_animation_ani`
  MODIFY `pad_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_atelier_atl`
--
ALTER TABLE `t_atelier_atl`
  MODIFY `atl_numero` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_configuration_cfg`
--
ALTER TABLE `t_configuration_cfg`
  MODIFY `cfg_numero` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_news_new`
--
ALTER TABLE `t_news_new`
  MODIFY `new_numero` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_pad_pad`
--
ALTER TABLE `t_pad_pad`
  MODIFY `pad_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_ressource_res`
--
ALTER TABLE `t_ressource_res`
  MODIFY `res_numero` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_animation_ani`
--
ALTER TABLE `t_animation_ani`
  ADD CONSTRAINT `fk_t_animation_ani_t_compte_cpt` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`),
  ADD CONSTRAINT `fk_t_animation_ani_t_pad_pad` FOREIGN KEY (`pad_id`) REFERENCES `t_pad_pad` (`pad_id`);

--
-- Constraints for table `t_atelier_atl`
--
ALTER TABLE `t_atelier_atl`
  ADD CONSTRAINT `fk_t_atelier_atl_t_pad_pad` FOREIGN KEY (`pad_id`) REFERENCES `t_pad_pad` (`pad_id`);

--
-- Constraints for table `t_news_new`
--
ALTER TABLE `t_news_new`
  ADD CONSTRAINT `fk_t_news_new_t_compte_cpt` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);

--
-- Constraints for table `t_profil_pfl`
--
ALTER TABLE `t_profil_pfl`
  ADD CONSTRAINT `fk_t_profil_pfl_t_compte_cpt` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);

--
-- Constraints for table `t_ressource_res`
--
ALTER TABLE `t_ressource_res`
  ADD CONSTRAINT `fk_t_ressource_res_t_atelier_atl` FOREIGN KEY (`atl_numero`) REFERENCES `t_atelier_atl` (`atl_numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
