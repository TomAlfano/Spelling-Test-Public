<?php

	//loads apis and authenticates service account
	require 'vendor/autoload.php';
	use Google\Cloud\Core\ServiceBuilder;
	putenv('GOOGLE_APPLICATION_CREDENTIALS=C:\wamp64\www\spellingTest\spelling-test-342112-a22b9871fc4b.json');
	$cloud = new ServiceBuilder();

	//loads api components for test to speech
	use Google\Cloud\TextToSpeech\V1\AudioConfig;
	use Google\Cloud\TextToSpeech\V1\AudioEncoding;
	use Google\Cloud\TextToSpeech\V1\SynthesisInput;
	use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
	use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

	//$spelling_list = array();

	//$spelling_list = $_SESSION['spellingList']; //can get rid of this when above is saved from creation page


	//creates the mp3 file then creates section webpage for audio players
function spellingTest($spelling_list){
	echo '<div>';
	#var_dump($spelling_list);
	if (isset($_SESSION['testid'])){
		if(isset($_SESSION["loggedin"])){
			$id = $_SESSION['testid'];
			echo '<div>';
			echo "<h2>Test Code: ".$id."</h2>";
			echo '</div>';
		}
	}

	echo "<div class = 'test_container'>";
	if(!isset($_SESSION["loggedin"])){
		echo "<div class = 'audio_container' style='margin-top: 20px;'>";
	}else{
		echo "<div class = 'audio_container'>";
	}

	for ($x = 0; $x < count($spelling_list); $x++) {
	  $textToSpeechClient = new TextToSpeechClient();
		$settings =  $_SESSION['settings'];
	  $langcode =$settings['lang_type'];
		$langname = $settings['language'];
	  $input = new SynthesisInput();
	  $input->setText($spelling_list[$x]);
	  $voice = new VoiceSelectionParams();
	  $voice->setLanguageCode($langcode);
		$voice->setName($langname);
	  $audioConfig = new AudioConfig();
	  $audioConfig->setAudioEncoding(AudioEncoding::MP3);
	  $filename = $spelling_list[$x].'.mp3';

	  $resp = $textToSpeechClient->synthesizeSpeech($input, $voice, $audioConfig);
	  file_put_contents('audio/'.$spelling_list[$x].'.mp3', $resp->getAudioContent());
	  $y = $x +1;
	  echo "<div class = 'audio_buttons'>";
	  echo "<h2 class = 'q_title'>Word ".$y."</h2>";
	  echo "<audio controls>";
	  echo  "<source src='audio/" .$filename ."' type='audio/mpeg'>";
	  echo  "Your browser does not support the audio element.";
	  echo  "</audio>";
	  echo "</div>";
	};
	echo "</div>";
	echo "<div class = test_form>";
	echo "<form method = 'post'  action = 'results_page.php'>";
	if(!isset($_SESSION["loggedin"])){
		echo '<div>';
		echo '<label class="label">Name (optional) </label>';
		echo '<input type="text" name="name" placeholder="name"><br>';
		echo '</div>';
	};
	for ($x = 0; $x < count($spelling_list); $x++){ //CAN MOVE THIS INTO ABOVE LOOP
	  $y = $x +1;
	  echo "<div class = 'answer_form'>";
	  echo "<h2 class = 'a_title'>Answer ".$y."</h2>";
	  echo "<input type = 'text' name = 'answer".$x."'>";
		if ($_SESSION['settings']['definition'] == true){
			$definition = getDefinitions($spelling_list[$x]);
			//echo $definition;
			echo '<div class="tooltip">';
				echo '<span class="tooltiptext">'.$definition.'</span>';
				echo '<h2> ?</h2>';
			echo '</div>';
		}
	  echo "</div>";
	}
	echo "<input type='submit' class = 'submit_button'>";
	echo "</form>";
	echo "</div>";
	echo "</div>";
	echo '</div>';
};
?>
