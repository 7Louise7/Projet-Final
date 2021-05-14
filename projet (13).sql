-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 13 mai 2021 à 20:19
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
CREATE TABLE IF NOT EXISTS `abonnement` (
  `idabonnement` int(11) NOT NULL AUTO_INCREMENT,
  `prix` float NOT NULL,
  `nomabonnement` varchar(100) NOT NULL,
  PRIMARY KEY (`idabonnement`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`idabonnement`, `prix`, `nomabonnement`) VALUES
(1, 0, 'standard'),
(3, 1.99, 'premium');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `idcommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `note_com` int(11) NOT NULL,
  `dateCommentaire` date NOT NULL,
  `contenucom` text NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `idtuto` int(11) NOT NULL,
  PRIMARY KEY (`idcommentaire`),
  KEY `Commentaire_Utilisateur_FK` (`idutilisateur`),
  KEY `Commentaire_Tuto0_FK` (`idtuto`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`idcommentaire`, `note_com`, `dateCommentaire`, `contenucom`, `idutilisateur`, `idtuto`) VALUES
(1, 4, '2021-04-27', 'bonjour jadore ce tuto ', 6, 6),
(2, 4, '2021-05-11', 'Très facile à réaliser !', 22, 12),
(3, 5, '2021-05-11', 'Super rapide et facile, merci !!', 22, 17),
(4, 3, '2021-05-11', 'Je ne suis pas sûre de l\'efficacité de ce tuto...', 22, 18),
(5, 4, '2021-05-11', 'Mes cheveux sont super brillants, merci beaucoup', 22, 22),
(6, 2, '2021-05-11', 'Je me suis brûlée avec le pistolet à colle :(', 22, 21),
(7, 5, '2021-05-11', 'Tuto idéal pour une pro de l\'organisation comme moi !', 22, 16),
(8, 5, '2021-05-11', 'Délicieux !', 22, 15),
(9, 5, '2021-05-11', 'Toute la famille est ravie !', 22, 33),
(10, 4, '2021-05-11', 'J\'ai prolongé un peu la cuisson, c\'était parfait !', 22, 32),
(11, 5, '2021-05-11', 'Mes filles se sont bien amusées !!!', 22, 20),
(12, 5, '2021-05-11', 'Economique et super efficace', 22, 35),
(13, 5, '2021-05-11', 'Mon linge sent super bon', 22, 25),
(14, 5, '2021-05-11', '20/20, rien à dire !', 22, 29),
(15, 4, '2021-05-11', 'Cette crème sent super bon', 22, 23),
(16, 1, '2021-05-11', 'Super nul', 22, 23),
(17, 5, '2021-05-12', 'Vraiment pratique!', 6, 14),
(18, 3, '2021-05-12', 'Un peu petit mais reste très bien.', 6, 34),
(19, 5, '2021-05-12', 'Vraiment délicieuse!', 6, 13),
(20, 4, '2021-05-12', 'Génial je recommande!', 6, 28),
(21, 2, '2021-05-12', 'Le résultat n\'est pas celui attendu...', 6, 19),
(22, 3, '2021-05-12', 'Mon dessin est beaucoup moins réussi mais bon la toile reste belle!', 6, 30),
(23, 3, '2021-05-12', 'Très efficace malgré une odeur désagréable.', 6, 11),
(24, 5, '2021-05-12', 'Excellent mes vêtements sont ravis!', 6, 12),
(25, 4, '2021-05-12', 'Parfait tous est très bien expliqués.', 6, 27),
(26, 5, '2021-05-11', 'Un peu long a réaliser mais le résultat est si beau et pratique!', 6, 16),
(27, 1, '2021-05-11', 'Odeur insoutenable ', 6, 22),
(28, 4, '2021-05-13', 'Très bien pour ranger ses affaires !', 26, 34),
(29, 5, '2021-05-13', 'Super tuto qui permet de remplacer l\'aluminium.', 26, 14),
(30, 3, '2021-05-13', 'Il faut baisser la température du four !', 26, 19),
(31, 4, '2021-05-13', 'J\'ai choisi d\'autres couleurs et un autre dessin. Ma toile est superbe :)', 26, 30),
(32, 5, '2021-05-13', 'Très bonne idée de mettre à disposition des thèmes à imprimer !', 26, 16),
(33, 3, '2021-05-13', 'A utiliser uniquement pour les cheveux secs', 26, 22),
(34, 4, '2021-05-13', 'Très bien !!!', 26, 12),
(35, 3, '2021-05-13', 'Bien mais forte odeur de vinaigre', 26, 25),
(36, 5, '2021-05-13', 'Très efficace', 26, 27);

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

DROP TABLE IF EXISTS `etape`;
CREATE TABLE IF NOT EXISTS `etape` (
  `idetape` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `idtuto` int(11) NOT NULL,
  `idphoto` int(11) NOT NULL,
  PRIMARY KEY (`idetape`),
  KEY `etape_tuto_FK` (`idtuto`),
  KEY `etape_photo_FK` (`idphoto`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`idetape`, `texte`, `idtuto`, `idphoto`) VALUES
(19, 'Plier le tissu en deux, endroit contre endroit. Coudre au point droit, sur toute la longueur, le côté opposé à la pliure.', 6, 25),
(20, 'Retourner le tissu à l\'aide d\'une épingle à nourrice. On se retrouve avec un tube.', 6, 26),
(21, 'Faire passer l\'élastique à l\'intérieur du tube.', 6, 27),
(22, 'Nouer les deux extremités de l\'élastique ensemble.', 6, 28),
(23, 'Ramener les extremités du tissu ensemble et rentrer l\'une dans l\'autre. Prendre une aiguille et fermer le \"trou\" en cousant à la main. Vous pouvez aussi le faire a la machine mais le résultat est moins beau.', 6, 29),
(24, 'Et ... c\'est fini !!!', 6, 30),
(26, 'Dans un saladier, mélangez tous les ingrédients avec un fouet, sauf l’eau.', 11, 37),
(27, 'Ajoutez lentement l’eau en commençant pas une cuillère à café, puis mélanger bien et vérifiez la consistance. Continuez jusqu’à ce que vous puissiez former une « boule de neige ».', 11, 38),
(28, 'Lorsque c’est le cas, remplissez le bac à glaçons et tassez bien pour éliminer les poches d’air. Puis, laissez sécher pendant 12 à 24 heures.', 11, 39),
(29, 'Une fois sèches, vous pouvez démouler délicatement vos pastilles, en retournant doucement votre bac à glaçons.', 11, 40),
(30, 'Réduire les savons en lamelles à l’aide de l’économe pour faciliter la fonte du savon.', 12, 42),
(31, 'Faire fondre le savon à feu doux et remuer régulièrement. Il faut ajouter un peu d’eau en petites quantités (cela fait mousser), en remuant. Il ne doit plus y avoir de morceaux de savons mais une préparation pâteuse.', 12, 43),
(32, 'Hors de feu, ajouter le son de blé dans la préparation puis mélanger pour bien répartir le son dans le savon. Ajouter ensuite les huiles essentielles et mélanger de nouveau.', 12, 44),
(33, 'Remplir le moule en silicone de préparation. Bien tasser pour éviter les bulles d’air.', 12, 45),
(34, 'Laisser sécher 6 à 12 heures, puis démouler délicatement. Vos savons sont prêts à être utilisés !', 12, 46),
(35, 'Eplucher et découper en morceaux l\'ensemble des pommes', 13, 53),
(36, 'Mettre dans une casserole le sucre, le sachet de sucre vanillé, l\'eau ainsi que les pommes.\r\n			Puis faire cuire l\'ensemble jusqu\'à ce que les pommes s\'écrasent durant environ 25min à feu doux.', 13, 54),
(37, 'Mixer les pommes puis conserver au frais. Et ... c\'est fini !!!', 13, 55),
(38, 'Réalisez le patron de votre couvercle. Pour cela, tracez un cercle du diamètre de votre plat +8cm. Ici, 28 cm, soit un cercle de rayon 14cm.', 14, 57),
(39, 'Découpez dans le tissu principal et dans celui de la doublure, deux cercles à partir de votre patron.', 14, 58),
(40, 'Positionnez vos deux cercles endroit contre endroit. Faites une couture, au point droit, tout le tour en laissant une ouverture d\'environ 7 cm. Retournez votre tissu par l\'ouverture', 14, 59),
(41, 'Une fois retourné, faites une couture à environ 1.5 cm du bord pour laisser passer l\'élastique, en laissant toujours une ouverture de 7cm. Nous avons créer une fente.', 14, 60),
(42, 'Une fois la fente créée, faites-y passer l\'élastique à l\'aide d\'une épingle à nourrice.', 14, 61),
(43, 'Faites un noeud avec les extremités de l\'élastique pour le fermer. Puis fermez les ouvertures au point droit.', 14, 62),
(44, 'Et ... c\'est fini !!!', 14, 56),
(45, 'Mettre dans un saladier le yaourt, la farine, le sucre, les œufs, le sachet de sucre vanillé et celui de levure chimique', 15, 65),
(46, 'Commencer à mélanger la préparation à l\'aide d\'un fouet en ajoutant progressivement l\'huile', 15, 66),
(47, 'Mélanger l\'ensemble des ingrédients jusqu\'à obtenir une pâte lisse', 15, 67),
(48, 'Mettre la préparation dans un moule fariné et beurré, puis le faire cuire 35 minutes à 180°C', 15, 68),
(49, 'Positionner les morceaux de bois comme indiqué sur la photo', 16, 70),
(50, 'Visser les vis aux quatre emplacements destinés', 16, 71),
(51, 'Positionner la règle au niveau de la largeur du support, puis faire un point à 6,1 cm', 16, 72),
(52, 'A l\'aide du tournevis, visser de chaque côté les deux morceaux de bois pour positionner le support en hauteur', 16, 73),
(53, 'Visser les deux dernières vis pour fixer le morceau de bois', 16, 74),
(54, 'Peindre l\'ensemble du support avec la couleur de son choix', 16, 75),
(55, 'Faire les trois paquets et faire un trou en haut de chaque image', 16, 76),
(56, 'Avec le fil, relier les vignettes puis faire un nœud pour les accrocher au support\r\n\r\nEt ... c\'est fini !!!', 16, 77),
(57, 'Dans un récipient ou directement dans votre pot, mélangez une cuillère à café de cassonade et une cuillère à café de miel.', 17, 79),
(58, 'Testez ! Il suffit de masser délicatement vos lèvres avec une petite quantité de gommage puis de rincer. Pensez à hydrater vos lèvres ensuite ! Le sucre et le miel se conservent longtemps.', 17, 80),
(59, 'Dans un récipient, faire fondre 3 cuillères à soupe d’huile de coco au bain-marie puis verser dans le récipient propre.', 18, 82),
(60, 'Ajouter 2 cuillères à soupe de bicarbonate et 2 autres de Maïzena, puis mélanger. Lorsqu’il n’y a plus de grumeaux, verser la pâte dans un récipient ou un moule en silicone (cannelés par exemple). Mettre au frigo pour que la préparation se solidifie.', 18, 83),
(61, 'Tester ! Il suffit d’appliquer une petite quantité directement sur l’aisselle.', 18, 84),
(62, 'Sur votre planche, coupez les oranges en fines rondelles.', 19, 86),
(63, 'Déposez-les sur la grille de votre four ou dans votre plat.', 19, 87),
(64, 'Faites sécher à 90°C pendant 2h30. Surveillez le séchage. Si elles sont trop colorées, retirez-les avant. Laissez-les refroidir, elles durciront en refroidissant.', 19, 88),
(65, 'Dans le saladier, ajouter un verre de sel fin, deux verres de farine et ¾ d’un verre d’eau tiède.', 20, 90),
(66, 'Mélanger la préparation à l’aide de vos mains.', 20, 91),
(67, 'Mettre la pâte à sel sur une surface propre, puis pétrir. La pâte doit être souple et ne pas coller aux doigts.', 20, 92),
(68, 'A vous de jouer !', 20, 89),
(69, 'Faire fondre les bougies dans une casserole à feu doux. Pour celles qui sont dans un récipient, les faire fondre au bain-marie puis ajouter la cire dans la casserole.', 21, 95),
(70, 'A l’aide du pistolet à colle, coller la mèche au milieu du fond du récipient. Assemblez les bâtonnets à l’aide des élastiques comme sur la photo. Ce support permettra à la mèche de rester droite lorsque vous ajouterez la cire chaude.', 21, 96),
(71, 'Placez le filtre au fond de l’entonnoir. Il permettra de retirer toutes les petites impuretés. Lorsque la cire est fondue, retirez du feu. Ajouter éventuellement les colorants (ajustez en fonction de la couleur que vous souhaitez) et les parfums, puis mélanger.', 21, 97),
(72, 'Versez délicatement la cire fondue dans le récipient à travers l’entonnoir. Notez que la cire risque de se rétracter lors du séchage, vous pouvez en mettre de côté pour en rajouter ensuite.', 21, 98),
(73, 'Laissez durcir au moins 3h, puis retirez les bâtonnets et coupez la mèche en laissant environ 1 cm. Et ... c\'est fini !', 21, 94),
(74, 'Mettre dans un récipient la maïzena et l’eau puis mélanger', 22, 105),
(75, 'Incorporer l’eau de coco progressivement', 22, 106),
(76, 'Ajouter le miel et continuer de mélanger', 22, 107),
(77, 'Pour finir, insérer l’huile d’olive.', 22, 108),
(78, 'Puis, mélanger la préparation. Et ... c\'est fini !!!', 22, 109),
(79, 'Faire fondre au bain marie le beurre de karité contenu dans un petit bol', 23, 111),
(80, 'Ajouter la cire d’abeille et la faire fondre dans la préparation', 23, 112),
(81, 'Incorporer l’huile d’argan et mélanger', 23, 113),
(82, 'Progressivement, ajouter l’eau tout en continuant de mélanger', 23, 114),
(83, 'On mélange 5 min pour obtenir une texture fluide puis mettre ce mélange dans un pot. Et … c’est fini !!!', 23, 115),
(84, 'Faire chauffer 1,5L d’eau dans une casserole', 24, 117),
(85, 'Une fois que l’eau est chaude, on incorpore le savon de Marseille, les cristaux de soude et le bicarbonate tout en mélangeant, jusqu’à dissolution complète', 24, 118),
(86, 'On laisse refroidir la préparation durant 10 minutes', 24, 119),
(87, 'Avec un entonnoir, on insère le mélange dans le bidon de lessive.', 24, 120),
(88, 'Enfin, on ajoute l\'huile essentielle. Et … c’est fini !!!', 24, 121),
(89, 'Mettre l’eau dans la bouteille', 25, 123),
(90, 'Puis incorporer le vinaigre blanc', 25, 124),
(91, 'Ajouter l’huile essentielle au mélange. Et … c’est fini !!!', 25, 125),
(93, 'Versez 25 cl d’eau déminéralisée dans un verre doseur', 27, 129),
(94, 'Ajoutez 15 cl de vinaigre blanc', 27, 130),
(95, 'Versez donc votre mélange d\'eau déminéralisée et de vinaigre blanc dans votre contenant (bouteille, tube de sauce...)', 27, 131),
(96, 'Ajouter 5 gouttes  d\'huile essentielle de citronnelle', 27, 132),
(97, 'Bien secouer le flacon ! Un geste à renouveler ensuite avant chaque utilisation. Votre produit est prêt à être utilisé !', 27, 133),
(98, 'Rincez les graines en essayant de retirer un maximum de fibres.', 28, 135),
(99, 'Etalez les graines sur un torchon. Laissez sécher les graines une nuit ou séchez-les avec le torchon.', 28, 136),
(100, 'Parfumez les graines avec votre huile (olive, tournesol...) et votre épice (paprika, curry...) puis mélangez.', 28, 137),
(101, 'Etalez les graines sur une plaque de four et faites les griller pendant 10 minutes à 160°C. Prolongez éventuellement d’une minute, jusqu’à obtenir des graines légèrement brunes. Surveillez-les, si vous les laisser trop longtemps, elles exploseront comme du pop-corn. Laissez-les refroidir et dégustez-les ou ajoutez les à votre salade !', 28, 134),
(102, 'Epingler les 2 carrés endroit contre endroit.', 29, 140),
(103, 'Faire une couture tout autour en laissant un petit espace en haut.', 29, 141),
(104, 'Retourner le tout grâce à l\'espace laissé précédemment. Et épingler en faisant un ourlet vers l\'intérieur au niveau de l\'espace laissé pour refermer cette ouverture.', 29, 142),
(105, 'Faire une couture tout autour de façon à aplatir votre coton tout en fermant l\'ouverture', 29, 143),
(106, 'Et ... c\'est fini !!!', 29, 144),
(107, 'Dessiner des formes à peindre sur la toile.', 30, 146),
(108, 'Peindre les zones souhaitées.', 30, 147),
(109, 'Positionner le dessin sur la toile.', 30, 148),
(110, 'Faire des trous à l\'aide d\'une aiguille en suivant les lignes du dessin.', 30, 149),
(111, 'Relier les trous avec le fil à broderie, à l\'aide d\'une aiguille.', 30, 150),
(112, 'Et ... c\'est fini !!!', 30, 151),
(114, 'Dans une casserole, faire fondre le chocolat avec le beurre', 32, 156),
(115, 'Mélanger dans un saladier les œufs et le sucre jusqu\'à ce que le mélange devienne mousseux et double de volume', 32, 157),
(116, 'Ajouter le chocolat et le beurre puis fouetter', 32, 158),
(117, 'Incorporer la farine puis continuer de mélanger. Mettre au four 15 minutes à 220°C, après l\'avoir préchauffé. ', 32, 159),
(118, 'Faire chauffer la crème ainsi que la vanille. Couper le feu avant ébullition.', 33, 161),
(119, 'Mélanger dans un saladier à l\'aide d\'un fouet les jaunes d\'œufs et le sucre', 33, 162),
(120, 'Ajouter en plusieurs fois la crème liquide dans la préparation.', 33, 163),
(121, 'Dans un plat allant au four, mettre de l\'eau puis y placer les récipients. Incorporer le mélange à l\'intérieur. Puis, mettre au four à 140°C.', 33, 164),
(122, 'Après avoir laisser les crèmes 1h au frais, parsemer le dessus de cassonade.', 33, 165),
(123, 'Enfin, à l\'aide d\'un chalumeau, caraméliser le sucre. Et c\'est fini!!', 33, 166),
(124, 'Couper 2 morceaux de tissu de taille : 16,5 cm x 21,5cm', 34, 168),
(125, 'Coudre les deux morceaux de tissu endroit contre endroit', 34, 169),
(126, 'Epingler le haut de chaque morceau de tissu comme indiqué sur la photo, à l\'aide d\'épingles', 34, 170),
(127, 'Puis coudre à l\'endroit où se trouvaient les épingles, sur toute la longueur', 34, 171),
(128, 'Associer et coudre ensemble les deux morceaux de tissu', 34, 172),
(129, 'Enfin, à l\'aide d\'une épingle à nourrice, insérer le cordon à l\'endroit destiné. Et ... c\'est fini !!!', 34, 173),
(130, 'Mettre dans le bocal les écorces d\'orange et de citron ainsi que la lavande', 35, 175),
(131, 'Ajouter le vinaigre blanc', 35, 176),
(132, 'Fermer le bocal puis laisser infuser le mélange durant 10 jours', 35, 177),
(133, 'Puis verser la préparation sans les produits solides dans le spray', 35, 178),
(134, 'Incorporer l\'eau tiède', 35, 179),
(135, 'Ajouter les gouttes de liquide vaisselle', 35, 180),
(136, 'Puis, secouer quelques instants la préparation. Et ... c\'est fini !!!', 35, 174);

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `idmateriel` int(11) NOT NULL AUTO_INCREMENT,
  `nommateriel` varchar(255) NOT NULL,
  PRIMARY KEY (`idmateriel`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`idmateriel`, `nommateriel`) VALUES
(56, 'élastique '),
(57, 'tissu'),
(58, 'machine à coudre'),
(59, 'fil'),
(60, 'épingle à nourrice'),
(61, 'épingle(s)'),
(63, 'de cristaux de soude'),
(64, 'de bicarbonate de soude'),
(65, 'd’acide citrique'),
(66, 'de gros sel de mer'),
(67, 'gouttes d’huile essentielle de lavande'),
(68, 'gouttes d’huile essentielle de citron'),
(69, 'bac à glaçons'),
(70, 'saladier'),
(71, 'verre d\'eau'),
(72, 'moule en silicone'),
(73, 'économe'),
(74, 'savons classiques'),
(75, 'cuillère à soupe'),
(76, 'casserole'),
(77, 'de son de blé'),
(78, 'd\'huiles essentielles'),
(79, 'de pommes'),
(80, 'd\'eau'),
(81, 'de sucre vanillé'),
(82, 'de sucre semoule'),
(83, ' cercles de tissu du diamètre de votre plat +8cm'),
(84, 'Papier à patron'),
(85, 'élastique du diamètre de votre plat'),
(86, 'fil'),
(87, 'épingle à nourrice'),
(88, 'épingles'),
(89, 'yaourt nature'),
(90, 'pots de farine'),
(91, 'pots de sucre'),
(92, 'œufs'),
(93, 'pot d\'huile'),
(94, 'sachet de sucre vanillé'),
(95, 'sachet de levure chimique'),
(96, 'beurre'),
(97, 'morceaux de 32 cm de longueur'),
(98, 'morceaux de 8 cm de longueur'),
(99, 'morceaux de 10 cm de longueur'),
(100, 'vis'),
(101, 'tournevis ou perceuse / visseuse'),
(102, 'règle'),
(103, 'papier (retrouver les dans votre profil et imprimer les)'),
(104, 'paire de ciseaux'),
(105, 'peinture(s)'),
(106, 'pinceau'),
(107, 'fil à coudre ou à broderie'),
(108, 'petit pot propre'),
(109, 'de cassonade'),
(110, 'de miel'),
(111, 'd’huile de coco'),
(112, 'de bicarbonate de soude'),
(113, 'de Maïzena'),
(114, 'récipient propre'),
(115, 'ou plusieurs oranges (abîmées ou non)'),
(116, 'Couteau'),
(117, 'planche à découper'),
(118, 'grille de four'),
(119, 'verre'),
(120, 'saladier'),
(121, 'de farine'),
(122, 'de sel fin'),
(123, 'd\'eau tiède'),
(124, 'Vieilles bougies'),
(125, 'Mèche de bougie (pré-cirée, idéalement) avec socle'),
(126, 'Casserole'),
(127, 'Filtre (compresse, vieux collants…)'),
(128, 'Pics/bâtonnets'),
(129, 'Elastiques'),
(130, 'Récipient'),
(131, 'Pistolet à colle'),
(132, 'Entonnoir'),
(133, 'Parfum (facultatif)'),
(134, 'Colorant (facultatif)'),
(135, 'cuillères à soupe de maïzena'),
(136, 'cuillère à soupe d\'eau'),
(137, 'cuillères à soupe d\'eau de coco'),
(138, 'cuillère à soupe de miel'),
(139, 'cuillères à soupe d\'huile d\'olive'),
(140, 'récipient'),
(141, 'cuillère à soupe '),
(142, 'de beurre de karité'),
(143, 'de cire d’abeille'),
(144, 'cuillère à café d’huile d’argan'),
(145, 'd’eau'),
(146, 'pot stérilisé'),
(147, 'fouet'),
(148, 'bidon de 1,5L'),
(149, 'entonnoir'),
(150, 'd’eau'),
(151, 'de copeaux de savon de Marseille naturel'),
(152, 'de cristaux de soude'),
(153, 'cuillère à soupe de bicarbonate'),
(154, 'd’huile essentielle au choix'),
(155, 'casserole'),
(156, 'bouteille de 1,5L'),
(157, 'entonnoir'),
(158, 'd’eau'),
(159, 'de vinaigre blanc'),
(160, 'd’huile essentielle au choix'),
(162, 'd’eau déminéralisée'),
(163, 'de vinaigre blanc'),
(164, 'gouttes d’huile essentielle de citronnelle'),
(165, 'verre doseur'),
(166, 'contenant'),
(167, 'de graines de courge'),
(168, 'huile de votre choix'),
(169, 'épice de votre choix'),
(170, 'torchon'),
(171, 'plaque de four'),
(172, 'carré de 12x12cm de tissu en coton'),
(173, 'carré de 15x15cm de tissu en éponge de bambou'),
(174, 'toile'),
(175, 'fil à broder'),
(176, 'aiguille'),
(177, 'image du dessin à broder'),
(179, 'chocolat noir'),
(180, 'oeufs'),
(181, 'de sucre'),
(182, 'de farine'),
(183, 'Crème fraiche liquide entière'),
(184, 'Poudre de vanille'),
(185, 'jaunes d\'oeufs'),
(186, 'cassonnade'),
(187, 'Chalumeau'),
(188, 'cordon'),
(189, 'épingle(s)'),
(190, 'orange'),
(191, 'citron'),
(192, 'de lavande'),
(193, 'bocal'),
(194, 'de vinaigre blanc'),
(195, 'd\'eau'),
(196, 'de liquide vaisselle'),
(197, 'récipient - spray');

-- --------------------------------------------------------

--
-- Structure de la table `necessite`
--

DROP TABLE IF EXISTS `necessite`;
CREATE TABLE IF NOT EXISTS `necessite` (
  `idmateriel` int(11) NOT NULL,
  `idtuto` int(11) NOT NULL,
  `quantité` varchar(255) NOT NULL,
  PRIMARY KEY (`idmateriel`,`idtuto`),
  KEY `necessite_Tuto0_FK` (`idtuto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `necessite`
--

INSERT INTO `necessite` (`idmateriel`, `idtuto`, `quantité`) VALUES
(56, 6, '15cm d\''),
(57, 6, '1 rectangle de 50x10cm de'),
(57, 34, '1'),
(58, 6, '1'),
(58, 34, '1'),
(59, 6, '1'),
(59, 14, '1'),
(59, 29, '1'),
(59, 34, '1'),
(60, 6, '1'),
(61, 6, '10'),
(61, 14, '15'),
(61, 29, '4'),
(63, 11, '60g'),
(64, 11, '60g'),
(64, 18, '2 cuillères à soupe'),
(65, 11, '60g'),
(66, 11, '60g'),
(67, 11, '15'),
(68, 11, '15'),
(69, 11, '1'),
(70, 11, '1'),
(70, 20, '1'),
(71, 11, '1'),
(72, 12, '1'),
(73, 12, '1'),
(74, 12, '3'),
(75, 12, '1'),
(76, 12, '1'),
(76, 21, '1'),
(76, 24, '1'),
(77, 12, '30g'),
(78, 12, '10 gouttes'),
(79, 13, '1.5kg'),
(80, 13, '2 verres'),
(80, 33, '50 cL'),
(81, 13, '1 sachet'),
(82, 13, '60g'),
(83, 14, '2 '),
(84, 14, '1'),
(85, 14, '1'),
(87, 14, '1'),
(87, 34, '1'),
(89, 15, '1'),
(90, 15, '3'),
(91, 15, '2'),
(92, 15, '3'),
(93, 15, '0,5'),
(94, 15, '1'),
(95, 15, '1'),
(96, 15, '10g de'),
(96, 32, '100g de'),
(97, 16, '3'),
(98, 16, '2'),
(99, 16, '2'),
(100, 16, '8'),
(101, 16, '1'),
(102, 16, '1'),
(103, 16, '1'),
(104, 16, '1'),
(105, 16, '1'),
(105, 30, '2 de couleurs différentes'),
(106, 16, '1'),
(106, 30, '1'),
(107, 16, '1'),
(108, 17, '1'),
(109, 17, '1 cuillère à café'),
(110, 17, '1 cuillère à café'),
(111, 18, '3 cuillères à soupe'),
(113, 18, '2 cuillères à soupe'),
(114, 18, '1'),
(115, 19, '1'),
(116, 19, '1'),
(117, 19, '1'),
(118, 19, '1'),
(119, 20, '1'),
(121, 20, '1 verre'),
(122, 20, '1 verre'),
(123, 20, '3/4 d\'un verre'),
(124, 21, '4'),
(125, 21, '1'),
(127, 21, '1'),
(128, 21, '2'),
(129, 21, '2'),
(130, 21, '1'),
(130, 22, '1'),
(131, 21, '1'),
(132, 21, '1'),
(132, 24, '1'),
(132, 25, '1'),
(133, 21, '1'),
(134, 21, '1'),
(135, 22, '2'),
(136, 22, '1'),
(137, 22, '4'),
(138, 22, '1'),
(139, 22, '3'),
(141, 22, '1'),
(142, 23, '10g'),
(143, 23, '2g'),
(144, 23, '1'),
(145, 23, '60 mL'),
(145, 24, '1,5 L'),
(145, 25, '750 mL'),
(146, 23, '1'),
(147, 23, '1'),
(148, 24, '1'),
(151, 24, '50g'),
(152, 24, '30g'),
(153, 24, '1'),
(154, 24, '35 gouttes'),
(154, 25, '20 gouttes'),
(156, 25, '1'),
(159, 25, '750 mL'),
(159, 27, '15cl'),
(162, 27, '25cl'),
(164, 27, '5'),
(165, 27, '1'),
(166, 27, '1'),
(167, 28, '100g'),
(168, 28, '1'),
(169, 28, '1'),
(170, 28, '1'),
(171, 28, '1'),
(172, 29, '1'),
(173, 29, '1'),
(174, 30, '1'),
(175, 30, '1'),
(176, 30, '1'),
(177, 30, '1'),
(179, 32, '100g de'),
(180, 32, '2'),
(181, 32, '140g'),
(181, 33, '100g'),
(182, 32, '75g'),
(183, 33, '50 cL de'),
(184, 33, '5g de'),
(185, 33, '6'),
(186, 33, '50g de'),
(187, 33, '1'),
(188, 34, '1'),
(189, 34, '5'),
(190, 35, '1'),
(191, 35, '1'),
(192, 35, '6 branches'),
(193, 35, '1'),
(194, 35, '75cL'),
(195, 35, '75cL'),
(196, 35, '2 gouttes'),
(197, 35, '1');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `idphoto` int(11) NOT NULL AUTO_INCREMENT,
  `datePhoto` date NOT NULL,
  `chemin` varchar(100) NOT NULL,
  `idtuto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idphoto`),
  KEY `Photo_Tuto_FK` (`idtuto`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idphoto`, `datePhoto`, `chemin`, `idtuto`) VALUES
(24, '2021-04-26', '20210214_204212.jpg', 6),
(25, '2021-04-26', '20210125_162021.jpg', NULL),
(26, '2021-04-26', '20210125_162354.jpg', NULL),
(27, '2021-04-26', '20210125_162545.jpg', NULL),
(28, '2021-04-26', '20210125_162750.jpg', NULL),
(29, '2021-04-26', '20210125_162810.jpg', NULL),
(30, '2021-04-26', '20210125_162927.jpg', NULL),
(33, '2021-04-28', 'titre-3.jpg', NULL),
(35, '2021-04-29', 'grand-titre-8.jpg', NULL),
(36, '2021-04-29', 'PastillePresentation.jpg', 11),
(37, '2021-04-29', 'Pastille1.png', NULL),
(38, '2021-04-29', 'Pastille2.png', NULL),
(39, '2021-04-29', 'Pastille3.png', NULL),
(40, '2021-04-29', 'Pastille4.png', NULL),
(41, '2021-04-30', 'SavonPresentation.png', 12),
(42, '2021-04-30', 'Savon1.png', NULL),
(43, '2021-04-30', 'Savon2.png', NULL),
(44, '2021-04-30', 'Savon3.png', NULL),
(45, '2021-04-30', 'Savon4.png', NULL),
(46, '2021-04-30', 'Savon5.png', NULL),
(47, '2021-04-30', 'accueil-couture.jpg', NULL),
(49, '2021-04-30', 'acceuil-cuisine.jpg', NULL),
(50, '2021-04-30', 'acceuil-cosmetique.jpg', NULL),
(51, '2021-04-30', 'acceuil-menagers.jpg', NULL),
(52, '2021-04-30', 'IMG-3819.jpg', 13),
(53, '2021-04-30', 'IMG-3812.jpg', NULL),
(54, '2021-04-30', 'IMG-3814.jpg', NULL),
(55, '2021-04-30', 'IMG-3821.jpg', NULL),
(56, '2021-04-30', '20210125_181241.jpg', 14),
(57, '2021-04-30', '20210125_172730.jpg', NULL),
(58, '2021-04-30', '20210125_173937.jpg', NULL),
(59, '2021-04-30', '20210125_174145.jpg', NULL),
(60, '2021-04-30', '20210125_175452.jpg', NULL),
(61, '2021-04-30', '20210125_175926.jpg', NULL),
(62, '2021-04-30', '20210125_180721.jpg', NULL),
(63, '2021-04-30', '20210125_181241.jpg', NULL),
(64, '2021-05-02', 'gateau-yaourt.JPG', 15),
(65, '2021-05-02', 'gateau-yaourt-1.JPG', NULL),
(66, '2021-05-02', 'gateau-yaourt-2.JPG', NULL),
(67, '2021-05-02', 'gateau-yaourt-3.JPG', NULL),
(68, '2021-05-02', 'gateau-yaourt-4.JPG', NULL),
(69, '2021-05-02', 'IMG-4170.JPG', 16),
(70, '2021-05-02', 'IMG-4171.JPG', NULL),
(71, '2021-05-02', 'IMG-4159.JPG', NULL),
(72, '2021-05-02', 'IMG-4162.JPG', NULL),
(73, '2021-05-02', 'IMG-4160.JPG', NULL),
(74, '2021-05-02', 'IMG-4165.JPG', NULL),
(75, '2021-05-02', 'IMG-4166.JPG', NULL),
(76, '2021-05-02', 'IMG-4167.JPG', NULL),
(77, '2021-05-02', 'IMG-4169.JPG', NULL),
(78, '2021-05-02', 'gommageLevresPresentation.jpg', 17),
(79, '2021-05-02', 'gommageLevres1.png', NULL),
(80, '2021-05-02', 'gommageLevres2.png', NULL),
(81, '2021-05-02', 'deoPresentation.png', 18),
(82, '2021-05-02', 'deo1.jpeg', NULL),
(83, '2021-05-02', 'deo2.jpeg', NULL),
(84, '2021-05-02', 'deo3.png', NULL),
(85, '2021-05-02', 'OrangesPresentation.png', 19),
(86, '2021-05-02', 'Oranges1.png', NULL),
(87, '2021-05-02', 'Oranges2.png', NULL),
(88, '2021-05-02', 'Oranges3.png', NULL),
(89, '2021-05-02', 'PateSelPresentation.png', 20),
(90, '2021-05-02', 'PateSel1.png', NULL),
(91, '2021-05-02', 'PateSel2.png', NULL),
(92, '2021-05-02', 'PateSel3.png', NULL),
(93, '2021-05-02', 'PateSelPresentation.png', NULL),
(94, '2021-05-02', 'bougie2.jpg', 21),
(95, '2021-05-02', 'cirefondue.jpg', NULL),
(96, '2021-05-02', 'support.jpg', NULL),
(97, '2021-05-02', 'filtre.jpg', NULL),
(98, '2021-05-02', 'verser.jpg', NULL),
(99, '2021-05-02', 'bougie2.jpg', NULL),
(100, '2021-05-03', 'accueil-cosmetique.jpg', NULL),
(101, '2021-05-03', 'accueil-cuisine.jpg', NULL),
(102, '2021-05-03', 'accueil-decoration.jpg', NULL),
(103, '2021-05-03', 'accueil-menagers.jpg', NULL),
(104, '2021-05-03', 'IMG-4223.jpg', 22),
(105, '2021-05-03', 'IMG-4209.JPG', NULL),
(106, '2021-05-03', 'IMG-4210.JPG', NULL),
(107, '2021-05-03', 'IMG-4208.JPG', NULL),
(108, '2021-05-03', 'IMG-4207.JPG', NULL),
(109, '2021-05-03', 'IMG-4198.JPG', NULL),
(110, '2021-05-03', 'IMG-4211.jpg', 23),
(111, '2021-05-03', 'IMG-4216.jpg', NULL),
(112, '2021-05-03', 'IMG-4215.jpg', NULL),
(113, '2021-05-03', 'IMG-4214.jpg', NULL),
(114, '2021-05-03', 'IMG-4213.jpg', NULL),
(115, '2021-05-03', 'IMG-4212.jpg', NULL),
(116, '2021-05-03', 'IMG-4230.JPG', 24),
(117, '2021-05-03', 'IMG-4206.JPG', NULL),
(118, '2021-05-03', 'IMG-4204.JPG', NULL),
(119, '2021-05-03', 'IMG-4205.JPG', NULL),
(120, '2021-05-03', 'IMG-4203.JPG', NULL),
(121, '2021-05-03', 'IMG-4202.JPG', NULL),
(122, '2021-05-03', 'IMG-4218.jpg', 25),
(123, '2021-05-03', 'IMG-4201.JPG', NULL),
(124, '2021-05-03', 'IMG-4200.JPG', NULL),
(125, '2021-05-03', 'IMG-4199.JPG', NULL),
(128, '2021-05-05', 'VitrePresentation.png', 27),
(129, '2021-05-05', 'Vitre1.png', NULL),
(130, '2021-05-05', 'Vitre2.png', NULL),
(131, '2021-05-05', 'Vitre3.png', NULL),
(132, '2021-05-05', 'Vitre4.png', NULL),
(133, '2021-05-05', 'Vitre5.png', NULL),
(134, '2021-05-05', 'courge4.png', 28),
(135, '2021-05-05', 'courge1.png', NULL),
(136, '2021-05-05', 'courge2.png', NULL),
(137, '2021-05-05', 'courge3.png', NULL),
(138, '2021-05-05', 'courge4.png', NULL),
(139, '2021-05-08', 'IMG_20201205_205826-min.jpg', 29),
(140, '2021-05-08', 'IMG_20201205_180449-min.jpg', NULL),
(141, '2021-05-08', 'IMG_20201205_180656-min.jpg', NULL),
(142, '2021-05-08', 'IMG_20201205_181145-min.jpg', NULL),
(143, '2021-05-08', 'IMG_20201205_182157-min.jpg', NULL),
(144, '2021-05-08', 'IMG_20201205_182202-min.jpg', NULL),
(145, '2021-05-09', 'IMG-3119-min.jpg', 30),
(146, '2021-05-09', 'IMG-3141-min.jpg', NULL),
(147, '2021-05-09', 'IMG-3143-min.jpg', NULL),
(148, '2021-05-09', 'IMG-3151-min.JPG', NULL),
(149, '2021-05-09', 'IMG-3153-min.JPG', NULL),
(150, '2021-05-09', 'IMG-3154-min.JPG', NULL),
(151, '2021-05-09', 'IMG-3155-min.JPG', NULL),
(152, '2021-05-09', 'calendrier-idee.jpg', NULL),
(155, '2021-05-10', 'IMG-4290.JPG', 32),
(156, '2021-05-10', 'IMG-4292.jpg', NULL),
(157, '2021-05-10', 'IMG-4287.JPG', NULL),
(158, '2021-05-10', 'IMG-4288.JPG', NULL),
(159, '2021-05-10', 'IMG-4289.JPG', NULL),
(160, '2021-05-10', 'IMG-4275.JPG', 33),
(161, '2021-05-10', 'IMG-4268.JPG', NULL),
(162, '2021-05-10', 'IMG-4269.JPG', NULL),
(163, '2021-05-10', 'IMG-4270.JPG', NULL),
(164, '2021-05-10', 'IMG-4271.JPG', NULL),
(165, '2021-05-10', 'IMG-4273.JPG', NULL),
(166, '2021-05-10', 'IMG-4274.JPG', NULL),
(167, '2021-05-10', 'IMG-4327.jpg', 34),
(168, '2021-05-10', 'IMG-4321.JPG', NULL),
(169, '2021-05-10', 'IMG-4322.JPG', NULL),
(170, '2021-05-10', 'IMG-4323.JPG', NULL),
(171, '2021-05-10', 'IMG-4324.JPG', NULL),
(172, '2021-05-10', 'IMG-4325.JPG', NULL),
(173, '2021-05-10', 'IMG-4326.JPG', NULL),
(174, '2021-05-10', 'IMG-4336.JPG', 35),
(175, '2021-05-10', 'IMG-4330.JPG', NULL),
(176, '2021-05-10', 'IMG-4331.JPG', NULL),
(177, '2021-05-10', 'IMG-4332.JPG', NULL),
(178, '2021-05-10', 'IMG-4333.JPG', NULL),
(179, '2021-05-10', 'IMG-4334.JPG', NULL),
(180, '2021-05-10', 'IMG-4335.JPG', NULL),
(181, '2021-05-10', 'IMG-4336.JPG', NULL),
(182, '2021-05-11', 'IMG-4337.jpg', NULL),
(183, '2021-05-11', 'IMG-4338.jpg', NULL),
(184, '2021-05-11', 'IMG-4339.jpg', NULL),
(185, '2021-05-11', 'IMG-4340.jpg', NULL),
(186, '2021-05-11', 'IMG-4341.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `souscrire`
--

DROP TABLE IF EXISTS `souscrire`;
CREATE TABLE IF NOT EXISTS `souscrire` (
  `idabonnement` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `typePaiement` varchar(255) DEFAULT NULL,
  `dateDebut` date NOT NULL,
  `dateresiliation` date DEFAULT NULL,
  PRIMARY KEY (`idabonnement`,`idutilisateur`),
  KEY `Souscrire_Utilisateur0_FK` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `souscrire`
--

INSERT INTO `souscrire` (`idabonnement`, `idutilisateur`, `typePaiement`, `dateDebut`, `dateresiliation`) VALUES
(1, 23, NULL, '2021-04-30', NULL),
(1, 25, NULL, '2021-05-08', NULL),
(3, 6, 'paypal', '2021-05-03', NULL),
(3, 22, 'paypal', '2021-04-29', NULL),
(3, 24, 'paypal', '2021-05-03', NULL),
(3, 26, 'paypal', '2021-05-09', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `suivre`
--

DROP TABLE IF EXISTS `suivre`;
CREATE TABLE IF NOT EXISTS `suivre` (
  `idtuto` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idtuto`,`idutilisateur`),
  KEY `Suivre_Utilisateur0_FK` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tuto`
--

DROP TABLE IF EXISTS `tuto`;
CREATE TABLE IF NOT EXISTS `tuto` (
  `idtuto` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreation` date NOT NULL,
  `theme` varchar(255) NOT NULL,
  `titreTuto` varchar(255) NOT NULL,
  `textpresentation` text NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `idabonnement` int(11) DEFAULT NULL,
  PRIMARY KEY (`idtuto`),
  KEY `tuto_utilisateur_FK` (`idutilisateur`),
  KEY `tuto_abonnement_FK` (`idabonnement`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tuto`
--

INSERT INTO `tuto` (`idtuto`, `dateCreation`, `theme`, `titreTuto`, `textpresentation`, `idutilisateur`, `idabonnement`) VALUES
(6, '2021-04-26', 'couture', 'Scrunchie', 'Besoin d\'un chouchou pour attacher vos cheveux ? Ce tuto est fait pour vous!', 6, 1),
(11, '2021-04-29', 'produit_menagers', 'Pastille Lave-Vaisselle', 'Marre des pastilles pour le lave-vaisselle nocives pour l\'environnement ? Ce tuto est fait pour vous !', 22, 1),
(12, '2021-04-30', 'cosmetique', 'Savon exfoliant', 'Marre des bouteilles de gel douche qui encombrent votre salle de bain ? Ce savon exfoliant est fait pour vous !', 22, 1),
(13, '2021-04-30', 'cuisine', 'Compote de pommes', 'Des fruits trop mûrs ? Ce tuto est fait pour vous !', 6, 1),
(14, '2021-04-30', 'couture', 'Couvercle', 'Envie de diminuer votre utilisation de film plastique ? Ce tuto est fait pour vous!', 6, 1),
(15, '2021-05-02', 'cuisine', 'Gâteau au yaourt', 'Envie d\'un gâteau simple et rapide ? Ce tuto est fait pour vous !', 23, 1),
(16, '2021-05-02', 'decoration', 'Calendrier', 'Envie d\'allier décoration et organisation ? Ce tuto est fait pour vous !', 23, 1),
(17, '2021-05-02', 'cosmetique', 'Gommage Lèvres', 'Vos lèvres ont besoin d\'un petit coup de boost ? Ce gommage maison est fait pour vous !', 22, 1),
(18, '2021-05-02', 'cosmetique', 'Déodorant', 'Marre des déodorants de grandes surfaces qui agressent votre peau ? Ce déodorant naturel est fait pour vous !', 22, 3),
(19, '2021-05-02', 'decoration', 'Oranges séchées', 'Des oranges abîmées ? Ce tuto est fait pour vous !', 22, 1),
(20, '2021-05-02', 'decoration', 'Pâte à sel', 'Besoin d\'une activité manuelle pour vos enfants ? Ce tuto est fait pour vous !', 22, 3),
(21, '2021-05-02', 'decoration', 'Bougie', 'Envie de réutiliser vos vieilles bougies ? Ce tuto est fait pour vous !', 22, 1),
(22, '2021-05-03', 'cosmetique', 'Masque cheveux', 'Vos cheveux manquent de brillance ? Ce tuto est fait pour vous !', 23, 1),
(23, '2021-05-03', 'cosmetique', 'Crème pour les mains', 'Vous avez les mains sèches ? Ce tuto est fait pour vous !', 23, 3),
(24, '2021-05-03', 'produit_menagers', 'Lessive', 'Marre des bidons de lessive peu économiques ? Ce tuto est fait pour vous !', 23, 3),
(25, '2021-05-03', 'produit_menagers', 'Adoucissant', 'Marre des adoucissants peu écologiques ? Ce tuto est fait pour vous !', 23, 3),
(27, '2021-05-05', 'produit_menagers', 'Produit à vitres', 'Marre des produits à vitres coûteux et inefficaces ? Ce tuto est fait pour vous !', 22, 1),
(28, '2021-05-05', 'cuisine', 'Graines de courge au four', 'Un apéritif de prévu ou une salade tristounette ? Ce tuto est fait pour vous !', 22, 1),
(29, '2021-05-08', 'couture', 'Coton réutilisable', 'Envie de faire des économies en utilisant des cotons réutilisables ? Ce tuto est fait pour vous!', 25, 1),
(30, '2021-05-09', 'decoration', 'Toile', 'Envie d\'une petite décoration pour décorer votre intérieur ?\r\nCe tuto est fait pour vous !', 25, 3),
(32, '2021-05-10', 'cuisine', 'Gâteau au chocolat', 'Envie d\'un dessert simple et rapide ? Ce tuto est fait pour vous!', 6, 3),
(33, '2021-05-10', 'cuisine', 'Crème Brûlée', 'Besoin d\'un dessert pour toute la famille ? Ce tuto est fait pour vous!', 6, 3),
(34, '2021-05-10', 'couture', 'Sac', 'Envie d\'arrêter les sacs plastiques ? Ce tuto est fait pour vous!', 26, 3),
(35, '2021-05-10', 'produit_menagers', 'Spray nettoyant multi-surfaces', 'Envie d\'un nettoyant naturel et peu cher ? Ce tuto est fait pour vous !', 26, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idutilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `themefavorie` varchar(100) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `prenom` varchar(80) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  PRIMARY KEY (`idutilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `themefavorie`, `nom`, `prenom`, `email`, `mdp`, `pseudo`, `dateNaissance`) VALUES
(6, 'couture', 'TESSIER', 'amelie', 'amelie.tessier02@gmail.com', '$6$rounds=5000$14ecoaj87enek720$rn7l6o7zlDuRmJMBogUK3FOld9ePSzG3n5pdzoxc55dnLvcF8woyaZN0KoPGGeU93Yz6G0o7SewK0yeIomRfd.', 'amel22', '2002-08-02'),
(22, 'decoration', 'Gaudron', 'Louise', 'louise.gaudron@hotmail.com', '$6$rounds=5000$14ecoaj87enek720$7GTTNGwDo4tPtzRN3kBFh8D8yNa/DmJEHE2uRNfYBLFO.bWs5UCH0XfI9FYqnk1Tr.b9hUtbyYxy0eNP2S5jw1', 'Loulou', '2002-10-09'),
(23, 'cuisine', 'Jallois', 'anais', 'anaisjallois@gmail.com', '$6$rounds=5000$14ecoaj87enek720$IvNgqRnk1f4TBB8X/.x7Co1G/9KVxCe5.QvteDEljPD.T.GEoRVEJtIOOQ4tIsDevzjKZTZW4sc1ZcYGeIwSG/', 'anaisjallois', '2002-02-28'),
(24, 'couture', 'Béatrice', 'TESSIER', 'fam.tessier@live.fr', '$6$rounds=5000$14ecoaj87enek720$QFz/iKfPnDfBXvBsUV9jECbOHcQbWa7meKpvCfXUIjL0I4K44CriyAV9vWqaA3sA1rGRnsIPAJWlJqFo/x.tN1', 'beatt', '2021-05-06'),
(25, 'couture', 'LAURENT', 'Charlotte', 'charlottelau50@gmail.com', '$6$rounds=5000$14ecoaj87enek720$NjgEy4cDigbR3CnaoLj6bwgPy7aR3zuf2/cvO1qrsF7weQ.w64V7q24wcNT2e23apdbnoInUJx7OJvPZkz87g/', 'charlottelau', '2003-05-10'),
(26, 'cosmetique', 'Maury', 'Elise', 'elisejallois@gmail.com', '$6$rounds=5000$14ecoaj87enek720$N4BxZIduDOBlAHkJv1ChnOW0LYRiUb2PCK2eSvWwnszPK.KqHttsdE8LxRoEcsKJgW/muhJ9bCukhEE616UQU1', 'Lilimaury', '1977-03-28');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `Commentaire_Tuto0_FK` FOREIGN KEY (`idtuto`) REFERENCES `tuto` (`idtuto`),
  ADD CONSTRAINT `Commentaire_Utilisateur_FK` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);

