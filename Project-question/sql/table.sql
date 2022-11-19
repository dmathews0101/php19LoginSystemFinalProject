DROP TABLE IF EXISTS tp_user;

CREATE TABLE tp_user (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(30) NOT NULL,
	lastName VARCHAR(30) NOT NULL,
	email VARCHAR(50),
    userName VARCHAR(30) NOT NULL,
    userPassword VARCHAR(250) NOT NULL,
	creationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	modificationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Password generated with
-- echo password_hash('admin', PASSWORD_BCRYPT);
INSERT INTO tp_user (firstName, lastName, email, userName, userPassword) VALUES ('adminFirstName', 'adminLastName', 'admin@server.com', 'admin', '$2y$10$khYnuALzyXy8vMoUZGOzNudrcM.KVrKnp4udai7/7Zxg/OTo/YvO2');