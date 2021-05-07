-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 mai 2021 à 18:21
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mycave`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `nickname`, `email`, `pwd`) VALUES
(1, 'Gobin', 'Gabriel', 'Int2cs', 'gabriel.gn87@gmail.com', '$2y$10$XoKTOyiSAiBr2GSds3orgeQXFV56FoId8aJwUQ.Yf3UL7ySwkijq.');

-- --------------------------------------------------------

--
-- Structure de la table `wines`
--

DROP TABLE IF EXISTS `wines`;
CREATE TABLE IF NOT EXISTS `wines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `millesime` int(11) NOT NULL,
  `cepages` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `wines`
--

INSERT INTO `wines` (`id`, `name`, `millesime`, `cepages`, `country`, `region`, `description`, `picture`) VALUES
(1, 'CHATEAU DE SAINT COSME', 2009, 'Grenache / Syrah', 'France', 'Southern Rhone / Gigondas', 'The aromas of fruit and spice give one a hint of the light drinkability of this lovely wine, which makes an excellent complement to fish dishes.\r\n', 'saint_cosme.jpg\r\n'),
(2, 'LAN RIOJA CRIANZA', 2006, 'Tempranillo', 'Spain', 'Rioja', 'A resurgence of interest in boutique vineyards has opened the door for this excellent foray into the dessert wine market. Light and bouncy, with a hint of black truffle, this wine will not fail to tickle the taste buds.\r\n', 'lan_rioja.jpg\r\n'),
(3, 'MARGERUM SYBARITE', 2010, 'Sauvignon Blanc', 'USA', 'California Central Cosat', '\"The cache of a fine Cabernet in ones wine cellar can now be replaced with a childishly playful wine bubbling over with tempting tastes of\r\nblack cherry and licorice. This is a taste sure to transport you back in time.\"\r\n', 'margerum.jpg\r\n'),
(4, 'OWEN ROE \"EX UMBRIS\"', 2009, 'Syrah', 'USA', 'Washington', '\"A one-two punch of black pepper and jalapeno will send your senses reeling, as the orange essence snaps you back to reality. Don\'t miss\r\nthis award-winning taste sensation.\"\r\n', 'ex_umbris.jpg\r\n'),
(5, 'REX HILL', 2009, 'Pinot Noir', 'USA', 'Oregon', '\"One cannot doubt that this will be the wine served at the Hollywood award shows, because it has undeniable star power. Be the first to catch\r\nthe debut that everyone will be talking about tomorrow.\"\r\n', 'rex_hill.jpg\r\n'),
(6, 'VITICCIO CLASSICO RISERVA', 2007, 'Sangiovese Merlot', 'Italy', 'Tuscany', 'Though soft and rounded in texture, the body of this wine is full and rich and oh-so-appealing. This delivery is even more impressive when one takes note of the tender tannins that leave the taste buds wholly satisfied.\r\n', 'viticcio.jpg\r\n'),
(7, 'CHATEAU LE DOYENNE', 2005, 'Merlot', 'France', 'Bordeaux', '\"Though dense and chewy, this wine does not overpower with its finely balanced depth and structure. It is a truly luxurious experience for the\r\nsenses.\"\r\n', 'le_doyenne.jpg\r\n'),
(8, 'DOMAINE DU BOUSCAT', 2009, 'Merlot', 'France', 'Bordeaux', 'The light golden color of this wine belies the bright flavor it holds. A true summer wine, it begs for a picnic lunch in a sun-soaked vineyard.\r\n', 'bouscat.jpg\r\n'),
(9, 'BLOCK NINE', 2009, 'Pinot Noir', 'USA', 'California', 'With hints of ginger and spice, this wine makes an excellent complement to light appetizer and dessert fare for a holiday gathering.\r\n', 'block_nine.jpg\r\n'),
(10, 'DOMAINE SERENE', 2009, 'Pinot Noir', 'USA', 'Oregon', 'Though subtle in its complexities, this wine is sure to please a wide range of enthusiasts. Notes of pomegranate will delight as the nutty finish completes the picture of a fine sipping experience.\r\n', 'domaine_serene.jpg\r\n'),
(11, 'BODEGA LURTON', 2011, 'Pinot Gris', 'Argentina', 'Mendoza', 'Solid notes of black currant blended with a light citrus make this wine an easy pour for varied palates.\r\n', 'bodega_lurton.jpg\r\n'),
(12, 'LES MORIZOTTES', 2009, 'Chardonnay', 'France', 'Bourgogne', '\"Breaking the mold of the classics, this offering will surprise and undoubtedly get tongues wagging with the hints of coffee and tobacco in\r\nperfect alignment with more traditional notes. Breaking the mold of the classics, this offering will surprise and\r\nundoubtedly get tongues wagging with the hints of coffee and tobacco in\r\nperfect alignment with more traditional notes. Sure to please the late-night crowd with the slight jolt of adrenaline it brings.\"\r\n', 'morizottes.jpg'),
(43, 'Chateau Petrus', 1996, 'Merlot', 'France', 'Dans le coin, pas trop loin', 'Le domaine Petrus (qui ne possÃ¨de pas de chÃ¢teau) tire son nom du lieu-dit sur lequel sont installÃ©es ses terres. Ce lieu aurait Ã©tÃ© nommÃ© aprÃ¨s Saint Pierre (Petrus en latin), qui est reprÃ©sentÃ© tenant les clÃ©s du paradis sur l\'Ã©tiquette des vins Petrus.\r\n\r\nAccoler la dÃ©nomination Â« ChÃ¢teau Â» devant le nom Â« Petrus Â», Ã  l\'instar de nombreux grands crus, est en quelque sorte inexact puisqu\'il n\'y a pas de chÃ¢teau Ã©rigÃ© dans le domaine. Un chai, reconstituÃ© rÃ©cemment, marque simplement la prÃ©sence du cru de Petrus.', 'default.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
