<?php include 'header.php'; ?>
<div class="all_test_container">
<?php
  include 'funcscr/loggedinsql.php';
  if (!isset($connection)){
		include "funcscr/dbconnect.php";
	};
  $words = getTestWords($_SESSION['id']);
  #var_dump($words);
  foreach($words as $key => $value){
    echo "<div class='all_test_items'>";
    echo "<h3>Test Code: ".$key."</h3>";
    echo "<h3>Test Name: ".$value['testname']."</h3>";
    //var_dump($value);
    echo "<h3>Word List: <h3>";
    echo "<p>";
    for ($i = 0; $i < count($value['words']); $i++){
      echo $value['words'][$i].", ";
    }
    echo "</p>";
    echo "<form action ='delete_entries.php' method='post'>";
    echo "<button value =".$key." name='delete_test'>Delete Test</button>";
    echo "</form>";
    echo "</div>";
  }
?>
</div>
<?php include "footer.php"; ?>
