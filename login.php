<?php include 'header.php'; ?>
<?php

include "funcscr/dbconnect.php";
function normalise($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

if (isset($_POST['uname']) && isset($_POST['password'])) {

    $uname = trim($_POST['uname']);
    $pass = trim($_POST['password']);
    if (empty($uname)) {
        echo "<p> Username is requiered </p>";
        exit();
    }else if(empty($pass)){
        echo "<p> Password is required </p>";
        exit();
    }else{
		if (isset($_POST['login'])){ //checks for if login was clicked
				$sql = "SELECT * FROM user WHERE username='$uname'";
				$connection = connect();
				$result = mysqli_query($connection, $sql);
				if (mysqli_num_rows($result) == 1) {
					$row = mysqli_fetch_assoc($result);

					if ($row['username'] === $uname && password_verify($pass, $row['password'])) {
						echo "<p> Logged in! </p>";
						$_SESSION['loggedin'] = true;
						$_SESSION['username'] = $row['username'];
						$_SESSION['id'] = $row['id'];
						//sleep(3);
            include "footer.php";
						echo "<script>window.location.href = 'index.php' </script>";
						exit();
					}else{
						echo "<p> Password is incorrect </p>";
            include "footer.php";
						exit();
					}
				}else{
					echo "<p> Password or Username is incorrect/ not found </p>";
          include "footer.php";
					exit();
				};

		}elseif (isset($_POST['createAcc'])){
			//checks if username exists
			$connection = connect();
			$user_check = "SELECT * FROM user WHERE username='$uname' LIMIT 1";
			$result = mysqli_query($connection, $user_check);
			$user = mysqli_fetch_assoc($result);
			if ($user){
				echo "<p> Username already exists </p>";
			}else{ //if doesn't exist created account
				$pass = password_hash($pass, PASSWORD_DEFAULT);
				$sql = "INSERT INTO user (username, password) VALUES('$uname', '$pass')";
				mysqli_query($connection, $sql);
				echo "<p> Account successfully created! </p>";
				echo "<p> You can now login </p>";
			};


		};
    };
}else{
    include "footer.php";
    exit();
}
?>
<?php include "footer.php"; ?>
