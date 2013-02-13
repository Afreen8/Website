<?php
include_once ('website.php');
$website = new Website();
// print_r($_POST);
$error = array();
if (isset($_POST['pages']) && isset($_POST['website_id'])) {
	$website_id = $_POST['website_id'];
	$page_id_array = array();
	foreach ($_POST['pages'] as $key => $value) {
		if ($value == 'true' && $key >0) {
			array_push($page_id_array, $key);
		}
	}
	$result = $website->setmenupages($website_id,$page_id_array);
	if ($website->rowsaffected() <1) {
		array_push($error, $key);
	}

	if (count($error)>0) {
		foreach ($error as $key => $value) {
			// not added to menu
			error_log("Page Id :".$key);
		}
		echo 0;
	} else {
		echo 1;
	}
}
?>