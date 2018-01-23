# ETTV

sql query needed 
CREATE TABLE  `clients` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`mac_adress` VARCHAR( 100 ) NOT NULL ,
`device_id` VARCHAR( 100 ) NOT NULL ,
`http` VARCHAR( 100 ) NOT NULL
) ENGINE = INNODB;


change database config file at: resources/library/database.php
$dbName = Database name
$dbHost = Database Host
$dbUsername = Username
$dbUserPassword = Password

