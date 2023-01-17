<?php
	function returnValue($value, $i){
		if (isset($value[$i])){
			return $value[$i];
		};
		return '';
	};

	function wordInputBuilder($numwords, $value = array()){
        for ($i = 0; $i < $numwords; $i++) {
          echo "<div class='single_word'>";// CHECK HERE STUFF SEEMS WEIRD
          echo "<label for='num_words' class='word_row_labels'>Word ".($i+1)."</label>";
          echo "<input type='text' value='".returnValue($value, $i)."' class='word' name='word".($i)."' required>";
          echo "</div>";
        };
        echo "<input type='submit' class='submit_word' id='submit_word'>";
        echo "</form>";
	};

	function settingInputBuilder(){
		echo '<div class="single_word">';
			echo "<label for='percentage' class='word_row_labels'>Show Definitions: </label>";
			echo "<input type='checkbox' value='true' class='word' name='definition' checked>";
		echo '</div>';
		echo '<fieldset>';
			echo '<legend>Results options:</legend>';
			echo '<div class="single_word">';
				echo "<label for='percentage' class='word_row_labels'>Show Percentage: </label>";
				echo "<input type='checkbox' value='true' class='word' name='percentage' checked>";
			echo '</div>';
			echo '<div class="single_word">';
				echo "<label for='comparison' class='word_row_labels'>Comparison: </label>";
				echo "<input type='checkbox' value='true' class='word' name='comparison' checked>";
			echo '</div>';
			echo '<div class="single_word">';
				echo "<label for='graph' class='word_row_labels'>Show Chart: </label>";
				echo "<input type='checkbox' value='true' class='word' name='graph' checked>";
			echo '</div>';
			echo '<div class="single_word">';
				echo "<label for='badge' class='word_row_labels'>Show Badges: </label>";
				echo "<input type='checkbox' value='true' class='word' name='badge' checked>";
			echo '</div>';
		echo '</fieldset>';
		echo '<fieldset>';
			echo '<legend>Language options:</legend>';
			echo '<div class="lang_options">';
				echo '<label for="lang_type">Choose Accent: </label>';
				echo '<select name="lang_type">';
					echo '<option value="en-GB">British</option>';
					echo '<option value="en-US">US</option>';
					echo '<option value="en-AU">Australian</option>';
				echo '</select>';
			echo '</div>';
			echo '<div class="lang_options">';
				echo '<label for="language">Choose Gender: </label>';
				echo '<select name="language">';
					echo '<option value="-Standard-C">Female</option>';
					echo '<option value="-Standard-D">Male</option>';
				echo '</select>';
			echo '</div>';
		echo '</fieldset>';
	};

	function settingsJSONBuilder($input){
		//var_dump($input);
		$settings = array();
		if (isset($input['definition'])){
			$settings['definition'] = $input['definition'];
		}elseif(!isset($input['definition'])){
			$settings['definition'] = false;
		};
		if (isset($input['percentage'])){
			$settings['percentage'] = $input['percentage'];
		}elseif(!isset($input['percentage'])){
			$settings['percentage'] = false;
		};
		if (isset($input['comparison'])){
			$settings['comparison'] = $input['comparison'];
		}elseif(!isset($input['comparison'])){
			$settings['comparison'] = false;
		};
		if (isset($input['graph'])){
			$settings['graph'] = $input['graph'];
		}elseif(!isset($input['graph'])){
			$settings['graph'] = false;
		};
		if (isset($input['badge'])){
			$settings['badge'] = $input['badge'];
		}elseif(!isset($input['badge'])){
			$settings['badge'] = false;
		};
		if (isset($input['lang_type'])){
			$settings['lang_type'] = $input['lang_type'];
		}elseif(!isset($input['lang_type'])){
			$settings['lang_type'] = 'en-GB';
		};
		if (isset($input['language'])){
			$settings['language'] = $input['lang_type'] . $input['language'];
		}elseif(!isset($input['language'])){
			$settings['language'] = 'en-GB-Standard-C';
		};
		#$_SESSION['settings'] = $settings;
		//var_dump($settings);

		return json_encode($settings);
	};

	function jsonParse(){
		$dict = file_get_contents( __DIR__ . "\words_requirements.json");
		$json = json_decode($dict, true);
		return $json;
		#var_dump($dict);
		#var_dump($json);
	};

	function dropdownBuilder($year){

		$json = jsonParse();

		if ($year == 'all'){
			$yeargroup = $json;
		}else{
			$yeargroup = $json[$year];
			$i=0;
			echo '<div class="single_word">';
				echo '<label for="year">Select topic: </label>';
				echo '<select name="requirement" class="requirement" required>';
				echo '<option value="all">All</option>';
				foreach ($yeargroup as $requirement){
					echo '<option value="' .$i. '">'.$requirement["requirement"].'</option>';
					$i++;
				};
				if ($year == 'year_1'){
					echo '<optgroup label="Vowel digraphs and trigraphs">';
					$yeargroup = $json['year_1_vdt'];
					foreach ($yeargroup as $requirement){
						echo '<option value="' .$i. '">'.$requirement["vdt"].'</option>';
						$i++;
					};
					echo '</optgroup>';
				};
				echo '</select>';
			echo '</div>';
		};

	};


	function normaliseStep($step, $length){
		if ($step > $length){
			$step = $step - $length;
			normaliseStep($step, $length);
		} elseif ($step < 0 ){
			$step=$step+1;
			normaliseStep($step, $length);
		};
		return $step;
	};

	function revisionRandomBuilder($wordlist, $length){
		#$primes = array(1,2,3,5,7,11);
		$testwords = array();
		$step = 0;
		$stepbool = true;
		if ($length == 0){
			$length = 10;
			if ($length >= count($wordlist)){
				$length = count($wordlist);
				$stepbool = false;
			};
		};
		$count = 1;
		for ($i = 0 ; $i < $length; $i++) {
			$random = rand(0,(count($wordlist)-1));
			if ($stepbool){
				$step = $step + ($random);
				if ($step >= count($wordlist)){
					#$step = $step - count($wordlist);
					$step = normaliseStep($step, (count($wordlist)-1));
				};
			}else{
				$step = $i;
			};

			if (in_array($wordlist[$step], $testwords)){
				$i = $i-1;
				$count = $count+1;
				if ($count > 1000){
					//exit("Unable to find enough words for your test");
					return $testwords;
				};
			} else {
				array_push($testwords, $wordlist[$step]);
			};

		};
		return $testwords;
	};

	function morePrefixBuilder($words, $fullwordlist){
			foreach ($words['words'] as $subcat){
				foreach ($subcat as $subwords){
						for ($x = 0; $x < count($subwords); $x++){
							$subword = $subwords[$x];
							array_push($fullwordlist, strtolower($subword));
						};
				};
			};
			//echo 'used';
			return $fullwordlist;

	};

	function allYearsWordBuilder($yeargroup, $fullwordlist){
		foreach ($yeargroup as $year){
			$count = 0;
			foreach ($year as $words){
				//var_dump($year);
				if ($count == 3 && $year == 'year_3_4'){
					echo $count;
					//var_dump($words);
					$fullwordlist = morePrefixBuilder($words,$fullwordlist);
				}
				for ($i = 0; $i < count($words['words']); $i++){
					if ($count == 3 && $year = 'year_3_4'){
						//var_dump($year);
						//$fullwordlist = morePrefixBuilder($words,$fullwordlist);
					}else{
						array_push($fullwordlist, $words['words'][$i]);
					};
				};
				$count= $count+1;
			};

		};
		return $fullwordlist;
	};

	function lengthReturn($length){
		if ($length == 0){
			return 10;
		} else {
			return $length;
		};
	};
?>
