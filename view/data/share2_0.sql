-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 02 Juin 2015 à 09:26
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `share2.0`
--
CREATE DATABASE IF NOT EXISTS `share2.0` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `share2.0`;

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titreFilm` text NOT NULL,
  `dateSortieFilm` text NOT NULL,
  `realisateursFilm` text NOT NULL,
  `acteursFilm` text NOT NULL,
  `genresFilm` text NOT NULL,
  `nationaliteFilm` text NOT NULL,
  `synopsisFilm` text NOT NULL,
  `bandeAnnonceFilm` text NOT NULL,
  `extensionFilm` text NOT NULL,
  `afficheFilm` text NOT NULL,
  `dateAjoutFilm` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `films`
--

INSERT INTO `films` (`id`, `titreFilm`, `dateSortieFilm`, `realisateursFilm`, `acteursFilm`, `genresFilm`, `nationaliteFilm`, `synopsisFilm`, `bandeAnnonceFilm`, `extensionFilm`, `afficheFilm`, `dateAjoutFilm`) VALUES
(1, 'Captain America, le soldat de l''hiver', '2014', ' Anthony Russo, Joe Russo', 'Chris Evans, Scarlett Johansson, Anthony Mackie, Samuel L. Jackson, Cobie Smulders, Frank Grillo, Emily VanCamp, Hayley Atwell', 'Aventure, Action, Science-fiction', 'Americain', 'Après les événements cataclysmiques de New York de The Avengers, Steve Rogers aka Captain America vit tranquillement à Washington, D.C. et essaye de s''adapter au monde moderne. Mais quand un collègue du S.H.I.E.L.D. est attaqué, Steve se retrouve impliqué dans un réseau d''intrigues qui met le monde en danger. S''associant à Black Widow, Captain America lutte pour dénoncer une conspiration grandissante, tout en repoussant des tueurs professionnels envoyés pour le faire taire. Quand l''étendue du plan maléfique est révélée, Captain America et Black Widow sollicite l''aide d''un nouvel allié, le Faucon. Cependant, ils se retrouvent bientôt face à un inattendu et redoutable ennemi - le Soldat de l''Hiver. ', 'https://www.youtube.com/watch?v=6mQWmUwxZjI', 'mkv', 'http://fr.web.img5.acsta.net/r_160_240/b_1_d6d6d6/pictures/14/01/31/17/06/486036.jpg', '06/01/2015'),
(2, 'Centurion', '2010', 'Neil Marshall', 'Michael Fassbender, Dominic West, Olga Kurylenko, Noel Clarke, David Morrissey, JJ Feild, Axelle Carolyn, Riz Ahmed', 'Action, Aventure, Historique', 'Français, Britanique', '117 après Jésus-Christ : l’Empire Romain règne sur tout l’Occident. Pourtant, aux confins glacés du nord de l’Angleterre, l’armée romaine se heurte à la tribu des Pictes, des barbares sanguinaires qui maîtrisent parfaitement l’environnement. Afin d’éradiquer la menace, le gouverneur local fait appel à la légendaire 9ème légion du Général Titus Virilus, le bataillon d’élite de l’Empire. Mais, contre toute attente, la cohorte se fait massacrer au cours d’une terrible embuscade et le Général est fait prisonnier. Seul le Centurion Marcus Dias et quelques survivants échappent miraculeusement au carnage. Au lieu de battre en retraite, ces guerriers solitaires décident de tenter l’impossible : s’enfoncer en territoire ennemi pour délivrer Virilus… ', 'https://www.youtube.com/watch?v=wql8FLnLdpI', 'avi', 'http://fr.web.img3.acsta.net/r_160_240/b_1_d6d6d6/medias/nmedia/18/70/30/55/19539391.jpg', '06/01/2015'),
(3, 'Le loup de Wall Street', '2013', 'Martin Scorsese', 'Leonardo DiCaprio, Jonah Hill, Margot Robbie, Matthew McConaughey, Kyle Chandler, Rob Reiner, Jon Bernthal, Jon Favreau', 'Biopic, Drame, Policier', 'Américain', 'L’argent. Le pouvoir. Les femmes. La drogue. Les tentations étaient là, à portée de main, et les autorités n’avaient aucune prise. Aux yeux de Jordan et de sa meute, la modestie était devenue complètement inutile. Trop n’était jamais assez… ', 'https://www.youtube.com/watch?v=GT9UfSqBz9o', 'avi', 'http://fr.web.img5.acsta.net/r_160_240/b_1_d6d6d6/pictures/210/604/21060483_20131125114549726.jpg', '05/25/2015');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titreGenre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `genres`
--

INSERT INTO `genres` (`id`, `titreGenre`) VALUES
(1, 'Action'),
(2, 'Animation'),
(3, 'Arts martiaux'),
(4, 'Aventure'),
(5, 'Biopic'),
(6, 'Bollywood'),
(7, 'Classique'),
(8, 'Comédie'),
(9, 'Comédie dramatique'),
(10, 'Comédie musicale'),
(11, 'Concert'),
(12, 'Dessin animé'),
(13, 'Divers'),
(14, 'Documentaire'),
(15, 'Drama'),
(16, 'Drame'),
(17, 'Epouvante-Horreur'),
(18, 'Erotique'),
(19, 'Espionnage'),
(20, 'Expérimental'),
(21, 'Famille'),
(22, 'Fantastique'),
(23, 'Guerre'),
(24, 'Historique'),
(25, 'Judiciaire'),
(26, 'Movie night'),
(27, 'Musical'),
(28, 'Opera'),
(29, 'Péplum'),
(30, 'Policier'),
(31, 'Romance'),
(32, 'Science-fiction'),
(33, 'Show'),
(34, 'Sport event'),
(35, 'Thriller'),
(36, 'Western');

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

CREATE TABLE IF NOT EXISTS `profils` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` text NOT NULL,
  `motdepasse` text NOT NULL,
  `avatar` text NOT NULL,
  `grade` enum('Initié','Padawan','Chevalier','Maître') NOT NULL,
  `messages` int(11) NOT NULL,
  `connexion` text NOT NULL,
  `media` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `profils`
--

INSERT INTO `profils` (`id`, `pseudo`, `motdepasse`, `avatar`, `grade`, `messages`, `connexion`, `media`) VALUES
(1, 'alexis', 'alexis/18', 'vador', 'Maître', 3, '02/06/2015 - 09:18:27', 'serie - Kaamelott - Livre 2 - Episode 01'),
(7, 'invite', 'invite', 'ampoule', 'Initié', 0, '06/04/2015 - 19:33:14', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
