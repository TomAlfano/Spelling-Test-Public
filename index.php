<?php include 'header.php'; ?>
<div class="test_links_container">
<div class="testcodeinput">

	<form name="num_words_input_form" method="post" action="testcodebuilder.php">
		<label for="num_words">Enter Test Code:</label>
		<input type="number" name="code_input" id="test_code">
		<input type="submit" name="submit" >
	</form>
</div>
<div class="test_form_links">
    <form name="test_input" method="post" action="testbuilder.php">
	<?php
		if(isset($_SESSION["loggedin"])){
		echo '<div class="test_links">';
			echo '<button class="test_button" type="submit" name="custom_test" value = "custom_test">Custom Spelling Test</button>';
			echo '<p class="info_labels" for="custom_test">Custom test where you can enter in each word individually and select further options. This is the best option for making a class test</p>';
		echo '</div>';
		//WORK IN PROGRESS
		//echo '<div class="test_links">';
			//echo '<button class="test_button" type="submit" name="practice" value = "practice">Practice Spelling Test</button>';
			//echo '<p class="info_labels" for="practice">A practice mode where it records all your results and gives you words from the UK government categories similar to what you get wrong most often. </p>';
		//echo '</div>';
		};
	?>
		<div class="test_links">
			<button class="test_button" type="submit" name="revision_test" value = "revision_test">Year Revision Tests</button>
			<p class="info_labels" for="revision_test">These are year revision tests which are created using the UK government statutory and non-statutory requirements. For more info see the about page</p>
		</div>
		<div class="test_links">
			<button class="test_button" type="submit" name="random_test" value = "random_test">Random Mode</button>
			<p class="info_labels" for="random_test">Random mode will give you completely random words from the English dictionary. Be warned as many words will not be age appropriate for learning children</p>
		</div>
	</form>
</div>
</div>
<?php include "footer.php"; ?>
