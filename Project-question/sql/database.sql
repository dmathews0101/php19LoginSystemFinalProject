-- Note personnelle seulement pour la création d'un usager spécifique
-- Ne pas remettre aux étudiants

DROP DATABASE IF EXISTS ProgrammationWeb3;
CREATE DATABASE ProgrammationWeb3;

DROP USER IF EXISTS 'pw3'@'localhost';
CREATE USER 'pw3'@'localhost' IDENTIFIED BY 'pw3';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES ON ProgrammationWeb3.* TO 'pw3'@'localhost';