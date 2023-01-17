To install you will need a WAMPSERVER - https://www.wampserver.com/en/download-wampserver-64bits/#download-wrapper 
You will also need your own google api key for text-to-speech to work

The files should be in a folder and placed in wamp64/www/<folder here>

The database will need to be created too. The SQL commands to create it are as follows (WAMPSERVER includes phpMyAdmin):
CREATE TABLE `spelling`.`testuser` ( `id` INT NOT NULL AUTO_INCREMENT , `creatorid` INT NOT NULL , `testid` INT NOT NULL , `username` VARCHAR(255) NULL , `name` VARCHAR(255) NULL , `answers` JSON NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `spelling`.`user` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `spelling`.`tests` ( `id` INT NOT NULL AUTO_INCREMENT , `userid` INT NOT NULL , `testname` TEXT NOT NULL , `testsettings` JSON NULL , `words` JSON NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `spelling`.`dict` ( `id` INT NOT NULL AUTO_INCREMENT , `word` VARCHAR(255) NOT NULL , `definition` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;

In order to populate the dict table you will need this code:
<?php //load json and then put into sql db
	include "funcscr/dbconnect.php";
           $connection = connect();
	$dict = file_get_contents("dictionary_compact.json");
	$arr = json_decode($dict, true);
	foreach($arr as $key => $val){
			//echo $key;
			//echo $val;
			$sql = "INSERT INTO dict (word, definition) VALUES ('".$key."','".$val."')";
			mysqli_query($connection, $sql);
	}
?>
