<?php
include_once('website.php');
$website_id = $_GET['id'];

if (isset($_POST['id'])) {
	error_log("In seo-tag-processings");
	$website = new Website();
	$id = $_POST['id'];
	$result = $website->getseotags($id);
	$row = $website->fetch_assoc($result);
	echo json_encode($row);
}
if (isset($_POST['btnsubmit'])) {
	//$website_id = trim($_POST['website_id']);
	$keywords = trim($_POST['keywords']);
	$sitetitle = trim($_POST['site_title']);
	$description = trim($_POST['meta_desc']);
	$error = '';
	if (empty($website_id)) {
		// $error .= "Please select website.";
		$error .= "Please select website.<br>";
	}

	if (empty($sitetitle)) {
		$error .= "Please enter site title.<br>";
	}

	if (empty($keywords)) {
		$error .= "Please enter keywords.<br>";
	}

	if (empty($description)) {
		$error .= "Please enter meta description.<br>";
	}
	if (!empty($error)) {
		echo "Go back and fix following errors <br>".$error;
	} else {
		$website = new Website();
		//$website_id =1;
		$result = $website->setseotags($website_id,$keywords,$sitetitle,$description);
		if ($website->rowsaffected()>0) {
			echo "<script>alert('SEO settings has been updated.')</script>";
			echo "<script>window.location.href='../viewpages.php?id=$website_id'</script>";

		}
		else
		{
			echo "<script>alert('SEO settings not updated.')</script>";
			echo "<script>window.location.href='../seo-settings.php'</script>";
		}

	}
}
if (isset($_POST['btnupdate'])){
	$website_id = trim($_POST['website_id']);
	$keywords = trim($_POST['keywords']);
	$sitetitle = trim($_POST['sitetitle']);
	$description = trim($_POST['description']);
	$website = new Website();
	$result = $website->updateseotags($website_id,$keywords,$sitetitle,$description);
	if ($website->rowsaffected()>0) {
		echo "<script>alert('SEO settings has been updated.')</script>";
		echo "<script>window.location.href='../seo-settings.php'</script>";

	}
	else
	{
		echo "<script>alert('SEO settings not updated.')</script>";
		echo "<script>window.location.href='../seo-settings.php'</script>";
	}
}
?>