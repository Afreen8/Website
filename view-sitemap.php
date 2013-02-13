<?php
session_start();
include_once('includes/website.php');
include_once('includes/user.php');
$website = new Website();
$user = new User();
$user_id =1;
$website_id = 1;
$result = $website->getmenupages($website_id);
if ($website->num_rows($result)<=0) {
	echo "You dont have any pages";
} else {
	while ($row = $website->fetch_array($result)) {
		echo"<ul>".$row['page_name'];

		$result1 = $website->getsubmenupages($website_id,$row['page_id']);
		while ($row1 = $website->fetch_array($result1)) {
			echo"<li style='margin-left:40px'>".$row1['page_name']."</li>";
		}
		echo "</ul>";
	}
}
?>
<a href='mailto:harshavardhan@webiction.com'>harshavardhan@webiction.com</a>
