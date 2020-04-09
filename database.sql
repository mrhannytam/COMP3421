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
profile_image BLOB NOT NULL,
reward_balance int NOT NULL,
PRIMARY KEY(user_id)
);

CREATE TABLE inventory(
inventory_id INT AUTO_INCREMENT NOT NULL,
inventory_name VARCHAR(30) NOT NULL,
inventory_image BLOB NOT NULL,
PRIMARY KEY(inventory_id)
);

CREATE TABLE PURCHASE(
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

select * from user;
