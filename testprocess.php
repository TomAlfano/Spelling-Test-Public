<?php include 'header.php'; ?>
<?php
include 'funcscr/testbuilderfunctions.php';

$spelling_list = array();
if (isset($_POST['custom_test'])){
	$settings = settingsJSONBuilder($_POST);
	$_SESSION['settings'] = json_decode($settings, true);
	$words = $_POST['num_input'];
	$_SESSION['testname'] = $_POST['testname'];
	echo "<form method='post' name='word_input' class='word_input' action='spelling_test_page.php'>";
	wordInputBuilder($words);
}

if (isset($_POST['random_test'])){ //if random test is selected then
	if (!isset($connection)){
		include "funcscr/dbconnect.php";
	};
	include 'funcscr/sql.php';
	$num_words = 95457;
	$spelling_list = getRandomWords($_POST['num_input'], $num_words);
	$settings = settingsJSONBuilder($_POST); // SETTINGS HERE
	$_SESSION['spellingList'] = $spelling_list;
	$_SESSION['settings'] = json_decode($settings, true);
	if(isset($_SESSION["loggedin"])){
		require_once 'funcscr/loggedinsql.php';
		//echo $_POST['testname'];
		$_SESSION['creatorid'] = $_SESSION['id'];
		uploadTest($spelling_list, $_POST['testname'], $settings);

	};
	include 'spelling_test.php';
	spellingTest($spelling_list);
} elseif (isset($_POST['revision_test'])){
	if (isset($_POST['testname'])){
		echo "Test Name: ".$_POST['testname'];
	};
	$settings = settingsJSONBuilder($_POST); // SETTINGS HERE
	$_SESSION['settings'] = json_decode($settings, true);
	//var_dump($_SESSION['settings']);
	$_SESSION['year'] = $_POST['year'];

	echo '<div class="spelling_form">';
		echo '<form name="num_words_input_form" method="post" action="revisionprocess.php">';
		echo '<div class="single_word">';
			if(isset($_SESSION["loggedin"])){
				echo "<label for='testname' class='test_name_label'>Test Name: </label>";
				echo "<input type='text' class='testname' name='testname' required>";
			};
		echo '</div>';
		dropdownBuilder($_POST['year']);
		echo '<div class="single_word">';
		echo '<div class="tooltip">';
			echo '<span class="tooltiptext">For random words it is suggested to leave this blank. This is due to not all categories having many words</span>';
			echo '<label for="num_words">Number of words:</label>';
		echo '</div>';
		echo '<input type="number" name="num_input" class="num_words" min="0" max="1000" value="0">';
		echo '<label class="small_label" for="num_words"></label>';
		echo '</div>';
		#$numwords = $_POST['num_input'];
		#wordInputBuilder($numwords);
		echo '<button type="submit" name="random_words" value="random_words">Random words</button>';
		echo '<button type="submit" name="custom" value="custom">Custom</button>';

		echo '</form>';
	echo "</div>";

};
?>

<?php include "footer.php"; ?>
