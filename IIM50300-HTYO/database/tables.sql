mysql -u H9575 -p7ahaqDkFKfb2Oljcrm4J9avJBY0b5SR8 -h mysql.labranet.jamk.fi

-- -----------------------------------------------------
-- Table customer
-- -----------------------------------------------------
CREATE TABLE customer
(
	id INT NOT NULL AUTO_INCREMENT,
	fname VARCHAR(64) NOT NULL,
	lname VARCHAR(64) NOT NULL,
	PRIMARY KEY (id)
);
-- -----------------------------------------------------
-- Table account
-- -----------------------------------------------------
CREATE TABLE account
(
	id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(64) NOT NULL,
	pword VARCHAR(64) NOT NULL,
	customer_id INT NULL,
	PRIMARY KEY (id),
	CONSTRAINT fk_account FOREIGN KEY (customer_id) REFERENCES customer (id)
);
-- -----------------------------------------------------
-- Table subscription
-- -----------------------------------------------------
CREATE TABLE subscription
(
	id INT NOT NULL AUTO_INCREMENT,
	customer_id INT NULL,
	PRIMARY KEY (id),
	CONSTRAINT fk_subscription FOREIGN KEY (customer_id) REFERENCES customer (id)
);
-- -----------------------------------------------------
-- Table product
-- -----------------------------------------------------
CREATE TABLE product
(
	id INT NOT NULL AUTO_INCREMENT,
	iname VARCHAR(64) NOT NULL,
	rdate DATETIME NOT NULL,
	PRIMARY KEY (id)
);
-- -----------------------------------------------------
-- Table product_order
-- -----------------------------------------------------
CREATE TABLE product_subscription
(
	id INT NOT NULL AUTO_INCREMENT,
	subscription_id INT NOT NULL,
	product_id INT NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT fk_product_subscription_1 FOREIGN KEY (subscription_id) REFERENCES subscription (id),
	CONSTRAINT fk_product_subscription_2 FOREIGN KEY (product_id) REFERENCES product (id)
);

INSERT INTO product (iname, rdate) Values ('tuote_A','2014.3.19');

INSERT INTO product (iname, rdate) Values ('tuote_B','2015.8.26');

INSERT INTO product (iname, rdate) Values ('tuote_C','2016.4.15');


INSERT INTO customer (fname, lname) Values ('test','test');

INSERT INTO account (email, pword, customer_id) Values ('test@outlook.com','test', 1);

INSERT INTO subscription (customer_id) Values (1);

INSERT INTO product_subscription (subscription_id, product_id) Values (1, 1);

SELECT product.iname FROM product_subscription
INNER JOIN product on product.id = product_subscription.product_id

SELECT customer.fname FROM subscription
INNER JOIN customer on customer.id = subscription.customer_id

/* */

SELECT product.iname FROM product_subscription
INNER JOIN product on product.id = product_subscription.product_id

SELECT account.email FROM subscription
INNER JOIN account on account.id = subscription.customer_id

/* */

SELECT account.email, product.iname FROM subscription, product_subscription
INNER JOIN account on account.id = subscription.customer_id
INNER JOIN product on product.id = product_subscription.product_id


SELECT account.email, product.iname FROM product_subscription
INNER JOIN subscription on subscription.id = product_subscription.subscription_id
INNER JOIN account on account.id = subscription.customer_id
INNER JOIN product on product.id = product_subscription.product_id





 

