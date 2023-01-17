<?php
	//for aws, something wrong with variables currently need to sort. switching to in built server to start with
	//$link = new mysqli($_SERVER['spellingdb.c4pczj0tmlvw.eu-west-2.rds.amazonaws.com'], $_SERVER['admin'], $_SERVER['Canadacanada'], $_SERVER['spellingdb'], $_SERVER['1433']);
	
	//$connect = mysqli_connect("localhost:3306", "root");
	//echo($connect);
function connect(){
	$user = 'root';
	$pass = '';
	$connection = new mysqli('localhost', $user, $pass, "spelling"); //appears to work
	if (!$connection) {
		echo "Connection failed";
	} else {
		return $connection;
	}
}
	
?>
