<!DOCTYPE html>
<html lang="en">
    <title>SpellBee</title>
    <head>
        <meta charset="UTF-8">
        <meta name="description" contents="Test website for spellings">
        <link rel="stylesheet" href="html/style.css" type="text/css">
        <script src="jquery-3.6.0.min.js"></script>    <!-- for parsing JSON dictionary (used for something else I think) -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- ChartsJs link -->
    </head>
    <?php session_start(); ?>
    <body id="body_class">
        <header>
            <nav class="navigation">
              <div class="nav_links">
                <?php #NEED TO CHANGE CLASS NAMES TO SOMETHING MORE APPROPRIATE ?>
      				  <div class="login">
                  <li class = "logout"><a href="index.php">Home</a></li>
                  <li class = "logout"><a href="about.php">About</a></li>
        				  <?php
        					if(isset($_SESSION["loggedin"])){
        						//echo "Logged in";
                    #echo "<li class = 'logout'><a href='testhistory.php'>Test History</a></li>";
        						#echo "<li class = 'logout'><a href='logout.php'>Logout</a></li>";
                    echo '<div class="dropdown">';
                      echo '<button class="dropbtn" type="button" ><a>My Account</a></button>';
                      echo '<div class="dropdown_content">';
                        echo '<div class="dropdown_container">';
                          echo '<button class="colourbtn" ><a href="testhistory.php">Test History</a></button>';
                          echo '<button class="colourbtn" ><a href="alltests.php">All Tests</a></button>';
                          echo '<button class="colourbtn" ><a href="accountinfo.php">Settings</a></button>';
                          echo '<button class="colourbtn" ><a href="logout.php">Logout</a></button>';
                          #echo '<form action = "delete_entries.php" method="post">';
                            #echo '<button class="delete_acc_btn" value="delete" name="delete_account"><a>Delete Account</a></button>';
                          #echo '</form>';
                        echo '</div>';
                      echo '</div>';
                    echo '</div>';
        					} else {
        						echo '<form class="login" action="login.php" method="post">';
        							echo '<label class="label">Username</label>';
        							echo '<input type="text" name="uname" placeholder="Username"><br>';
        							echo '<label class="label">Password</label>';
        							echo '<input type="password" name="password" placeholder="Password"><br>';
        							echo '<button type="submit" name="login" value = "login">Login</button>';
        							echo '<button type = "submit" name="createAcc" value="createAcc">Create Account</button>';
        						echo '</form>';
        					};
        				  ?>
      				  </div>
      			  </div>
              <div class = "all_dropdowns">
                <div class="dropdown">
                  <button class="dropbtn" type="button" value="arial" onclick="fontFamilyChange(this.value)"><a>Font Style</a></button>
                  <div class="dropdown_content">
                    <div class="dropdown_container">
                      <button class="colourbtn" value="arial" onclick="fontFamilyChange(this.value)"><a style = "font-family: Arial;">Arial</a></button>
                      <button class="colourbtn" value="comic_sans" onclick="fontFamilyChange(this.value)"><a style = "font-family: Comic Sans MS, Comic Sans, cursive;">Comic Sans</a></button>
                      <button class="colourbtn" value="monaco" onclick="fontFamilyChange(this.value)"><a style = "font-family: Monaco;">Monaco</a></button>
                    </div>
                  </div>
                </div>
                <div class="dropdown">
                  <button class="dropbtn" type="button" value="default" onclick="fontSizeChange(this.value)"><a>Font Size</a></button>
                  <div class="dropdown_content">
                    <div class="dropdown_container">
                      <button class="colourbtn" value="default" onclick="fontSizeChange(this.value)"><a>Default</a></button>
                      <button class="colourbtn" value="large" onclick="fontSizeChange(this.value)"><a>Large</a></button>
                      <button class="colourbtn" value="xlarge" onclick="fontSizeChange(this.value)"><a>X-Large</a></button>
                    </div>
                  </div>
                </div>
                <div class="dropdown">
                  <button class="dropbtn" type="button" value="default" onclick="colourChange(this.value)"><a>Colour Scheme</a></button>
                  <div class="dropdown_content">
                    <div class="dropdown_container">
                      <button class="colourbtn" value="default" onclick="colourChange(this.value)"><a>White</a></button>
                      <button class="colourbtn" value="cream" onclick="colourChange(this.value)"><a>Cream</a></button>
                      <button class="colourbtn" value="orange" onclick="colourChange(this.value)"><a>Orange</a></button>
                      <button class="colourbtn" value="dark" onclick="colourChange(this.value)"><a>Dark</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
        </header>
        <div class="content_allignment">
          <div class="contents">
