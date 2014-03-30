-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: So 15.Mar 2014, 09:41
-- Verzia serveru: 5.6.12-log
-- Verzia PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `greenshop`
--

CREATE DATABASE IF NOT EXISTS `greenshop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `greenshop`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL DEFAULT '',
  `cat_description` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`cat_id`),
  KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Sťahujem dáta pre tabuľku `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`, `cat_description`) VALUES
(0, 'placeholder_category', 'this is a placeholder category required for internal program purposes'),
(1, 'Bonsai Trees', 'Bonsai is a Japanese art form using miniature trees grown in containers. Similar practices exist in other cultures, including the Chinese tradition of penjing from which the art originated.'),
(2, 'Palm Trees', 'Palm trees are a family of plants. This family is called Arecaceae. Palm trees are not true trees. They grow in hot climates.'),
(3, 'Cactus Plants', 'Most cacti live in habitats subject to at least some drought. Many live in extremely dry environments, even being found in the Atacama Desert, one of the driest places on earth.'),
(4, 'Flowering Tropicals', 'A flower, sometimes known as a bloom or blossom, is the reproductive structure found in flowering plants (plants of the division Magnoliophyta, also called angiosperms).'),
(5, 'Orchids', 'Orchidaceae is a diverse and widespread family of flowering plants with blooms that are often colourful and often fragrant, commonly known as the orchid family. Along with the Asteraceae.');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `od_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `od_date` date NOT NULL,
  `od_status` enum('New','Shipped','Completed','Cancelled') NOT NULL DEFAULT 'New',
  `od_name` varchar(50) NOT NULL DEFAULT '',
  `od_address` varchar(100) NOT NULL DEFAULT '',
  `od_city` varchar(100) NOT NULL DEFAULT '',
  `od_postal_code` varchar(10) NOT NULL DEFAULT '',
  `od_cost` varchar(10) DEFAULT '0.00',
  PRIMARY KEY (`od_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Sťahujem dáta pre tabuľku `tbl_order`
--

INSERT INTO `tbl_order` (`od_id`, `user_id`, `od_date`, `od_status`, `od_name`, `od_address`, `od_city`, `od_postal_code`, `od_cost`) VALUES
(9, 101, '2014-03-15', 'Completed', 'Ivan Molcan', 'Ambroseho 26/B', 'Bratislava', '841 05', '162.68'),
(10, 101, '2014-03-15', 'Cancelled', 'Ivan Molcan', 'Ambroseho 26/B', 'Bratislava', '841 05', '108.49'),
(11, 102, '2014-03-15', 'Completed', 'Daniel Bene', 'Adyho 28', 'Lucenec', '984 01', '202.7'),
(12, 102, '2014-03-15', 'Shipped', 'Daniel Bene', 'Adyho 28', 'Lucenec', '984 01', '131.2'),
(13, 102, '2014-03-15', 'New', 'Daniel Bene', 'Adyho 28', 'Lucenec', '984 01', '82.21');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_order_item`
--

CREATE TABLE IF NOT EXISTS `tbl_order_item` (
  `od_id` int(10) unsigned NOT NULL,
  `pd_id` int(10) unsigned NOT NULL,
  `od_qty` int(10) unsigned NOT NULL,
  PRIMARY KEY (`od_id`,`pd_id`),
  KEY `pd_id` (`pd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `tbl_order_item`
--

INSERT INTO `tbl_order_item` (`od_id`, `pd_id`, `od_qty`) VALUES
(9, 15, 1),
(9, 22, 1),
(9, 14, 1),
(10, 19, 1),
(10, 27, 1),
(11, 29, 1),
(11, 17, 1),
(12, 11, 1),
(12, 12, 1),
(12, 16, 1),
(13, 20, 1),
(13, 21, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `pd_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(10) unsigned NOT NULL,
  `pd_name` varchar(99) NOT NULL DEFAULT '',
  `pd_description` text NOT NULL,
  `pd_price` decimal(7,2) NOT NULL DEFAULT '0.00',
  `pd_qty` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pd_image` varchar(99) DEFAULT NULL,
  PRIMARY KEY (`pd_id`),
  KEY `cat_id` (`cat_id`),
  KEY `pd_name` (`pd_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Sťahujem dáta pre tabuľku `tbl_product`
--

INSERT INTO `tbl_product` (`pd_id`, `cat_id`, `pd_name`, `pd_description`, `pd_price`, `pd_qty`, `pd_image`) VALUES
(0, 0, 'deleted product', 'Placeholder for deleted products', '0.00', 0, NULL),
(10, 1, 'Artistic Japanese Bonsai Potted Tree', 'The term bonsai literally translated from Japanese means tray planting or tree in pot. The term refers specifically to the training and artistic vision applied to the tree; ultimately this will give the illusion of an aged miniature tree in nature. It is more than just a little tree, it is an attempt to represent nature itself in a small pot.', '49.95', 86, 'bonsai-1.jpg'),
(11, 1, 'Bonsai Acer Palma', 'Acer palmatum , the Redleaf maple are known to make wonderful informal upright bonsai. Native to Japan, China and Korea. In nature, it is a small growing tree to 5 meters with a dense, spreading habit. This small deciduous tree is a very showy. These trees have the most beautiful red leaves in the Spring and Autumn.  The leaves are very small and delicate.', '32.80', 33, 'bonsai-2.jpg'),
(12, 1, 'Ficus Benjamina Weeping Fig Fabulous Bonsai', 'Originates from India evergreen tree green letahery leaves this makes a fantastic bonsai as you can see, sow the seed onto the surface of well draining soil keep damp,and in filtered sun', '65.00', 66, 'bonsai-3.jpg'),
(13, 1, 'Bonsai Chinese Elm', 'The Chinese Elm is one of the most common varieties of Bonsai. Elms grows fast making it easy to build up a dense foliage mass by pruning alone within a few years. With them being quite an adaptable species they are more tolerant to imperfect growing conditions. Fortunately due to their natural vigour they are very good at recovering from accidental neglect. This is what makes them ideal trees for beginners', '24.70', 118, 'bonsai-4.jpg'),
(14, 1, 'Cryptomeria japonica (Japanese Cedar)', 'An evergreen conifer which is the national tree of Japan, often planted near temples for symbolic reasons. Makes an excellent bonsai tree as it is easily dwarfed and the foliage is dense which allows ‘cloud-pruning’ to enhance bonsai forms\r\nHeight: up to 20 m (65 ft) but usually smaller in the UK. Can be kept dwarfed as a bonsai, Plant type: Evergreen conifer, Hardiness: Hardy to -15C (5F), Sun Exposure: Full sun to semi-shade, Soil: Moist and well-drained, fertile soils. Prefers deeper soils \r\nPropagation methods: Seeds and cuttings', '71.50', 45, 'bonsai-5.jpg'),
(15, 1, 'Carpinus turczaninowii (Korean hornbeam)', 'The Korean hornbeam is a much smaller tree than its European cousin, getting around 20-25 feet tall in the ground, but makes a perfect bonsai specimen as it is easily ‘dwarfed’ to less than a couple of feet tall within a bonsai pot. Its leaves, at around 3cm in length, are red and purple in the spring, turning green, and then putting on a spectacular show in the autumn with colours of yellow, orange and red.  It doesn’t end there though, as it has one of the most beautiful bare forms over the winter months, so looks stunning all year round. It has been a favourite specimen for bonsai growers for a very long time', '52.70', 58, 'bonsai-6.jpg'),
(16, 1, 'Japanese White Pine Bonsai Tree', 'Nice shaped Pine Bonsai Tree measuring approx. 20cm high by 22cm from the rim of the included pot. The tree will not need repotting this year and is ready for its secondary wiring; the current wire has been fully removed now the basic shape has set.  Frost protection in winter while its smaller and a nice bright outdoor position once frost have passed. The tree is just starting to open its leaves.', '33.40', 75, 'bonsai-7.jpg'),
(17, 1, 'Rare Black Spruce Bonsai Tree', 'Not often seen Black Spruce Bonsai Tree.  The tree, as shown, stands approx. 56cm high by 48cm wide from the rim of its ceramic pot. A great looking tree in the making.  Spruce easily back bud so development of this tree should be a pleasure.', '50.00', 60, 'bonsai-8.jpg'),
(18, 2, 'Fat Pony Tail Palm for shohin bonsai tree', 'Nice fat Pony tail palm  for indoor/outdoor bonsai specimen.  Super fat trunk and strap like leaves stay year round.  This is a very easy to grow succulant.  Best outdoors in full sun or part shade but may also be grown indoors with enough light.  Plant shown in the photos is the actual one you will receive, shipped in a 6" plastic pot.', '18.99', 135, 'palm-1.jpg'),
(19, 2, 'Brussels Ponytail Palm Bonsai', 'Ponytail Palms are the perfect accent bonsai for low maintenance enthusiast. These trees thrive in low light conditions, and require infrequent watering and feeding. The delightful "fountains of foliage" add soft, cascading lines to the indoor landscape.', '59.99', 42, 'palm-2.jpg'),
(20, 2, 'Brussels Sego Palm Bonsai', 'This easy to grow palm with its dark green foliage is ideal for that office or home spot that does not get much sunlight.', '69.22', 27, 'palm-3.jpg'),
(21, 2, 'Bonsai Live Sago Palm Tree', 'The sago palm is also referred to as the Japanese sago palm,  and the funeral palm. Sago palms are slow-growing, evergreen plants that grow to about  10 to 12 feet in height. They can be planted outdoors, or in containers, and make good  bonsai plants. The sago palm is a native plant to Japan, and is hardy in USDA zones 8  to 10. Plant a sago palm in a bright, sun-filled location, and make  sure its given fast-draining, preferably sandy soil.', '12.99', 86, 'palm-4.jpg'),
(22, 3, 'Euphorbia neohumbertii exotic madagascar palm cacti rare succulent', 'This plant look like small palm,  nice Euphorbia from Madagarcar', '9.99', 71, 'cactus-1.jpg'),
(23, 3, 'Euphorbia Iharanae exotic color madagascar rare bonsai blue cacti', 'This plant is native to the Southwestern USA and Mexico. This is the actual plant you will receive. It is shown in a 3” pot. This plant is showing some nice variegation!! This plant grows thick squat stems with very short curly spines or completely spineless, it branches from the base to form tight mounds. This plant grows best in full sun to partial shade. Water the plant in the summer and give little to none during the winter when it is dormant. The flower color is an orange/red Claret Cup.', '19.99', 54, 'cactus-2.jpg'),
(24, 3, 'Etiolated Myrtillocactus geometrizans San Pedro cactus', 'The San Pedro is a cactus with pillars with 4 to 9 ribbons. It grows quite fast, has a strong root system and branches of from the base of the stem. The San Pedro just keeps growing until it succumbs under its own weight. The fallen cactus will in nature root again and produce many new branches.', '32.00', 102, 'cactus-3.jpg'),
(25, 3, 'Echinocereus brandegeei seedling cactus cacti Baja California', 'This plants native habitat is Baja California Peninsula & Some Gulf Islands, Mexico. This is the actual plant that you will receive. This seedling is shown in a 3.5” pot. This plant will branch from the base to form a low growing cluster. Grow in sun to part shade. The flower is a purple/red in color.', '28.50', 95, 'cactus-4.jpg'),
(26, 3, 'Trichocereus Pachanoi San Pedro Cactus', 'Trichocereus Pachanoi is perhaps the most famous of the trichocereus species.  This easy-to-grow, ornamental, columnar cactus is popular for a variety of reasons.  It is a sacred symbol amongst the various peoples of its native habitat, which stretches from the Andes of Peru to Bolivia to Ecuador.  A common landscaping cactus, pachanoi is also tolerant of a wide variety of conditions and can handle more water and fertilization than most cacti, making it a good species for beginners.  Its small spines also make it easier to handle for those who are not experienced with dealing with sharp spines or those who have curious kids or pets that may be injured by larger spines.  Additionally, it is a rapid grower, making it a favorite grafting stock for speeding up the progress of slower-growing cacti such as astrophytum and ariocarpus.  Under ideal conditions, San Pedro can grow up to 18 inches per year and will readily shoot off new pups (branches).  Frost hardy to about 26 degrees Fahrenheit, these cacti can be raised outdoors all year in Zone 9 or warmer.  Otherwise, it should be kept in medium to large pots that can be moved inside during the winter months.  Plants can be watered frequently during the summer months, sometimes as often as every two days if the top inch or two of the soil is dry.  During the winter, they should be slowly acclimated to cool, dry, dark conditions to avoid stretching that could damage the aesthetics and structural integrity of the plant.  When breaking dormancy in the spring, a reverse process of slowly introducing the factors necessary for growth may be beneficial for the same reason.  For optimal skin color, T. pachanoi should be kept in partial rather than full sun and the soil should be well-draining and rich in organic nutrients and minerals.  Its blooms are large, white and have a strong, pleasant perfume.', '71.30', 38, 'cactus-5.jpg'),
(27, 3, 'Aloe falcata - Cactus / Succulent / Exotic', 'Aloe falcata - It is a low plant with dense, compact growing rosette of leaves often pointing outwards. The leaves are relatively mild, but the leaf margins have small spines on them, have an almost bluish. The inflorescence is branched sometimes up to a dozen spikes of flowers that can be seen coming out of the crown. The flower color ranges from red to pink-red, sometimes yellow.', '48.50', 68, 'cactus-6.jpg'),
(28, 4, 'Lagerstroemia speciosa Tree Seeds Queens Flower Banaba', 'A more beautiful small tree is hard to finds than this one! This multi-branched tree is perfect for deck gardens, bonsai, or grow in the landscape as a standard. We have several growing in pots on the deck. Flowers of light pink to light purple bloom profusely from mid summer to fall. Small seed heads follow giving the tree an attractive look through winter. Brilliant green rounded leaves accent the gray-brown trunk that is smooth and mottled and gives the tree a most unique look. Prune to shape as desired or keep small.', '28.70', 56, 'flowering-1.jpg'),
(29, 4, 'Torch Ginger Etlingera elatior Seeds Flowering Tropical', 'A gorgeous plant forming clumps of canes that grow up to 10 feet.  Leaves are bright green on the surface and purple-green underneath.  Impressive buds burst into large bright red heads that nestle themselves in a crimson cone.  This tropical herbaceous perennial is perfect for use as a cut flower.', '49.50', 80, 'flowering-2.jpg'),
(30, 4, 'White canna indica lily flower', 'Canna indica L. (also known as saka siri, Indian shot, canna, bandera, chancle, coyol, or platanillo, Kardal in Marathi, Sanskrit: vankelee, sarvajaya) is a species of the Canna genus, belonging to the family Cannaceae, a native of the Caribbean and tropical Americas that is also widely cultivated as a garden plant. It is a perennial growing from 0.5m to 2.5m, depending on the variety. It is hardy to zone 10 and is frost tender. The flowers are hermaphrodite. The seeds are small, globular, black pellets, hard and heavy enough to sink in water. They resemble shotgun pellets giving rise to the plants common name of Indian Shot. They are widely used for jewellery. The seeds are also used as the mobile elements of the kayamb, a musical instrument from Reunion, as well as the hosho, a gourd rattle from Zimbabwe, where the seeds are known as hota seeds.', '83.75', 45, 'flowering-3.jpg'),
(31, 4, 'Bauhinia Purpurea, Pink/Purple Orchid Flowering Tree', 'Here is another eye catcher native to South China, Hong Kong, and Southeast Asia! Staggeringly beautiful when in bloom, and it blooms for several months. The purple, pink, and lavender petals arranged closely resemble an orchid, though its not related to the orchid at all, can grow to 5 inches wide. This tree can grow 20-40 tall and 10-20 wide. Leaves that are shaped like cow hoofs are 4-6 big.Full sun to light shade, zones 9-11This tree usually will survive light freezes down to 22F (after dropping its leaves), but will stay shrub-like where its subjected to frost and freezing temperatures. Water freely during the summer, and less so in the winter.', '62.13', 37, 'flowering-4.jpg'),
(32, 4, 'Dark red small petal canna indica lily flower plant', 'Canna indica L. (also known as saka siri, Indian shot, canna, bandera, chancle, coyol, or platanillo, Kardal in Marathi, Sanskrit: vankelee, sarvajaya) is a species of the Canna genus, belonging to the family Cannaceae, a native of the Caribbean and tropical Americas that is also widely cultivated as a garden plant. It is a perennial growing from 0.5m to 2.5m, depending on the variety. It is hardy to zone 10 and is frost tender. The flowers are hermaphrodite. The seeds are small, globular, black pellets, hard and heavy enough to sink in water. They resemble shotgun pellets giving rise to the plants common name of Indian Shot. They are widely used for jewellery. The seeds are also used as the mobile elements of the kayamb, a musical instrument from Reunion, as well as the hosho, a gourd rattle from Zimbabwe, where the seeds are known as hota seeds.', '94.26', 76, 'flowering-5.jpg'),
(33, 5, 'Fragrant Stanhopea tigrina Species Orchid Plant', 'This listing is for 1 near blooming size Stanhopea tigrina x self. Well established plants in 3.5" pots. Please note the picture of the 2 plants is only to show average plant sizes. This is the progeny from one our "tricolor" tigrinas. Big chocolate markings with yellow highlights on the petals and a white and yellow background with purple spots on the lip and column.', '113.14', 33, 'orchids-1.jpg'),
(34, 5, 'Mature Masdevallia rolfeana Orchid Species Plant', 'This plant is Masdevallia rolfeana .This is a blooming size plant in a 3.25" pot. If you are into Masdevallias, this is a nice, easy to grow species. Beautiful dark mahogany flowers with a yellow throat. The plants get huge but are best kept smaller as the flowers tend to hide in the foliage on short stems. This is a great Masdevalila for mounting, it shows off the flowers.', '99.99', 25, 'orchids-2.jpg'),
(35, 5, 'Gongora cassidae', 'This listing is for Gongora cassidae. Well-established blooming size plant in a 4" pot. Here is a link to the amazing website orchidspecies.com for more info and pictures of the flower. This easy to grow plant has very unusual flowers that some people think look like helmets. The flower spike are pendant and have 4-6 flowers. The thing I like best is the fragrance. Smells very much like orange blossoms. Very nice lush green foliage. These plants prefer bright indirect sun, moderate temps and even watering throughout the year. They do not like to dry out.', '153.20', 37, 'orchids-3.jpg');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `user_email` varchar(25) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_is_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Sťahujem dáta pre tabuľku `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `password`, `user_email`, `created_at`, `updated_at`, `user_is_admin`) VALUES
(100, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@admin.com', '2014-03-15 09:17:21', '2014-03-15 09:17:21', 1),
(101, 'Ivan', 'e10adc3949ba59abbe56e057f20f883e', 'lineer2@gmail.com', '2014-03-15 09:18:45', '2014-03-15 09:18:45', 0),
(102, 'dbene', 'e10adc3949ba59abbe56e057f20f883e', 'nzgrim@gmail.com', '2014-03-15 09:21:36', '2014-03-15 09:21:36', 0);


--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `tbl_order`
--

ALTER TABLE `tbl_order`
  ADD CONSTRAINT `user_order` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);


--
-- Obmedzenie pre tabuľku `tbl_order_item`
--

ALTER TABLE `tbl_order_item`
  ADD CONSTRAINT `tbl_order_item_ibfk_1` FOREIGN KEY (`od_id`) REFERENCES `tbl_order` (`od_id`),
  ADD CONSTRAINT `tbl_order_item_ibfk_2` FOREIGN KEY (`pd_id`) REFERENCES `tbl_product` (`pd_id`);


--
-- Obmedzenie pre tabuľku `tbl_product`
--

ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
