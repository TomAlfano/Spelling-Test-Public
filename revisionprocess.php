<?php include 'header.php'; ?>
<?php
	include 'funcscr/testbuilderfunctions.php';
	if (!isset($connection)){
		include "funcscr/dbconnect.php";
	};
	$fullwordlist = array();
	$json = jsonParse();
	$year = $_SESSION['year'];
	if (isset($_POST['testname'])){
		$_SESSION['testname'] = $_POST['testname'];
	}
	if (isset($_POST['requirement'])){
		$topic = $_POST['requirement']; //topic is number
	};
	if ($year == 'all'){ //ALL YEAR GROUPS
		$yeargroup = $json;
		$fullwordlist = allYearsWordBuilder($yeargroup, $fullwordlist);
		//var_dump($fullwordlist);
		$spelling_list = revisionRandomBuilder($fullwordlist, $_POST['num_input']);
	}else{
		if ($topic > 13 && $year == 'year_1'){
				$topic = $topic-14;
				$year = 'year_1_vdt';
		};

		$yeargroup = $json[$year];
		if ($topic != 'all'){
			#$yeargroup = $yeargroup[$topic];
			$count = 0;
			foreach ($yeargroup as $requirements){
				if ($count == $topic){
					if ($topic == 3 && $year == 'year_3_4'){
						$fullwordlist = morePrefixBuilder($requirements,$fullwordlist);
					}else{
						for ($i = 0; $i < count($requirements['words']); $i++){
							array_push($fullwordlist, $requirements['words'][$i]);
						};
					};

				};
				$count= $count+1;
			};
			$spelling_list = revisionRandomBuilder($fullwordlist, $_POST['num_input']);
			#var_dump($fullwordlist);
			#var_dump($spelling_list);
		}else{
			$count =  0;
			foreach ($yeargroup as $words){
				#var_dump($words);
				for ($i = 0; $i < count($words['words']); $i++){
					if ($count == 3 && $year == 'year_3_4'){
						$fullwordlist = morePrefixBuilder($words, $fullwordlist);
					} else {
						array_push($fullwordlist, strtolower($words['words'][$i]));
					};
				};
				$count =$count +1;
			};
			$spelling_list = revisionRandomBuilder($fullwordlist, $_POST['num_input']);
		};
	};
	#var_dump($spelling_list);

	include 'funcscr/sql.php';
	if (isset($_POST['random_words'])){
		if(isset($_SESSION["loggedin"])){
			$settings = json_encode($_SESSION['settings']); // SETTINGS HERE
			require_once 'funcscr/loggedinsql.php';
			$_SESSION['creatorid'] = $_SESSION['id'];
			//echo $_POST['testname'];
			uploadTest($spelling_list, $_POST['testname'], $settings);

		};
		$_SESSION['spellingList'] = $spelling_list;
		include 'spelling_test.php';
		spellingTest($spelling_list);

	} elseif (isset($_POST['custom'])){
		#var_dump($fullwordlist);
		$settings = $_SESSION['settings'];
		#$_SESSION['settings'] = json_decode($settings, true);
		echo '<form name="num_words_input_form" method="post" action="spelling_test_page.php">';
		wordInputBuilder(lengthReturn($_POST['num_input']), $spelling_list);

	};
?>
<?php include "footer.php"; ?>
