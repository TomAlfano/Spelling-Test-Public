<?php
function uploadTest($spelling_list, $testname, $settings) { //takes in array and uploads in corrcet format
	$connection = connect();
	$spelling_json['words'] = $spelling_list;
	$spelling_json = json_encode($spelling_json);
	$sql = "INSERT INTO tests (userid, testname, testsettings, words) VALUES ('".$_SESSION['id']."','".$testname."','".$settings."','".$spelling_json."')";
	mysqli_query($connection, $sql);
	$id = mysqli_insert_id($connection);
	$_SESSION['testid'] = $id;
};

function deleteAccount($accountid){
	$connection = connect();
	$sql = "DELETE FROM user WHERE id = '$accountid'";
	mysqli_query($connection, $sql);
};

function deleteTest($testid){
	$connection = connect();
	$sql = "DELETE FROM tests WHERE id = '$testid'";
	mysqli_query($connection, $sql);
	$sql = "DELETE FROM testuser WHERE testid = '$testid'";
	mysqli_query($connection, $sql);
};

//Gets data for charts and puts into a better json format for later processing
function getTestResults($id, $testid = null){
	$connection = connect();
	if (isset($testid)){
		$sql ="SELECT * from testuser WHERE testid = '$testid'";
	}else{
		$sql ="SELECT * from testuser WHERE creatorid = '$id'";
	}

	$result = mysqli_query($connection, $sql);
	$data = array();
	$rowcount = 0;
	$answerplace = array();
	while ($row = mysqli_fetch_assoc($result)){
		$answers = json_decode($row['answers'], true);
		if (isset($testid)){
			$data[$rowcount]['seprate'] = true;
			$data[$rowcount]['testid'] = $row['testid'];
			$data[$rowcount]['username'] = $row['username'];
			$data[$rowcount]['timescompleted'] = count($answers['answers']);
			$data[$rowcount]['name'] = $row['name'];
			#$data[$row['testid']][$i]['answers'] = $answers['answers'];
			for ($c = 0; $c < count($answers['answers']); $c++){
				for ($x = 0; $x < count($answers['answers'][$c]); $x++){
					if ($x == 0){
						$answerplace[$c] = $answers['answers'][$c][$x];
					} else {
						$answerplace[$c] = $answerplace[$c] + $answers['answers'][$c][$x];
					}

					if ($c == 0){
						$answerplaceholder[$x] = $answers['answers'][$c][$x];
						// var_dump($answers['answers'][$c][$x]);
					}else{
						$answerplaceholder[$x] = $answerplaceholder[$x] + $answers['answers'][$c][$x];
					}
				}
			}
			$data[$rowcount]['answers'] = $answerplace; //change to $answerplaceholder for other data and change words setup in testhistory
			$rowcount++;
		}else{

			for ($i=0; $i < count($answers['answers']); $i++) {
				if (isset($data[$row['testid']]['timescompleted']) && !isset($testid)) {
					for ($x=0; $x < count($answers['answers'][$i]); $x++) {
						$answerplaceholder = $data[$row['testid']]['answers'][$x];
						$answerplaceholder = $answerplaceholder + $answers['answers'][$i][$x];
						$data[$row['testid']]['answers'][$x] = $answerplaceholder;
					}
					#echo count($answers['answers'][$i]);
					$data[$row['testid']]['timescompleted']++;
				}else{
						$data[$row['testid']]['seprate'] = false;
						$data[$row['testid']]['testid'] = $row['testid'];
						$data[$row['testid']]['answers'] = $answers['answers'][$i];
						$data[$row['testid']]['timescompleted'] = 1;

				}
			}
		}
	}
	#var_dump($data);
	return $data;
	#var_dump($result);
}

function getTestWords($id, $testid = null){
	$connection = connect();
	if (isset($testid)){
		$sql ="SELECT * from tests WHERE id = '$testid'";
	}else{
		$sql ="SELECT * from tests WHERE userid = '$id'";
	}

	$result = mysqli_query($connection, $sql);
	$data = array();
	while ($row = mysqli_fetch_assoc($result)){
		$words = json_decode($row['words'], true);
		$data[$row['id']]['words'] = $words['words'];
		$data[$row['id']]['testname'] = $row['testname'];
	}
	#var_dump($data);
	return $data;
}

function getWordList($id){
	$connection = connect();
	$sql = "SELECT wordlist FROM user WHERE id='$id'";
	$result = mysqli_query($connection, $sql);
	if (mysqli_num_rows($result) == 1) {
		$row = $result->fetch_assoc();
		return json_decode($row['wordlist'], true);
	} else {
		return null;
	}
}

 ?>
