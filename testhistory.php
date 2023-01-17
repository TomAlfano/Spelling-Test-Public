<?php include 'header.php'; ?>
<?php
  include 'funcscr/loggedinsql.php';
  if (!isset($connection)){
		include "funcscr/dbconnect.php";
	};
  #var_dump($results);
  function data(){
    $data = array();
    if (isset($_POST['test_id'])){
      $results = getTestResults($_SESSION['id'], $_POST['test_id']);
    } else {
      $results = getTestResults($_SESSION['id']);
    }

    #var_dump($results);
    #$data = ['1','5','10','15','3','1'];
    #var_dump($results);
    return json_encode($results);

  };
  function labelData(){
    #$labels = array();
    if (isset($_POST['test_id'])){
      $words = getTestWords($_SESSION['id'], $_POST['test_id']);
    } else {
      $words = getTestWords($_SESSION['id']);
    }

    return json_encode($words);

  };

  function returnID(){
    return $_POST['test_id'];
  }
?>
<div class="chart_individual">
  <script src="funcscr/jscripts.js"></script>
  <script>

    function getAverage(answers, timescompleted){ //need to double check maths is correct
      var max = answers.length * timescompleted;
      var totalscore = 0;
      for (let x = 0; x < answers.length; x++){
        totalscore = totalscore + answers[x];
      };
      return Math.round(((totalscore/max)*100)*100)/100;
    };

    var datalist = <?php echo data(); ?>;
    //document.write(datalist);
    var testlist = <?php echo labelData(); ?>;
    var x = 0;



    for (key in datalist) {
      console.log(datalist[key].seprate);
      var answers = datalist[key].answers;

      //console.log(answers);

      if (datalist[key].seprate){
        var words = [];
        for (let i = 0; i < datalist[key].timescompleted; i++){

          words.push('attempt ' + (i+1));
        }

    } else{
        var words = testlist[datalist[key].testid].words;
      }
      console.log(words);
      console.log(answers);

      var chartnum = 'chart'+x;
      dataset = [];
      //console.log(answers);

      for (let i = 0; i < words.length; i++){
        dataset.push({x:words[i], y:answers[i]});
      };
      if (datalist[key].seprate && x===0){
        document.write("<h3>Test Code: " + datalist[key].testid + "</h3>");
        //document.write("<h3>Test name: " + testlist[key].testname  + "</h3>");
        document.write("<a class = 'back_button' href='testhistory.php'>&laquo; Back</a>");
      }
      document.write("<div class='chart_container'>");
        document.write("<div class = 'chart_info'>");

          if (datalist[key].seprate){
            //document.write("<h3>Test ID: "+ datalist[key] + "</h3>");
            document.write("<h3>Username: " + datalist[key].username + "</h3>");
            document.write("<h3>Name: " + datalist[key].name + "</h3>");
            document.write("<h3>Times completed: " + datalist[key].timescompleted + "</h3>");
            document.write("<h3>Length of test: " + testlist[datalist[key].testid].words.length + "</h3>");
          }else{
            document.write("<h3>Test Code: " + datalist[key].testid + "</h3>");
            document.write("<h3>Test name: " + testlist[key].testname + "</h3>");
            document.write("<h3>Times completed: " + datalist[key].timescompleted + "</h3>");
            document.write("<h3>Test Average: " + getAverage(answers, datalist[key].timescompleted) + "%</h3>");
            document.write("<form action ='testhistory.php' method='post'>");
            document.write("<button value ="+ datalist[key].testid +" name='test_id'>More Details</button>");
            document.write("</form>");
            document.write("<form action ='delete_entries.php' method='post'>");
            document.write("<button value ="+ datalist[key].testid +" name='delete'>Delete Test</button>");
            document.write("</form>");
          }
        document.write("</div>");
        document.write("<div class='charts'>");
          document.write("<canvas id='"+ chartnum + "'></canvas>");
          createChart(dataset, chartnum);
        document.write("</div>");

      document.write("</div>");
      x++;
    };
  </script>
</div>
<?php include "footer.php"; ?>
