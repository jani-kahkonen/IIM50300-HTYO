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

INSERT INTO product (iname) Values ('tuote_1');

INSERT INTO product (iname) Values ('tuote_2');

INSERT INTO product (iname) Values ('tuote_3');

INSERT INTO customer (fname, lname) Values ('etunimi_1','sukunimi_1');

INSERT INTO account (email, pword, customer_id) Values ('test-1@hotmail.com','salasana', 1);

INSERT INTO subscription (customer_id) Values (1);

INSERT INTO product_subscription (subscription_id, product_id) Values (1, 1);


INSERT INTO customer (fname, lname) Values ('etunimi_2','sukunimi_2');

INSERT INTO account (email, pword, customer_id) Values ('test-2@hotmail.com','salasana', 2);

INSERT INTO subscription (customer_id) Values (2);

INSERT INTO product_subscription (subscription_id, product_id) Values (2, 2);
