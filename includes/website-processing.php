<?php
@session_start();

include_once('website.php');
include_once('user.php');
$website = new Website();
if (isset($_POST['website_name'])) {
	$website_name = trim($_POST['website_name']);
	addwebsite($_SESSION['user_login'],$website_name);
}

function addwebsite($user_id,$website_name)
{
	$website = new Website();
    $user = new user();
	$result = $user->getuserpk($_SESSION['user_login']);
	$row = $user->fetch_array($result);
    $user_id = $row['user_pk'];
    
	 error_log("addwebsite".$user_id.",".$website_name);
	 $result = $website->createwebsite($user_id,$website_name);
	 
     if ($website->rowsaffected()>0) {
	        //echo '1';
            $res = $website->getwebsiteid($user_id, $website_name);  
            $result = $website->fetch_array($res);
	  		   echo $result['website_id'];
	  	}
	  	else {
	  	
	 	echo '0';
	}
}

function getuserwebsites()
{
	$website = new Website();
	$user = new user();
	$result = $user->getuserpk($_SESSION['user_login']);
	$row = $user->fetch_array($result);
    $user_id = $row['user_pk'];
    error_log($user_id);
	$result = $website->getuserwebsites($user_id);
	if ($website->num_rows($result)>0) {
        while ($row1 = $website->fetch_array($result)) {
            
        	$main_page= $row1['main_page'];
            //echo "Main Page:".$main_page;
        	error_log("main page ".$main_page);
        	if ($main_page == null ) {
        	    //echo "dosnbnb";
        		echo "<tr><td><a href='set-home-page.php?id=".$row1['website_id']."' target='_blank'>".$row1['website_name']."</a></td>";
        		//echo "<script>alert('Please set your website home page first.')</script>";
        	} else {
        	    //echo "Hi";
            	echo "<tr>
            	<td><a href=websitepreview.php?website_id=".$row1['website_id']."&pageurlid=".$row1['main_page']." target='_blank'>".$row1['website_name']."</a></td>";
            }
            
            echo "<td><a href='add-pages.php?id=$row1[website_id]'>Add Pages</a></td></tr>";
        }
    }
    else{
        echo "<tr><td>There are no websites.</td></tr>";
    }
}
?>