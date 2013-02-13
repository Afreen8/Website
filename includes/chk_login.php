<?php
/*
* This file does the processing of data passed by user login form
*/
session_start();
include_once('conn.php');

if (isset($_POST['btnsubmit']))
{

	$username = $_POST['username'];
	$password = $_POST['password'];
	$error= '';
	if (empty($username)) {
		$error.= "Username field should not empty<br>";
	}
	if (!empty($username) && (ctype_alnum($username))==FALSE) {
		$error.= "Only alphabets and numbers allowed in username field<br>";
	}
	if (empty($password)) {
		$error.= "Password field should not empty<br>";
	}
	if (!empty($error)) {
		echo "Please go back and fix following errors <br/>$error";
	} else {
		$user =  new User();
		$encryptpassword = md5($password);
        //echo "$encryptpassword";
		$result =$user->login($username,$encryptpassword);
		
		if($user->num_rows($result)==1) 
		{
            //echo "$username";
			$_SESSION['user_login']= $username;
			echo "<script>alert('Login Successful')</script>";
			echo "<script>window.location.href='../create-website.php'</script>";
		}
		else
		{
			echo "<script>alert('Username or password is incorrect')</script>";
			echo "<script>window.location.href='../login.php'</script>";
		}
    }
}
?>