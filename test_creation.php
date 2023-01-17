<?php include 'header.php'; // CAN DELETE FILE NOW
?>
<div class="spelling_form">
  <form name="num_words_input_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="num_words">Number of words:</label>
    <input type="number" name="num_input" id="num_words" min="1" max="100">
    <input type="submit" name="submit" >
  </form>
  <?php
    if(isset($_POST['submit'])){
      $words = $_POST['num_input'];
      if($words != null){
		echo "<form method='post' name='word_input' class='word_input' action='spelling_test_page.php'>";
		echo "<label for='testname' class='test_name_label'>Test Name</label>";
        echo "<input type='text' class='testname' name='testname' required>";
        include 'funcscr/testbuilderfunctions.php';
		wordInputBuilder($words);
      };
    };
  ?>
</div>

<?php echo file_get_contents("html/footer.html"); ?>
