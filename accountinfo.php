<?php include 'header.php'; ?>
<div class="account_info_container">
<h2> Account Information </h2>
<?php
echo "<h3>Username: ".$_SESSION['username']."</h3>";
echo '<form action = "delete_entries.php" method="post">';
  echo '<button class="delete_acc_btn" value="delete" name="delete_account"><a>Delete Account</a></button>';
echo '</form>';
?>
</div>
<?php include "footer.php"; ?>
