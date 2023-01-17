<?php include 'header.php'; ?>
<?php
$_SESSION['creatorid'] = '';
$_SESSION['testid'] = '';
$_SESSION['settings'] = '';
$_SESSION['spellingList'] = '';

if(isset($_POST['submit'])){
	$code = $_POST['code_input'];
}
if (!isset($connection)){
	include "funcscr/dbconnect.php";
};
include "funcscr/sql.php";
include 'spelling_test.php';
spellingTest(getTest($code));


?>
<?php include "footer.php"; ?>
