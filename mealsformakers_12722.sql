-- --------------------------------------------------------

-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for mealsformakers
CREATE DATABASE IF NOT EXISTS `mealsformakers` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mealsformakers`;

-- Dumping structure for table mealsformakers.categorytable
CREATE TABLE IF NOT EXISTS `categorytable` (
  `id` varchar(50) NOT NULL,
  `catname` text,
  `catdesc` text,
  `iconthemeenergy` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mealsformakers.categorytable: ~6 rows (approximately)
DELETE FROM `categorytable`;
/*!40000 ALTER TABLE `categorytable` DISABLE KEYS */;
INSERT INTO `categorytable` (`id`, `catname`, `catdesc`, `iconthemeenergy`) VALUES
	('0a292fac', 'Appetizers', '', 'icon-themeenergy_pasta'),
	('2cc4ac0e', 'Desserts', '', 'icon-themeenergy_cupcake'),
	('612f0956', 'Dinner', '', 'icon-themeenergy_soup2'),
	('8e1f5b8b', 'Snacks', '', 'icon-themeenergy_fried-potatoes'),
	('ee4e839b', 'Tanghalian', '', 'icon-themeenergy_turkey'),
	('efabcccb', 'Miscellaneous', '', 'icon-themeenergy_sushi');
/*!40000 ALTER TABLE `categorytable` ENABLE KEYS */;

-- Dumping structure for table mealsformakers.commtable
CREATE TABLE IF NOT EXISTS `commtable` (
  `commIndex` varchar(50) NOT NULL,
  `userIndex` varchar(50) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text,
  `recipeIndex` text,
  `dte` datetime DEFAULT NULL,
  PRIMARY KEY (`commIndex`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mealsformakers.commtable: ~2 rows (approximately)
DELETE FROM `commtable`;
/*!40000 ALTER TABLE `commtable` DISABLE KEYS */;
INSERT INTO `commtable` (`commIndex`, `userIndex`, `rating`, `comment`, `recipeIndex`, `dte`) VALUES
	('0Sei5PR', 'BT8S88d', -1, 'Haha! So simple but delicious!', 'Tha81Md', '2022-01-27 04:13:54'),
	('7hNJ15Y', 'wbPsYSd', -1, 'Wow, that tastes amazing!', 'cXSk0OP', '2022-01-27 04:12:42');
/*!40000 ALTER TABLE `commtable` ENABLE KEYS */;

-- Dumping structure for table mealsformakers.ingtable
CREATE TABLE IF NOT EXISTS `ingtable` (
  `ingIndex` varchar(50) NOT NULL,
  `ingName` text,
  `ingDesc` text,
  `ingPrice` text,
  `ingPic` text,
  PRIMARY KEY (`ingIndex`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mealsformakers.ingtable: ~36 rows (approximately)
DELETE FROM `ingtable`;
/*!40000 ALTER TABLE `ingtable` DISABLE KEYS */;
INSERT INTO `ingtable` (`ingIndex`, `ingName`, `ingDesc`, `ingPrice`, `ingPic`) VALUES
	('1rgtfTx', 'Siling pang-sigang', 'null', 'null', 'null'),
	('2o2qkR7', 'Kangkong, sliced bundled', 'null', 'null', 'null'),
	('2w3UVV9', 'Parmesan Cheese', 'null', 'null', 'null'),
	('4ip5jVa', 'Olive Oil', 'null', 'null', 'null'),
	('5CMi6Rp', 'Grilled liempo, cut into serving pieces', 'null', 'null', 'null'),
	('7AyWUyB', 'Marinara Sauce', 'null', 'null', 'null'),
	('7cPlnrW', 'Dough', 'null', 'null', 'null'),
	('aasdsdasdasd', 'Egg', '', '', ''),
	('asdasaasdasd', 'Salt', '', '', ''),
	('asdasdaadsd', 'Bacon', '', '', ''),
	('asdasdasaad', 'Carrot', '', '', ''),
	('asdasdasd', 'Cabbage', '', '', ''),
	('asdasdasdas', 'Cabbage', '', '', ''),
	('asdasxczdasd', 'Chicken Thigh', '', '', ''),
	('asdzxcasdasd', 'Garlic', '', '', ''),
	('aV3shMn', 'Brown Sugar', 'null', 'null', 'null'),
	('B48wGUX', 'Onions, quartered', 'null', 'null', 'null'),
	('BAB5bIP', 'Shiitake Mushroom', 'null', 'null', 'null'),
	('CESA53C', 'Buns', 'null', 'null', 'null'),
	('Cpx2UGf', 'Okra, sliced', 'null', 'null', 'null'),
	('cqXLxNC', 'Salmon', 'null', 'null', 'null'),
	('DgXTFl9', 'Basil', 'null', 'null', 'null'),
	('dUuzTSM', 'Bread', 'null', 'null', 'null'),
	('e8p7d7b', 'Parmesan', 'null', 'null', 'null'),
	('ebFE9Gm', 'Condensed Milk', 'null', 'null', 'null'),
	('FkshecV', 'Knorr Sinigang sa Sampalok Mix (40g)', 'null', 'null', 'null'),
	('FmGZ8eS', 'English muffin', 'null', 'null', 'null'),
	('fSQV98v', 'Vegetable Broth', 'null', 'null', 'null'),
	('FWJksOB', 'Powdered Milk', 'null', 'null', 'null'),
	('hXnwi0h', 'Fruits', 'null', 'null', 'null'),
	('I6NleH0', 'ewewewwew', 'null', 'null', 'null'),
	('J3pp5qG', 'Radish, sliced', 'null', 'null', 'null'),
	('KgCsHJ6', 'Onion', 'null', 'null', 'null'),
	('LBzZnBn', 'Banana', 'null', 'null', 'null'),
	('LH5mEEB', 'Water', 'null', 'null', 'null'),
	('LWacGlt', 'Soy Sauce', 'null', 'null', 'null'),
	('m9q3cUi', 'String Beans', 'null', 'null', 'null'),
	('mAZrDLd', 'Chocolate', 'null', 'null', 'null'),
	('mdSkYIl', 'Clams', 'null', 'null', 'null'),
	('MkzKPBO', 'Unsalted Butter', 'null', 'null', 'null'),
	('n5qnZ0Y', 'Butter', 'null', 'null', 'null'),
	('nQuQJCZ', 'Graham crackers crushed', 'null', 'null', 'null'),
	('oldwpOE', 'Vinegar', 'null', 'null', 'null'),
	('PiszPBO', 'Cornstarch', 'null', 'null', 'null'),
	('QK59RoR', 'Hollandaise', 'null', 'null', 'null'),
	('qyLo5Pk', 'tomato', 'null', 'null', 'null'),
	('rdlBSvE', 'corn', 'null', 'null', 'null'),
	('Rxm393y', 'Sitaw, sliced bundled', 'null', 'null', 'null'),
	('s1CoJL9', 'Gabi, quartered', 'null', 'null', 'null'),
	('t0QNyZ6', 'Sugar', 'null', 'null', 'null'),
	('uBv2Ttx', 'Cooking Oil', 'null', 'null', 'null'),
	('VPcnrCm', 'Rosemary', 'null', 'null', 'null'),
	('W3TKubc', 'Rice washing', 'null', 'null', 'null'),
	('wqdXiWm', 'Lemon', 'null', 'null', 'null'),
	('y1nsxJO', 'Lumpia wrappers', 'null', 'null', 'null'),
	('Y4hrj7v', 'Flour', 'null', 'null', 'null'),
	('ZX765vH', 'Tomatoes, quartered', 'null', 'null', 'null');
/*!40000 ALTER TABLE `ingtable` ENABLE KEYS */;

-- Dumping structure for table mealsformakers.msgtable
CREATE TABLE IF NOT EXISTS `msgtable` (
  `msgIndex` varchar(50) NOT NULL,
  `userIndexFrom` varchar(50) DEFAULT NULL,
  `userIndexTo` varchar(50) DEFAULT NULL,
  `msgDate` datetime DEFAULT NULL,
  `msg` text,
  PRIMARY KEY (`msgIndex`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mealsformakers.msgtable: ~15 rows (approximately)
DELETE FROM `msgtable`;
/*!40000 ALTER TABLE `msgtable` DISABLE KEYS */;
INSERT INTO `msgtable` (`msgIndex`, `userIndexFrom`, `userIndexTo`, `msgDate`, `msg`) VALUES
	('5ZvHkly', 'Wi8LrMl', 'wbPsYSd', '2022-01-27 05:04:19', 'What up'),
	('bIfXGB8', 'wbPsYSd', 'BT8S88d', '2022-01-27 04:55:39', 'test test test'),
	('Dc55Q3L', 'BT8S88d', 'wbPsYSd', '2022-01-27 07:33:44', 'meh'),
	('fjWwbYo', 'wbPsYSd', 'BT8S88d', '2022-01-27 04:55:09', 'hey'),
	('GnmxPfe', 'BT8S88d', 'wbPsYSd', '2022-01-27 04:52:55', 'asdasd'),
	('IX1pFw8', 'BT8S88d', 'wbPsYSd', '1999-01-01 00:00:00', 'Hey!'),
	('jXYhl1J', 'BT8S88d', 'wbPsYSd', '2022-01-27 04:55:35', 'test 123'),
	('MLhsRNW', 'Wi8LrMl', 'wbPsYSd', '2022-01-27 04:57:35', 'Hello!'),
	('nuUpq8g', 'Wi8LrMl', 'wbPsYSd', '2022-01-27 05:04:25', 'Hey'),
	('p7pJxpl', 'wbPsYSd', 'BT8S88d', '2022-01-27 04:53:04', 'test message'),
	('RGxicCQ', 'wbPsYSd', 'BT8S88d', '2022-01-27 04:42:57', 'Hello!'),
	('RI3w4uE', 'FzysDxl', 'BT8S88d', '2022-01-27 14:02:39', '12345678'),
	('THXlKxr', 'BT8S88d', 'FzysDxl', '1999-01-01 00:00:00', 'Hey!'),
	('tr2RxUy', 'FzysDxl', 'BT8S88d', '2022-01-27 14:03:16', 'testing'),
	('TTF5fHB', 'wbPsYSd', 'Wi8LrMl', '1999-01-01 00:00:00', 'Hey!');
/*!40000 ALTER TABLE `msgtable` ENABLE KEYS */;

-- Dumping structure for table mealsformakers.recipereftable
CREATE TABLE IF NOT EXISTS `recipereftable` (
  `ingRefIndex` varchar(50) NOT NULL,
  `recipeIndex` varchar(50) DEFAULT NULL,
  `ingIndex` varchar(50) DEFAULT NULL,
  `ingQuantity` text,
  PRIMARY KEY (`ingRefIndex`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mealsformakers.recipereftable: ~7 rows (approximately)
DELETE FROM `recipereftable`;
/*!40000 ALTER TABLE `recipereftable` DISABLE KEYS */;
INSERT INTO `recipereftable` (`ingRefIndex`, `recipeIndex`, `ingIndex`, `ingQuantity`) VALUES
	('0xqlzPr', 'B9B0UNK', 'asdasdasd', '1'),
	('13QrKHx', '56lq6gX', 'n5qnZ0Y', '1'),
	('1iNys9M', 'DuN5Ore', 'fbmG54t', '1'),
	('1tDNwQD', 'DuN5Ore', 'i6C4b0U', '1'),
	('2yZut39', 'BqX2wN8', 'ZX765vH', '4 pieces'),
	('4OklW3G', 'iB1cHJ2', 'PiszPBO', '1'),
	('57409nv', 'BqX2wN8', 'FkshecV', '1 piece'),
	('6EsdQah', 'GmIsjIw', 'asdasdasd', 'sample'),
	('7SMoIYm', 'DuN5Ore', 'yt6jnPu', '1'),
	('8n5HIh2', 'sJBBu0z', 'asdasxczdasd', '4'),
	('988ccl0', 'qdRYC48', 'VPcnrCm', '1 bundle'),
	('c0FXpCe', 'qdRYC48', '4ip5jVa', '1 tbps'),
	('c589wuF', 'sJBBu0z', 'e8p7d7b', '1'),
	('dcAnJK2', 'iB1cHJ2', 'ebFE9Gm', '1'),
	('dzNGKz8', 'BqX2wN8', '5CMi6Rp', '1 kg'),
	('ezDJVyb', 'B9B0UNK', 'CESA53C', '1'),
	('GEDXX6s', 'GmIsjIw', 'asdasdaadsd', 'sample'),
	('GqnS0na', 'iB1cHJ2', 'mAZrDLd', '1'),
	('GRmSnUo', '56lq6gX', '7AyWUyB', '1'),
	('Hab2K3Q', 'B9B0UNK', 'LWacGlt', '1'),
	('hlrUyV9', 'B9B0UNK', 'n5qnZ0Y', '1'),
	('ioiyZjv', 'cXSk0OP', 'asdasaasdasd', '2 tsp.'),
	('jBgmS7B', 'DuN5Ore', 'b48GsBU', '1'),
	('jgtgfBu', 'cXSk0OP', 'n5qnZ0Y', '250 g'),
	('jh24YtL', 'GmIsjIw', 'n5qnZ0Y', 'sample'),
	('JwF5jB2', 'sJBBu0z', 'DgXTFl9', '4'),
	('KwVOm5d', 'DuN5Ore', 'q1TYc6T', '1'),
	('kyfYSpB', 'sJBBu0z', '7AyWUyB', '2'),
	('LtGy3jk', 'cXSk0OP', 'oldwpOE', '10 tsp.'),
	('m6VSLj2', 'BqX2wN8', 'J3pp5qG', '1 piece'),
	('mzVaM9Y', 'DuN5Ore', 'Xq3szLB', '1'),
	('N43Xy5c', 'qdRYC48', 'fSQV98v', '2 cups'),
	('NkpllV9', 'DuN5Ore', 'bNFrzCB', '1'),
	('nsi6eoF', 'DuN5Ore', 'W5swByS', '1'),
	('OmbqR2r', '56lq6gX', '2w3UVV9', '1'),
	('OoS3hUk', 'cXSk0OP', 'asdasdaadsd', '3 pc.'),
	('OrvB5uq', 'BqX2wN8', '1rgtfTx', '2 pieces'),
	('oWrWKQt', 'DuN5Ore', 'rRjKMlG', '1'),
	('PcTXzay', '8JEEYAC', 'aasdsdasdasd', '1'),
	('ppyhuyr', 'B9B0UNK', 'aasdsdasdasd', '1'),
	('rePMgnA', 'B9B0UNK', 'asdasdaadsd', '1'),
	('Rr0JwKm', 'DuN5Ore', 'vyTaZOG', '1'),
	('S30voTC', 'BqX2wN8', '2o2qkR7', '1/2 kg'),
	('sgEv0jQ', 'BqX2wN8', 'Rxm393y', '1/2 kg'),
	('tsyc8jt', 'BqX2wN8', 'B48wGUX', '3 pieces'),
	('Uiy670F', 'qdRYC48', 'BAB5bIP', '4 pcs'),
	('vghcIg4', 'GmIsjIw', 'aasdsdasdasd', 'sample'),
	('VL6pcfq', '56lq6gX', '7cPlnrW', '1'),
	('vPgVhsP', 'ZUtMvER', 'I6NleH0', '1 '),
	('WhLnN0I', 'cXSk0OP', 'FmGZ8eS', '3 pc.'),
	('wsvt0RP', 'DuN5Ore', 'IgQWCXT', 'testdata1'),
	('wYtiX7N', 'cXSk0OP', 'aasdsdasdasd', '5 pc.'),
	('x1F8aBC', 'DuN5Ore', '3rUc9II', '1'),
	('xl4LCKz', 'Tha81Md', 'aasdsdasdasd', '1'),
	('YGwjYZJ', 'B9B0UNK', 'dUuzTSM', 'datatest'),
	('YiI33im', 'GmIsjIw', 'CESA53C', 'sample'),
	('YjbusLn', 'BqX2wN8', 'W3TKubc', '8 cups'),
	('zOaXAEx', 'BqX2wN8', 's1CoJL9', '2 pieces'),
	('Zx6WuAN', 'DuN5Ore', 'fOYr3b4', '1'),
	('zZEWpLn', 'BqX2wN8', 'Cpx2UGf', '4 pieces');
/*!40000 ALTER TABLE `recipereftable` ENABLE KEYS */;

-- Dumping structure for table mealsformakers.recipetable
CREATE TABLE IF NOT EXISTS `recipetable` (
  `recipeIndex` varchar(50) NOT NULL,
  `userIndex` varchar(50) DEFAULT NULL,
  `commIndex` varchar(50) DEFAULT NULL,
  `recipeTitle` text,
  `recipeDesc` text,
  `recipeInstructions` text,
  `recipeImg` text,
  `recipeVid` text,
  `recipeDoc` text,
  `publishDate` datetime DEFAULT NULL,
  `modifyDate` datetime DEFAULT NULL,
  `isvisible` smallint(6) DEFAULT NULL,
  `cat` text,
  PRIMARY KEY (`recipeIndex`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mealsformakers.recipetable: ~2 rows (approximately)
DELETE FROM `recipetable`;
/*!40000 ALTER TABLE `recipetable` DISABLE KEYS */;
INSERT INTO `recipetable` (`recipeIndex`, `userIndex`, `commIndex`, `recipeTitle`, `recipeDesc`, `recipeInstructions`, `recipeImg`, `recipeVid`, `recipeDoc`, `publishDate`, `modifyDate`, `isvisible`, `cat`) VALUES
	('56lq6gX', 'u3AF3ET', 'nocommentbruh', 'Calzone', '5 minutes|||30 minutes|||2-4 person|||I know itâ€™s an unpopular opinion, but I always choose a crispy calzone oozing with cheese over a slice of pizza.\r\n\r\nI think youâ€™ll agree after trying this recipe for yourself!\r\n\r\nThese portable meals are great for taking on the go and much better than any fast-food restaurant. Make a big batch and freeze to enjoy any time. \r\n\r\nStore-bought pizza dough cuts way down on time, but you can make your own.\r\n\r\nStuff with your favorite pizza toppings like sauce, pepperoni, mozzarella, and veggies.', '<h1>How to Make a Calzone</h1><p>Making calzone is as easy as folding a pizza in half!</p><ol><li>Divide pre-made pizza dough into equal portions and roll into a circle.</li><li>On one half of the dough, spread the ingredients. Fold over and crimp the edges.</li><li>Cut air vents, brush with oil and bake (per recipe below).</li></ol>', 'Calzone-SpendWithPennies-2.jpg', 'null', 'null', '2022-01-27 22:15:14', '2022-01-27 22:15:14', 1, 'Snacks'),
	('BqX2wN8', 'zX36cWc', 'nocommentbruh', 'Sinigang na Grilled Liempo', '2 mins|||30 mins|||up to 6 people|||The ultimate comfort food! Made with Grilled Liempo, vegetables and tamarind-flavored broth, its hearty and delicious on its own or served with steamed rice.', '<h1>Directions</h1><p>Step 1: Letâ€™s begin by boiling the â€œhugas bigasâ€ and then throw in the onions, tomatoes, gabi and grilled liempo. You may then bring this to a simmer over low heat until pork is tender.</p><p>Step 2: When the gabi is tender, mash half of it to thicken the soup. Now, throw in the sili, radish and okra and let this simmer.</p><p>Step 3: The next step is to pour the Knorr Sinigang Mix. After pouring, you can now add the sitaw and kangkong last. Stir these well and cook for another minute and this dish is done!</p><p>Step 4: Make sure you have enough space in your stomach because this Sinigang na Grilled Liempo Recipe will make you want to eat more. Enjoy it best with family and good conversations at the table.</p>', 'sinigang8.jpg', 'null', 'null', '2022-01-27 22:29:52', '2022-01-27 22:41:37', 1, 'Tanghalian'),
	('cXSk0OP', 'BT8S88d', 'nocommentbruh', 'Egg\'s Benedict', '10 min.|||1 hour|||3 pax|||eggs Benedict, a brunch staple consisting of poached eggs and Canadian bacon or sliced ham on an English muffin, topped with hollandaise sauce (a rich and creamy concoction made with egg yolks, butter, lemon juice or vinegar, and various seasonings. (https://www.britannica.com/topic/eggs-Benedict)', '<h1>How to make Egg\'s Benedict</h1><ol><li>Make poached eggs: put water in a large pot and let it simmer on low heat. (Do not let it boil hard)</li><li>Crack 3 eggs on to 3 cups separately.</li><li>Create a vortex in the pot by spinning the water with a ladle.</li><li>While the water is spinning, put in the 3 eggs in the pot gently.</li><li>Let the water encase the eggs into itself, making poached eggs.</li><li>After four minutes, get the eggs carefully with circular ladles and put on a tissue paper as to drain excess water.</li><li>Put a little bit of salt on top to taste. Set aside.</li><li>Make hollandaise sauce: Boil water in a pot.</li><li>Put a glass bowl that will fit comfortably above the pot without touching the boiling water.</li><li>Put 2 egg yolks inside the bowl and blend them.</li><li>While mixing thoroughly, add melted butter part by part, as for the mixture to not separate.</li><li>If the mixture has mixed completely and has thickened, put away above ice water for 10 seconds as to stop the cooking process.</li><li>Assembly: Slice three English muffins in half.</li><li>Put in slice of fried bacon in each muffin half.</li><li>Put on a poached egg in each muffin half.</li><li>Put on a right amount of hollandaise sauce in each muffin half.</li><li>Done!</li></ol>', 'Eggs-Benedict-CMS1.jpg', 'null', 'null', '2022-01-27 04:08:21', '2022-01-27 04:08:21', 1, 'Appetizers'),
	('GmIsjIw', 'BT8S88d', 'nocommentbruh', 'samplesamplesample', 'sample|||sample|||sample|||samplesamplesamplesamplesamplesamplesamplesamplesamplesamplesample', '<h1>samplesamplesamplesamplesamplesamplesamplesample</h1><p>samplesamplesamplesamplesamplesamplesamplesamplesample</p>', 'paper-clip-xl2.png', 'null', 'null', '2022-01-27 22:33:40', '2022-01-27 22:33:40', 0, 'Tanghalian'),
	('iB1cHJ2', 'u3AF3ET', 'nocommentbruh', 'Thick Italian Hot Chocolate', '5 minutes|||1 minute|||1 person|||When my kids were little they would ask me to make Hot Chocolate and so I would, it was easy! Little did I know that they really wanted the kind their friendsâ€™ were drinking.\r\n\r\nWhen they got a little older and we would go shopping together, they would take me down the aisle where it was located or call me in the room when the commercial came on the TV.', '<h1>How to Make Italian Hot Chocolate</h1><ol><li>In a small bowl whisk until smooth, 1/4 cup milk and cornstarch set aside.</li><li>Sift the cocoa into a medium bowl then add the sugar and whisk together,Â  set aside.</li><li>In a small/medium pot heat 3/4 cups + 1 tablespoon milk until boiling reduce heat to low, start whisking and add the milk/cornstarch mixture then add the cocoa mixture slowly while continually whisking until smooth.</li><li>Then add the chocolate pieces and whisk continuously for approximately 3 minutes. Serve immediately.</li></ol><p>This Italian Thick Hot Chocolate Recipe is so creamy and delicious you donâ€™t even need to top it with any whipped cream or marshmallows. But if you do, I wonâ€™t stop you. Enjoy!</p>', 'hot-chocolate-image-.jpg', 'null', 'null', '2022-01-27 22:13:18', '2022-01-27 22:24:42', 1, 'Desserts'),
	('qdRYC48', 'u3AF3ET', 'nocommentbruh', 'rosemary mushroom risotto', '25 minutes|||30 minutes|||5-8 people|||Ahh, risotto. This rosemary mushroom risotto is creamy, luxurious, and incredibly satisfying, this dish is a quintessential classic. There are many different variations out there and one of the more popular combinations is with mushrooms and peas. Sounds good to me! In my vegan rendition, since we are not adding any dairy cheese or cream, I like to create a strong depth of flavor with mustard and miso (a trick I learned while working as a server in a restaurant in NYC). The tang from the mustard and cheesiness from the miso works wonders for the creamy rice known as â€˜Arborioâ€™. My other secret weapon is rosemary. This powerful herb offers a very strong savory flavor that is earthy and robust. It works beautifully with rice and mushrooms. In regards to risotto, I think people are intimidated, but I am here to prove to all of you that itâ€™s really not that bad! Matter of fact, itâ€™s quite simple. ', '<h1>INSTRUCTIONS</h1><ol><li>Add broth to a small pot and bring to a boil. Remove from heat, cover and set aside.</li><li>Melt butter over medium heat, then add olive oil, mushrooms, onions, and a pinch of salt and pepper. SautÃ© for 5 minutes until onions are soft. Add garlic, rosemary, nutritional yeast and arborio rice. Stirring often, cook for an additional 3-4 minutes until garlic is soft and rice is toasted. Add the wine, mustard, and miso and mix well. Cook for a few more minutes until the wine has evaporated, stirring frequently so the bottom doesnâ€™t burn.</li><li>Â Once the wine is evaporated, add 1 cup of warm broth to the rice mixture. Continue to cook over medium heat, stirring often, until the broth is absorbed. Repeat this step, adding the broth in 1 cup increments, until risotto becomes thick and creamy. This should take about 20-30 minutes. If the risotto seems done, give it a taste and you will know. The rice should be chewy, firm, yet tender. You may not use all of the broth and thatâ€™s ok. Donâ€™t have a meltdown.</li><li>Â At this point, you can fold in whatever vegetables you are using along with the shredded vegan parm. Give it a taste and season with salt and pepper to your liking. Continue to cook, stirring constantly, until the asparagus is tender and the peas are bright green. Remove from heat and serve immediately.</li></ol>', '2a8ee8a848bdfbe2558188c4b930ec011.jpg', 'null', 'null', '2022-01-27 22:19:04', '2022-01-27 22:26:01', 1, 'Dinner'),
	('sJBBu0z', 'u3AF3ET', 'nocommentbruh', 'Chicken Parmesan', '30 minutes|||45 minutes|||4-6 people|||With a classic Italian recipe like chicken parmesan, your whole family is sure to fall in love. \r\n\r\nFor a traditional chicken parmesan, pound out your chicken breasts super thin and make sure theyâ€™re all an even size. \r\n\r\nThe breading station will have three trays â€” one with flour, another with eggs and cream, and the third for breadcrumbs. \r\n\r\nAfter frying your chicken breast, start creating the layers in your baking pan.\r\n\r\nStart with marinara sauce, then chicken, more marinara sauce, and finish it with a healthy amount of mozzarella cheese. ', '<h1>Chicken Parmesan</h1><p>Every Italian home cook should know how to make classic Chicken Parmesan (Parmigiano). It requires pounding the chicken breasts to a thin and even size, and breading them with traditional flour, egg wash, and seasoned breadcrumbs. Use whole-milk mozzarella if you can for that extra buttery flavor.</p><h3>Instructions</h3><ol><li>Pre-heat oven to 350.</li><li>Place one chicken breast inside a gallon size ziplock bag. Using the smooth side of a kitchen mallet pound the chicken breast to an even size all around, approximately Â½ inch. Take out and set aside. Pound the rest of the chicken breasts.</li><li>Prepare three trays for the breading process. Put the flour in tray number 1 and season with salt and pepper. In a small bowl, beat three eggs with the cream. Pour eggs into tray number 2. Add salt, pepper and Â½ of the minced parsley to the eggs. Add the breadcrumbs to tray number 3. Mix in the parmesan cheese.</li><li>To bread, dredge each breast in the flour on both sides, dip in the egg wash, and finally cover with breadcrumbs. Set aside and finish breading the rest of the cutlets.</li><li>Heat olive oil in large skillet until very hot. Cook two cutlets at a time. Turn when start to get a golden color and cook on the other side. They will cook fast on the outside, and finish cooking in the oven. Drain on a paper towel and finish frying the rest of the cutlets.</li><li>Add 4 big spoonfuls of Marinara sauce to the bottom of large lasagna pan or baking pan. Arrange the cutlets in a single layer or slightly overlapping. Add a spoonful of Marinara sauce over each cutlet and around sides. Sprinkle the mozzarella cheese over the cutlets, and finish with the rest of flat leaf parsley.</li><li>Bake for 25-35 minutes until the cheese is starting to turn golden brown. The time will vary depending on the size of the cutlets.</li></ol><p>Serve immediately.</p>', 'Chicken-Parmesan-in-pan-1024x752.jpg', 'null', 'null', '2022-01-27 22:11:26', '2022-01-27 22:25:31', 1, 'Dinner'),
	('Tha81Md', 'wbPsYSd', 'nocommentbruh', 'Fried Egg', '10 sec.|||2 min.|||1 pax.|||Just your average sunny side up egg with just a runny yolk.', '<h1>How to fry a sunny side up egg:</h1><ol><li>Heat up panÂ </li><li>Put in olive oil</li><li>Crack egg into pan</li><li>Cook for 2 minutes.</li><li>Serve. Done!</li></ol>', 'how-to-make-perfect-fried-egg-1200x900-c_jpg_optimal.jpg', 'null', 'null', '2022-01-27 04:12:21', '2022-01-27 04:12:21', 1, 'Appetizers'),
	('ZUtMvER', 'zX36cWc', 'nocommentbruh', 'Sinigang na Grilled Liempo', '2 mins|||30 mins|||Serves up to 6 people|||The ultimate comfort food! Made with Grilled Liempo, vegetables and tamarind-flavored broth, its hearty and delicious on its own or served with steamed rice.', '<h1>Directions</h1><p>Step 1: Letâ€™s begin by boiling the â€œhugas bigasâ€ and then throw in the onions, tomatoes, gabi and grilled liempo. You may then bring this to a simmer over low heat until pork is tender.</p><p>Step 2: When the gabi is tender, mash half of it to thicken the soup. Now, throw in the sili, radish and okra and let this simmer.</p><p>Step 3: The next step is to pour the Knorr Sinigang Mix. After pouring, you can now add the sitaw and kangkong last. Stir these well and cook for another minute and this dish is done!</p><p>Step 4: Make sure you have enough space in your stomach because this Sinigang na Grilled Liempo Recipe will make you want to eat more. Enjoy it best with family and good conversations at the table.</p>', 'sinigang5.jpg', 'null', 'null', '2022-01-27 21:58:32', '2022-01-27 22:14:19', 0, 'Tanghalian');
/*!40000 ALTER TABLE `recipetable` ENABLE KEYS */;

-- Dumping structure for table mealsformakers.reporttable
CREATE TABLE IF NOT EXISTS `reporttable` (
  `reportIndex` varchar(50) NOT NULL,
  `recipeIndex` varchar(50) DEFAULT NULL,
  `userIndex` varchar(50) DEFAULT NULL,
  `reportType` int(11) DEFAULT NULL,
  `reportContent` text,
  `reportCategory` text,
  PRIMARY KEY (`reportIndex`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mealsformakers.reporttable: ~0 rows (approximately)
DELETE FROM `reporttable`;
/*!40000 ALTER TABLE `reporttable` DISABLE KEYS */;
/*!40000 ALTER TABLE `reporttable` ENABLE KEYS */;

-- Dumping structure for table mealsformakers.upvtable
CREATE TABLE IF NOT EXISTS `upvtable` (
  `upvoteIndex` varchar(50) NOT NULL,
  `userIndex` varchar(50) DEFAULT NULL,
  `upvoteType` smallint(6) DEFAULT NULL,
  `commIndex` text,
  PRIMARY KEY (`upvoteIndex`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mealsformakers.upvtable: ~1 rows (approximately)
DELETE FROM `upvtable`;
/*!40000 ALTER TABLE `upvtable` DISABLE KEYS */;
INSERT INTO `upvtable` (`upvoteIndex`, `userIndex`, `upvoteType`, `commIndex`) VALUES
	('YMLbYly', 'wbPsYSd', 1, '0Sei5PR');
/*!40000 ALTER TABLE `upvtable` ENABLE KEYS */;

-- Dumping structure for table mealsformakers.usertable
CREATE TABLE IF NOT EXISTS `usertable` (
  `userIndex` varchar(50) NOT NULL,
  `lastname` text,
  `firstname` text,
  `age` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `email` text,
  `contactnum` text,
  `address` text,
  `profilePic` text,
  `username` text,
  `pword` text,
  `dte` datetime DEFAULT NULL,
  PRIMARY KEY (`userIndex`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mealsformakers.usertable: ~5 rows (approximately)
DELETE FROM `usertable`;
/*!40000 ALTER TABLE `usertable` DISABLE KEYS */;
INSERT INTO `usertable` (`userIndex`, `lastname`, `firstname`, `age`, `birthdate`, `email`, `contactnum`, `address`, `profilePic`, `username`, `pword`, `dte`) VALUES
	('2qbgTri', 'Atwood', 'Margaret', 21, '2000-05-13', 'meyot89741@get2israel.com', '09512250934', 'Manila', 'null', 'atwoodmargaret', '0afac1f9c129794dae24b7d0e1db33177c7f1ab0fe7c19afb84f6cad2065beaeb3a592fead3814813b00efad4f9680d379024b165cf5efc83427f844a7a9e53a', '2022-01-27 22:47:51'),
	('9G9oyR6', 'Adams', 'Abigail', 20, '2001-04-22', 'fisexib351@icesilo.com', '09dada38098', 'Manila', 'null', 'adamsabigail', 'f1551e3cbf43a8d603347af5a6b0931c85ccfce38c9422171c5a0708d4e72357a3b670c4c4a77d933e4e4ca0f2279c168f98def0b5aed0618e5503de456bacea', '2022-01-27 22:31:27'),
	('BT8S88d', 'Santos', 'Brian', 23, '1999-01-01', 'gilalvarezforgrab@gmail.com', '09123456789', 'B2 L2 Quezon City', 'null', 'briansantos', '05815e12e515f36d09149ee9eaba48b5a9a413e1f9134d0386d72b977d08bd0d2cdf798df327404f801ab54a33d68058a260c0d899c4f320c337c4f6663be3db', '2022-01-27 04:40:48'),
	('FzysDxl', 'Skyline', 'Nissan', 21, '2000-08-17', 'mayete3562@nahetech.com', '09123456789', '2077 cyberpunk street corner san andreas grove street ', 'null', 'KyleRaiden017', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', '2022-01-27 14:02:03'),
	('KV7tCNc', 'Anderson', 'Beth', 20, '2001-04-23', 'rameg70768@get2israel.com', '09198638098', 'Manila', 'null', 'andersonbeth', '7a006f388cd86bfdddbdec506377208a9f062d3d61a95a577b796e96e896befadc66f8e6e5b874b0bb2172575bd2cae62edaacbec3e8187b4c4b5d4f7732abaf', '2022-01-27 22:12:52'),
	('u3AF3ET', 'Cobilla', 'Ramil ', 21, '2000-12-20', 'ramil.cobilla@gmail.com', '09662712988', '38 Branches st. Project 8 Barangay Sangandaan', 'null', 'Killerrays23', '7666efbfa1a44a443491e679f2579c5452da975f8338f36afd6ccf9801af172b82222ced6d82c8f484c10d3e91fe354dd5f78861b0079f999985b02e1af2239c', '2022-01-27 21:46:32'),
	('uJIHJfK', 'Alba', 'Jessica', 20, '2001-04-24', 'wofima3695@bubblybank.com', 'abcdefghijk', 'Manila', 'null', 'jessicaalba', '1ee324783e8a078a264930c7a6197284e5d5e3f7c9216f544080072cd491e187b02a8e15a2155ef75d5d7c6714d32acef40c534c6a3f558b0a7c499b6fe90510', '2022-01-27 22:38:23'),
	('wbPsYSd', 'Alvarez', 'Gil Christian', 21, '2000-11-21', 'alvarezgilc2128@gmail.com', '09123456789', 'B1 L1 Quezon City', 'null', 'gilc2128', '05815e12e515f36d09149ee9eaba48b5a9a413e1f9134d0386d72b977d08bd0d2cdf798df327404f801ab54a33d68058a260c0d899c4f320c337c4f6663be3db', '2022-01-27 04:40:00'),
	('Wi8LrMl', 'dela Cruz', 'Juan', 30, '1991-11-11', 'jedome2810@get2israel.com', '09123456789', 'asdasdasdasdasdasd', 'null', 'juandelacruz', '05815e12e515f36d09149ee9eaba48b5a9a413e1f9134d0386d72b977d08bd0d2cdf798df327404f801ab54a33d68058a260c0d899c4f320c337c4f6663be3db', '2022-01-27 04:57:07'),
	('zX36cWc', 'De Castro', 'Kyle Christian ', 21, '2000-09-17', 'KyleChristian1721@gmail.com', '09123456789', '2077 cyberpunk street corner san andreas grove street ', 'null', 'KyleRaiden', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', '2022-01-27 21:21:26');
/*!40000 ALTER TABLE `usertable` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
