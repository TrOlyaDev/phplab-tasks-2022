USE `online_shop_db`;

#select the category without products
SELECT c.`name`
	FROM `categories` c
		LEFT JOIN `products` p ON p.`category_id` = c.`category_id`
	WHERE p.`product_id` IS NULL;
    
#select all products that have never been ordered
SELECT p.`product_id`, p.`name`, p.`price` 
	FROM `products` p
	WHERE p.`product_id` NOT IN 
		(SELECT DISTINCT(op.`product_id`) FROM `order_product` op)
	ORDER BY p.`price` DESC;

#select products by popularity (popularity - the total number of ordered items)
SELECT p.`product_id`, p.`name`, SUM(op.`quantity`) as `count`
	FROM `products` p 
		JOIN `order_product` op ON p.`product_id` = op.`product_id`
	GROUP BY p.`product_id`
	ORDER BY `count` DESC;

#select the total number of orders for users made in 2022 that were completed and delivered
SELECT u.`first_name`, u.`last_name`, COUNT(o.`order_id`) as `orders`
	FROM `users` u
		JOIN `orders` o ON u.`user_id` = o.`user_id`
        JOIN `order_statuses` os ON o.`status_id` = os.`status_id`
	WHERE os.`name` = 'done' AND o.`datetime` >  '2021-12-31 23:59:59'
    GROUP BY u.`first_name`, u.`last_name`;
 
 #select users who made more than one order in 2021
SELECT u.`user_id` , u.`first_name`, u.`last_name` 
	FROM `users` u
		JOIN `orders` o ON u.`user_id` = o.`user_id`
	WHERE o.`datetime` BETWEEN '2021-01-01 00:00:00' AND '2021-12-31 23:59:59' 
	GROUP BY u.`user_id`
	HAVING COUNT(o.`order_id`) > 1;
		
#the first three most popular categories
SELECT c.`name`, SUM(op.`quantity`) as `count`
	FROM `products` p 
		JOIN `order_product` op ON p.`product_id` = op.`product_id`
        JOIN `categories` c ON p.`category_id` = c.`category_id`
	GROUP BY c.`name`
	ORDER BY `count` DESC
    LIMIT 0,3;
    
#select categories and products, the title or description of which contains the word "stone"
SELECT c.`category_id`, c.`name`, c.`description`
	FROM `categories` c 
    WHERE c.`name` LIKE '%stone%' OR c.`description` LIKE '%stone%'
UNION
SELECT p.`product_id`, p.`name`, p.`description`
	FROM `products` p 
    WHERE p.`name` LIKE '%stone%' OR p.`description` LIKE '%stone%';

#select the last 5 non-cancelled orders, with a cost between 5000 and 2000000, display their total cost, status and user name
SELECT o.`order_id`, o.`datetime`, SUM(p.`price` * op.`quantity`) as `total_cost`, os.`name` as `order_status`, CONCAT(u.`first_name`, ' ', u.`last_name`) as `full_name`
	FROM `orders` o
		JOIN `order_statuses` os ON o.`status_id` = os.`status_id`
        JOIN `users` u ON o.`user_id` = u.`user_id`
        JOIN `order_product` op ON o.`order_id` = op.`order_id`
        JOIN `products` p ON op.`product_id` = p.`product_id`
        WHERE os.`name` != 'cancelled'
	GROUP BY o.`order_id`
    HAVING `total_cost` BETWEEN 5000 AND 2000000
    ORDER BY o.`datetime` DESC
    LIMIT 0,5;

#select the most expensive and the cheapest products that was ordered at least once
SELECT DISTINCT p.`product_id`, p.`name`, p.`price`
	FROM `products` p
		JOIN `order_product` op ON p.`product_id` = op.`product_id`
	WHERE p.`price` IN
		(
			(SELECT MAX(p.`price`)
				FROM `products` p
					JOIN `order_product` op ON p.`product_id` = op.`product_id`),
			(SELECT MIN(p.`price`) 
				FROM `products` p
					JOIN `order_product` op ON p.`product_id` = op.`product_id`) 
		)
	ORDER BY p.`price` DESC;

#on which days of the week users most often place orders
SELECT `week_day`
	FROM 
		( 
			SELECT `week_day`, COUNT(`week_day`) as `orders_number` 
				FROM (SELECT WEEKDAY(o.`datetime`) as `week_day` FROM `orders` o) as `week_days`
				GROUP BY `week_day`
        ) as `count_orders_1`
	WHERE `orders_number` = 
		(
			SELECT MAX(`orders_number`) 
            FROM 
				(
					SELECT `week_day`, COUNT(`week_day`) as `orders_number` 
						FROM (SELECT WEEKDAY(o.`datetime`) as `week_day` FROM `orders` o) as `week_days`
						GROUP BY `week_day`
				) as `count_orders_2`
        );
