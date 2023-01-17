<?php include 'header.php'; ?>
<?php
unset($_SESSION);
session_destroy();
echo "Logged out";

echo "<script>window.location.href = 'index.php' </script>";
//sleep(3);
?>
<?php include "footer.php"; ?>
