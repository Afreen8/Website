<?php
session_start();
unset($_SESSION['user_login']);
session_destroy();

echo "<script>alert('Logout Successfully!!!!');
self.location = 'login.php';</script>";
?>