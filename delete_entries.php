<?php include 'header.php'; ?>
<?php
  if (!isset($connection)){
    include "funcscr/dbconnect.php";
  };
  include 'funcscr/loggedinsql.php';
  if (isset($_POST['delete'])){
    deleteTest($_POST['delete']);
    echo "<script>window.location.href = 'testhistory.php' </script>";
  };
  if (isset($_POST['delete_test'])){
    deleteTest($_POST['delete_test']);
    echo "<script>window.location.href = 'alltests.php' </script>";
  };
  if (isset($_POST['delete_account'])){
    deleteAccount($_SESSION['id']);
    echo "<script>window.location.href = 'logout.php' </script>";
  };
?>
<?php include "footer.php"; ?>
