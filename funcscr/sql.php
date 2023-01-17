<?php
function getTest($code) { //takes in array and uploads in corrcet format
	$spelling_list = array();
	$connection = connect();
	$sql = "SELECT * FROM tests WHERE id='$code'";
	$result = mysqli_query($connection, $sql);
	//$arr = array($result);
	if (mysqli_num_rows($result) == 1) {
		$row = $result->fetch_assoc();
		$wordlist = $row["words"];
		//$settings = $row["testsettings"];
		$wordlist = json_decode($wordlist, true);
		//$settings = json_decode($settings, true);
		$_SESSION['creatorid'] = $row["userid"];
		$_SESSION['testid'] = $row["id"];
		$_SESSION['settings'] = json_decode($row['testsettings'], true);
		for ($i = 0; $i < count($wordlist['words']); $i++){
			array_push($spelling_list, $wordlist['words'][$i]);
		};
		$_SESSION['spellingList'] = $spelling_list;
		return $spelling_list;
	} else {
		echo '<div id="code_error">';
			echo "<p id='message'>0 results</p>";
			echo '<form name="num_words_input_form" method="post" action="testcodebuilder.php">';
				echo '<label for="num_words">Enter Test Code:</label>';
				echo '<input type="number" name="code_input" id="test_code">';
				echo '<input type="submit" name="submit" >';
			echo '</form>';
		echo '</div>';
		include "footer.php";
		exit();
	};
};

function getDefinitions($word){
	$connection = connect();
	$sql = "SELECT definition FROM dict WHERE word='$word'";
	$result = mysqli_query($connection, $sql);
	if (mysqli_num_rows($result) == 1) {
		$row = $result->fetch_assoc();
		return $row['definition'];
	}else{
		return "no definition found";
	}
	//var_dump($result);
}
function uploadResult($testid, $creatorid, $username, $name, $answers){ //class missing for now. will add later
	//check for previous entries
	$connection = connect();
	$sql = "SELECT * FROM testuser WHERE username = '$username' AND creatorid = '$creatorid' AND testid = '$testid'";
	$result = mysqli_query($connection, $sql);
	//var_dump($result);
	if ((mysqli_num_rows($result) == 1) && ($username != "")){
		$row = $result->fetch_assoc();
		$id = $row['id'];
		$answerlist = $row['answers'];
		$answerlist = json_decode($answerlist, true);
		array_push($answerlist['answers'], $answers);
		$answersJSON = json_encode($answerlist);
		//var_dump($answersJSON);
		$sql = "UPDATE testuser SET answers = '$answersJSON' WHERE id = $id";
		mysqli_query($connection, $sql);

	}else{
		$answer['answers'][0] = $answers;
		$answersJSON = json_encode($answer);
		$sql = "INSERT INTO testuser (creatorid, testid, username, name, answers) VALUES ('".$creatorid."','".$testid."','".$username."','".$name."','".$answersJSON."')";
		mysqli_query($connection, $sql);
	};
};

function getRandomWords(int $numwords, $num_words){
	$spelling_list = array();
	$connection = connect();
	for ($i = 0; $i < $numwords; $i++){
		$randomid = rand(0, $num_words);
		$sql = "SELECT * FROM dict WHERE id='$randomid'";
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		array_push($spelling_list, $row["word"]);
	};
	return $spelling_list;
};


 //id	userid	testid	username	class	answers
 //id	userid	testname	testsettings	words
 ?>
