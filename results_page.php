<?php include 'header.php'; ?>
<a class = 'back_button' href='index.php'>&laquo; Back</a>
<?php
	$badges = array();
	$badges[0] = 'Bogey Badge'; # <50%
	$badges[1] = 'On Par'; # <60%
	$badges[2] = 'Birdie Badge'; # <70%
	$badges[3] = 'The Eagle'; # <80%
	$badges[4] = 'Albatross'; # <= 100%

	if (!isset($connection)){
		include "funcscr/dbconnect.php";
	};
	if (isset($_SESSION['creatorid'])){
		$creatorid = $_SESSION['creatorid'];
	}else{
		$creatorid = $_SESSION['id'];
	}


	$testid = $_SESSION['testid'];
	$spelling_list = $_SESSION['spellingList'];
	if(isset($_SESSION["loggedin"])){
		$username = $_SESSION["username"];
	}else{
		$username = null;
	};
	if (isset($_POST["name"])){
		$name = $_POST["name"];
	} else {
		$name = null;
	};
	$answers = array();
	$plotpoints = array();
	$score = 0;
	$settings = $_SESSION['settings'];
	echo '<div class = "results_page_container">';
	echo '<div class = "results_container">';
	for ($x = 0; $x < count($spelling_list); $x++) {
		if ($settings['comparison'] == true){

			echo '<div class="answer_comparisson">';
				echo '<div class="correct_answer">';
				echo 'Answer: '.$spelling_list[$x];
				echo '</div>';
				echo '<div class="your_answer">';
				echo 'Your answer: '.$_POST["answer".$x];
				echo '</div>';
			echo '</div>';
		}

		echo '<div class="result">';
		$answer = strtolower($_POST["answer".$x]);
		$answer = trim($answer);
		if ($answer == $spelling_list[$x]){
			array_push($answers, 1);
			$score = $score +1;
			if ($settings['comparison'] == true){
				echo "<b>Correct</b>";
			}
		}else{
			array_push($answers, 0);
			if ($settings['comparison'] == true){
				echo "<b>Incorrect</b>";
			}
	  };
		echo '</div>';

		array_push($plotpoints, ['x' => $spelling_list[$x], 'y' => $answers[$x]] );

		 //end of camparison
	};
	echo '</div>';
	echo '<div class="other_results">';
	$percent_mark = round((($score/count($spelling_list))*100), 1);
	if ($settings['percentage'] == true){
		echo "<h3>Total Score: ".$percent_mark."%</h3>";
	}
	if ($settings['badge'] == true){
		if ($percent_mark < 50){
			$badge = $badges[0];
		}elseif ($percent_mark < 60){
			$badge = $badges[1];
		}elseif ($percent_mark < 70){
			$badge = $badges[2];
		}elseif ($percent_mark < 80){
			$badge = $badges[3];
		}elseif ($percent_mark <= 100){
			$badge = $badges[4];
		}
		echo "<h3>Congratulations! Your badge is: ".$badge."</h3>";
	}
	$chartnum = 0;

	if ($settings['graph'] == true){
		echo "<div class='charts'>";
		echo "<canvas id='0'></canvas>";
		echo "</div>";
		echo '<script src="funcscr/jscripts.js"></script>';
		echo '<script> createChart('.json_encode($plotpoints).','.$chartnum.')</script>';
	}
	echo '</div>';
	echo '</div>';
	include "funcscr/sql.php";
	//$answers['answers'] = $answers;

	uploadResult($testid, $creatorid, $username, $name, $answers);

	//id	userid	testid	username	class	answers
?>
<?php include "footer.php"; ?>