--
-- Contraintes pour la table `etape`
--
ALTER TABLE `etape`
  ADD CONSTRAINT `etape_photo_FK` FOREIGN KEY (`idphoto`) REFERENCES `photo` (`idphoto`),
  ADD CONSTRAINT `etape_tuto_FK` FOREIGN KEY (`idtuto`) REFERENCES `tuto` (`idtuto`);

--
-- Contraintes pour la table `necessite`
--
ALTER TABLE `necessite`
  ADD CONSTRAINT `necessite_Tuto0_FK` FOREIGN KEY (`idtuto`) REFERENCES `tuto` (`idtuto`),
  ADD CONSTRAINT `necessite_materiel_FK` FOREIGN KEY (`idmateriel`) REFERENCES `materiel` (`idmateriel`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `Photo_Tuto_FK` FOREIGN KEY (`idtuto`) REFERENCES `tuto` (`idtuto`);

--
-- Contraintes pour la table `souscrire`
--
ALTER TABLE `souscrire`
  ADD CONSTRAINT `Souscrire_Abonnement_FK` FOREIGN KEY (`idabonnement`) REFERENCES `abonnement` (`idabonnement`),
  ADD CONSTRAINT `Souscrire_Utilisateur0_FK` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);

--
-- Contraintes pour la table `suivre`
--
ALTER TABLE `suivre`
  ADD CONSTRAINT `Suivre_Tuto_FK` FOREIGN KEY (`idtuto`) REFERENCES `tuto` (`idtuto`),
  ADD CONSTRAINT `Suivre_Utilisateur0_FK` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);

--
-- Contraintes pour la table `tuto`
--
ALTER TABLE `tuto`
  ADD CONSTRAINT `tuto_abonnement_FK` FOREIGN KEY (`idabonnement`) REFERENCES `abonnement` (`idabonnement`),
  ADD CONSTRAINT `tuto_utilisateur_FK` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
