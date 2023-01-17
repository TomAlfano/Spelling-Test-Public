<?php include 'header.php'; ?>
<?php
include 'funcscr/sql.php';
$spelling_list = array();
if (isset($_POST['testname'])){ //For Random modes where form links to this page
	$_SESSION['testname'] = $_POST['testname'];
};
$x = 0;
if (!isset($connection)){
	include "funcscr/dbconnect.php";
};

if (!isset($settings)){ //If setting were not on the last form/ linking page gets settings
	$settings = json_encode($_SESSION['settings']);
}
//$testid = rand();
//CAN OUTPUT SETTINGS HERE IF NEEDED
for ($x = 0; $x < (count($_POST)); $x++) {
  array_push($spelling_list, strtolower($_POST["word".$x]));
};
if(isset($_SESSION["loggedin"])){
	require_once 'funcscr/loggedinsql.php';
	uploadTest($spelling_list,  $_SESSION['testname'], $settings);
};

//var_dump($spelling_list);

@$_SESSION['spellingList'] = $spelling_list;
include 'spelling_test.php';
spellingTest($spelling_list);
?>
<?php  ?>

<?php include "footer.php"; ?>
