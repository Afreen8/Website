<?php
session_start();
if ($_SESSION['user_login'] != '') {
	include_once('website.php');
	$page_id = $_POST['page'];
	$website_id = $_POST['website_id'];
	error_log("page_id ".$page_id.", website_id: ".$website_id);
	$website = new Website();
	$result = $website->setmainpage($page_id,$website_id);
	if ($website->rowsaffected() >0) {
		echo 1;
	} else {
		echo 0;
	}
} else {
	header("Location: ../index.php");
}
?>