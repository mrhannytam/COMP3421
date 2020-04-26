DROP DATABASE IF EXISTS COMP3421;
CREATE DATABASE IF NOT EXISTS COMP3421;
USE COMP3421;

CREATE TABLE user(
    user_id VARCHAR(30) NOT NULL,
    salt VARCHAR(130) NOT NULL,
    hash VARCHAR(130) NOT NULL,
    email VARCHAR(50) NOT NULL,
    active VARCHAR(3) NOT NULL,
    address VARCHAR(200),
    profile_image VARCHAR(50) NOT NULL,
    reward_balance int NOT NULL,
    PRIMARY KEY(user_id)
);

CREATE TABLE inventory(
    inventory_id INT AUTO_INCREMENT NOT NULL,
    inventory_name VARCHAR(30) NOT NULL,
    inventory_image VARCHAR(30) NOT NULL,
    price DOUBLE NOT NULL,
    PRIMARY KEY(inventory_id)
);

CREATE TABLE gift(
    gift_id INT AUTO_INCREMENT NOT NULL,
    gift_name VARCHAR(30) NOT NULL,
    gift_image VARCHAR(30) NOT NULL,
    gift_points INT NOT NULL,
    PRIMARY KEY(gift_id)
);

CREATE TABLE exchange(
    exchange_id INT AUTO_INCREMENT NOT NULL,
    user_id VARCHAR(30) NOT NULL,
    gift_id INT NOT NULL,
    use_or_not VARCHAR(3) NOT NULL DEFAULT "NO",
    PRIMARY KEY(exchange_id),
    FOREIGN KEY(user_id) REFERENCES user(user_id),
    FOREIGN KEY(gift_id) REFERENCES gift(gift_id)
);

CREATE TABLE purchase(
    purchase_id INT AUTO_INCREMENT NOT NULL,
    user_id VARCHAR(30) NOT NULL,
    inventory_id INT NOT NULL,
    quantity INT NOT NULL,
    deliver VARCHAR(3) NOT NULL,
    purchase_time TIMESTAMP NOT NULL,
    PRIMARY KEY(purchase_id),
    FOREIGN KEY(user_id) REFERENCES user(user_id),
    FOREIGN KEY(inventory_id) REFERENCES inventory(inventory_id)
);

CREATE TABLE comment(
    comment_id INT AUTO_INCREMENT NOT NULL,
    user_id VARCHAR(30) NOT NULL, 
    inventory_id INT NOT NULL,
    comment VARCHAR(300) NOT NULL,
    score INT NOT NULL,
    comment_time TIMESTAMP NOT NULL,
    PRIMARY KEY(comment_id),
    FOREIGN KEY(user_id) REFERENCES user(user_id),
    FOREIGN KEY(inventory_id) REFERENCES inventory(inventory_id)
);

CREATE TABLE cart(
    cart_id INT AUTO_INCREMENT NOT NULL,
    user_id VARCHAR(30) NOT NULL,
    inventory_id INT NOT NULL,
    quantity INT NOT NULL,
    PRIMARY KEY(cart_id),
    FOREIGN KEY(user_id) REFERENCES user(user_id),
    FOREIGN KEY(inventory_id) REFERENCES inventory(inventory_id)
);


INSERT INTO user VALUES('asd', '617615465', '3893fb66a0fdc1e33b7f69b030d8902a171015b61d9d945f26fd37fbb519cbdbd61602d2c4d06976c653db8bf535236e3c0382ff960c3b6b2609810ca8847870', 'asd@asd.asd', 'YES', NULL, '../image/default.png', 10000);
INSERT INTO user VALUES('sdf', '523968815', '79bb26b65aa5c706dd8b469465a2e89da818fec9d6550a18cd19e44ac52503c93e7edc3478446159fa4cbcf7c4e52df16b44721582b75f94fdefe766f977ee4d', 'sdf@sdf.sdf', 'YES', NULL, '../image/sdfcat.png', 0);
INSERT INTO inventory VALUES(1, "cat food", "./inventory_image/1.jpg", 99.9);
INSERT INTO inventory VALUES(2, "dog food", "./inventory_image/2.png", 77.9);
INSERT INTO gift VALUES(1, "10% off", "./gift_image/10PercentOff.jpg", 1000);
INSERT INTO gift VALUES(2, "20% off", "./gift_image/20PercentOff.jpg", 1500);
INSERT INTO gift VALUES(3, "50% off", "./gift_image/50PercentOff.jpg", 3000);
INSERT INTO comment VALUES(1, 'sdf', 1, 'Good Job', 4, current_timestamp());

use comp3421;
select * from inventory;