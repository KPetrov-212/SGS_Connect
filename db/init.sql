

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `panel_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `total_price_eur` float DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `panel_id` (`panel_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`panel_id`) REFERENCES `panels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



LOCK TABLES `orders` WRITE;
UNLOCK TABLES;


DROP TABLE IF EXISTS `panels`;

CREATE TABLE `panels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `power_output_w` int(11) DEFAULT NULL,
  `efficiency_percent` float DEFAULT NULL,
  `dimensions_mm` varchar(50) DEFAULT NULL,
  `weight_kg` float DEFAULT NULL,
  `panel_type` varchar(50) DEFAULT NULL,
  `voltage_vmp` float DEFAULT NULL,
  `current_imp` float DEFAULT NULL,
  `price_eur` float DEFAULT NULL,
  `warranty_years` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


LOCK TABLES `panels` WRITE;
INSERT INTO `panels` VALUES (1,'SunPro X200','SolarTech Industries',200,17.5,'1480x670x35',12.5,'Polycrystalline',22.4,8.9,95.99,10,'images/x200.png'),(2,'Energex Ultra300','Energex Ltd.',300,20.1,'1640x992x40',18,'Monocrystalline',34.2,8.77,129.99,25,'images/ultra300.png'),(3,'EcoLite Thin120','GreenCore Solutions',120,12.8,'1200x540x5',6.8,'Thin-Film',18.5,6.5,59.5,5,'images/thin120.png'),(4,'Photon Max360','Photonics Corp.',360,21.8,'1700x1000x35',19.3,'Monocrystalline',38,9.5,179,30,'images/max360.png'),(5,'Solaro Edge250','Solaro Inc.',250,18.6,'1650x990x40',15.4,'Polycrystalline',29.5,8.47,109.75,15,'images/edge250.png');
UNLOCK TABLES;



DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


LOCK TABLES `users` WRITE;

INSERT INTO `users` VALUES (3,'KK','k@gmail.com','$2y$10$KJlQT.t2u7sRzSTJSGZ52.qUFSug.krWrbgrQcjLJg/vuQkOQP0mG',NULL),(4,'K-K','goto@gmail.com','$2y$10$OOFww/KqtYwjPNYPjhKWP.s0m85r/MkmDS8sf5p2WmymeB7tyLsju',NULL);

UNLOCK TABLES;


