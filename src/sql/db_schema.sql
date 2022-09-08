#create database
CREATE DATABASE IF NOT EXISTS `online_shop_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `online_shop_db`;

#create tables
CREATE TABLE IF NOT EXISTS `users` (
	`user_id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL UNIQUE,
    `phone` VARCHAR(20) NOT NULL UNIQUE,
    `password` VARCHAR(20) NOT NULL
);
CREATE TABLE IF NOT EXISTS `categories` (
	`category_id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `products` (
	`product_id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255),
    `price` NUMERIC(19,2) NOT NULL,
    `category_id` INT NOT NULL
);
CREATE TABLE IF NOT EXISTS `order_product` (
	`order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    PRIMARY KEY (`order_id`, `product_id`)
);
CREATE TABLE IF NOT EXISTS `orders` (
	`order_id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `datetime` DATETIME NOT NULL,
    `user_id` INT NOT NULL,
    `status_id` INT
);
CREATE TABLE IF NOT EXISTS `order_statuses` (
	`status_id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL
);

#foreign keys constraints
ALTER TABLE `products` ADD CONSTRAINT `FK_PRODUCT_CATEGORY` FOREIGN KEY (`category_id`) REFERENCES `categories`(`category_id`) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE `order_product` ADD CONSTRAINT `FK_ORDER_PRODUCT_ORDER` FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE `order_product` ADD CONSTRAINT `FK_ORDER_PRODUCT_PRODUCT` FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE `orders` ADD CONSTRAINT `FK_ORDER_USER` FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE `orders` ADD CONSTRAINT `FK_ORDER_STATUS` FOREIGN KEY(`status_id`) REFERENCES `order_statuses`(`status_id`) ON UPDATE CASCADE ON DELETE SET NULL;

#insert data
INSERT INTO `users` (`first_name`, `last_name`, `email`, `phone`, `password`) VALUES
	('Natasha', 'Romanoff', 'black_widow@gmail.com', '+380661232345', 'qsd453hgsdfsdfw3'),
    ('Steven', 'Rogers', 'captain_america@gmail.com', '+380938765432', 'fsdfdfsd57843gj'),
    ('Stephen', 'Strange', 'dr_strange@gmail.com', '+380509876543', '445gbgfhfhf54fgfdf'),
    ('Bruce', 'Bennett', 'hulk@gmail.com', '+380971238754', 'ljhjz245234jjy66'),
    ('Antony', 'Stark', 'ironman@gmail.com', '+380669872453', 'kjkhjh4467FH9DFFSc'),
    ('Peter', 'Parker', 'spiderman@gmail.com', '+380937652890', 'idifkf349fk57HJK'),
    ('Thor', 'Odinson', 'thor@gmail.com', '+380931258905', '1ghjK14fvllopo4');
INSERT INTO `categories` (`name`, `description`) VALUES
	('weapons', 'Arsenal for Super-heroes'),
    ('armour', 'Outfit for Super-heroes'),
    ('progectiles', 'Progectiles'),
    ('reagents', 'Reagents for poisons and elixirs'),
    ('accessories', NULL);
INSERT INTO `products` (`name`, `description`, `price`, `category_id`) VALUES
	('The Mjollnir', 'The hummer for Thor', 373.5, 1),
    ('The Captain America\'s Shield', 'The shield for Captain America', 499.99, 1),
    ('The Stormbreaker', 'The enchanted axe', 999.99, 1),
    ('The Odin Sward', 'Totally cool sward', 4000, 1),
    ('Escrima Electric Sticks', 'Escrima Electric Sticks' , 10000 ,1),
    ('Iron Man\'s Costume v.2', 'The second version of Iron Man\'s costume', 1345, 2),
    ('Enormous shorts', 'Extremely huge shorts', 50, 2),
    ('The Red Cloak', 'Simple red cloak', 10, 2),
    ('Space Stone', ' The infinity stone', 126345.50, 3),
    ('Mind Stone', ' The infinity stone', 135345, 3),
    ('Reality Stone', ' The infinity stone', 754358, 3),
    ('Power Stone', ' The infinity stone', 953246, 3),
    ('Time Stone', ' The infinity stone', 126345.50, 3),
    ('Soul Stone', ' The infinity stone', 876542, 3),
    ('Tesseract', NULL, 85756, 5),
    ('The Infinity Gauntlet','The Infinity Gauntlet', 987654.3, 5),
    ('The Heart of the Universe', 'One of the most powerful artifacts', 1284756, 5),
    ('The Sling Ring', 'The magic ring', 128765, 5);
INSERT INTO `order_statuses` (`name`) VALUES
	('new'),
    ('in progress'),
    ('delivery'),
    ('done'),
    ('cancelled');
INSERT INTO `orders` (`datetime`, `user_id`, `status_id`) VALUES
	('2022-05-10 23:59:59', 7, 4),
    ('2022-08-31 14:15:40', 7, 1),
    ('2021-01-20 10:40:32', 1, 5),
    ('2021-07-24 05:05:05', 1, 2),
    ('2022-02-24 05:10:20', 3, 4),
    ('2021-03-18 20:15:30', 4, 3),
    ('2022-04-23 01:20:21', 5, 2),
    ('2022-09-01 08:00:00', 3, 4),
    ('2021-12-18 20:15:30', 2, 4),
    ('2022-08-30 15:15:30', 1, 1),
    ('2021-10-10 10:10:10', 3, 5);
INSERT INTO `order_product` (`order_id`, `product_id`, `quantity`) VALUES
	(1, 1, 3),
    (1, 8, 10),
    (2, 3, 1),
    (2, 4, 1),
    (2, 8, 2),
    (3, 5, 5),
    (4, 5, 2),
    (4, 13, 2),
    (5, 8, 1),
    (5, 18, 1),
    (6, 12, 1),
    (6, 11, 1),
    (6, 7, 50),
    (7, 6, 5),
    (8, 9, 1),
    (8, 10, 2),
    (8, 11, 3),
    (8, 12, 1),
    (9, 2, 10),
    (10, 16, 3),
    (10, 7, 10),
    (11, 4, 1);
