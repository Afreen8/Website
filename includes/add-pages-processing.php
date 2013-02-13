<?php
include_once ('website.php');
$website = new Website();
//print_r($_POST);

if (isset($_POST['website_id'])) {
	//$default_content = 'Body content will display here';
	$website_id =$_POST['website_id'];
	$page = json_decode($_POST['page']);
    
	$result = $website->addpage($website_id,$page);
	if ($website->rowsaffected()>0) {
		echo "1";
	} else {
		echo "0";
	}
}
?>