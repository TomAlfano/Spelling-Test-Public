<?php include 'header.php'; ?>
<?php
include 'funcscr/testbuilderfunctions.php';
$_SESSION['creatorid'] = '';
$_SESSION['testid'] = '';
$_SESSION['settings'] = '';
$_SESSION['spellingList'] = '';

if (isset($_POST['custom_test'])){ //if custom test is selected then
	echo '<div class="spelling_form">';
		echo '<form name="num_words_input_form" method="post" action="testprocess.php">';
			echo '<div class="single_word">';
				if(isset($_SESSION["loggedin"])){
					echo "<label for='testname' class='test_name_label'>Test Name: </label>";
					echo "<input type='text' class='testname' name='testname' required>";
				};
			echo '</div>';

			echo '<div class="single_word">';
				echo '<label for="num_words">Number of words: </label>';
				echo '<input type="number" name="num_input" class="num_words" min="1" max="1000" required>';
			echo '</div>';
			echo '<div class="single_word">';
				settingInputBuilder();
			echo '</div>';
			echo '<div class="submit_button">';
				echo '<button type="submit" name="custom_test" value="custom_test">Create Test</button>';
			echo '</div>';
		echo '</form>';
	echo '</div>';
	#echo "<script>window.location.href = 'test_creation.php' </script>"; // PUT TEST_CREATION HERE???
} elseif (isset($_POST['practice'])){ // WORK IN PROGRESS
	include_once 'funcscr/dbconnect.php';
	include_once 'funcscr/loggedinsql.php';
	$json = jsonParse();
	$fullwordlist = array();
	$wordlist = getWordList($_SESSION['id']);
	$yeargroup = $json;
	$fullwordlist = allYearsWordBuilder($yeargroup, $fullwordlist);
	//var_dump($fullwordlist);
	if ($wordlist == null){

	} else {

	}
	var_dump($wordlist);
} elseif (isset($_POST['revision_test'])){
	echo '<div class="spelling_form">';
		echo '<form name="num_words_input_form" method="post" action="testprocess.php">';

			#echo '<div class="single_word">';
			#	echo '<label for="num_words">Number of words:</label>';
			#	echo '<input type="number" name="num_input" class="num_words" min="1" max="1000" required>';
			#echo '</div>';
			echo '<div class="single_word">';
				echo '<label for="year">Select year: </label>';
				echo '<select name="year" id="year" required>';
				echo '<option value="all">Years 1-6</option>';
				echo '<option value="year_1">Year 1</option>';
				echo '<option value="year_2">Year 2</option>';
				echo '<option value="year_3_4">Year 3 & 4</option>';
				echo '<option value="year_5_6">year 5 & 6</option>';
				echo '</select>';
			echo '</div>';
			echo '<div class="single_word">';
				settingInputBuilder();
			echo '</div>';
			echo '<div class="submit_button">';
				echo '<button type="submit" name="revision_test" value="revision_test">Next</button>';
			echo '</div>';
		echo '</form>';
	echo '</div>';
} elseif (isset($_POST['random_test'])){
	echo '<div class="spelling_form">';
		echo '<form name="num_words_input_form" method="post" action="testprocess.php">';
			echo '<div class="single_word">';
				if(isset($_SESSION["loggedin"])){
					echo "<label for='testname' class='test_name_label'>Test Name: </label>";
					echo "<input type='text' class='testname' name='testname' required>";
				};
			echo '</div>';

			echo '<div class="single_word">';
				echo '<label for="num_words">Number of words: </label>';
				echo '<input type="number" name="num_input" class="num_words" min="1" max="1000" required>';
			echo '</div>';
			echo '<div class="single_word">';
				settingInputBuilder();
			echo '</div>';
			echo '<div class="submit_button">';
				echo '<button type="submit" name="random_test" value="random_test">Create Test</button>';
			echo '</div>';
		echo '</form>';
	echo '</div>';
}
?>
<?php include "footer.php"; ?>
