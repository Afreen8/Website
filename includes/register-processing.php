<?php
/*
* This file does the processing of data passed by user registration form
*/

include_once('conn.php');

if (isset($_POST['btnsubmit']))
{
		
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
	$error= '';

	if (empty($name)) {
		$error.= "Name field should not empty <br>";
	}
	if (!ctype_alpha(str_replace(' ', '',$name))) {
		$error.= "Only alphabets allowed in name field<br>";
	}
	if (empty($email)) {
		$error.= "Email field should not empty<br>";	
	}
	if (!empty($email) && (filter_var($email, FILTER_VALIDATE_EMAIL))==FALSE) {
		$error.= "Email-Id is not valid.<br>";		
	}
	if (empty($username)) {
		$error.= "Username field should not empty<br>";
	}
	if (!empty($username) && (ctype_alnum($username))==FALSE) {
		$error.= "Only alphabets and numbers allowed in username field<br>";
	}
	if (empty($password)) {
		$error.= "Password field should not empty<br>";
	}
	/*if (!empty($password) && strlen($password)<6) {
		$error.= "Password must contain at least 6 charactres<br>";
	}*/
	if (empty($confirmpassword)) {
		$error.= "Confirm Password field should not empty<br>";	
	}
	if($password !== $confirmpassword)
	{
		$error.= "Passwords not matched<br>";
	}
	
	if (!empty($error)) {
		echo "Please go back and fix following errors <br/>$error";
	} else {
		$encryptedpassword = md5($password);
		$user =  new User();
		$result =$user->adduser($name,$email,$username,$encryptedpassword);
		if($user->rowsaffected()>0) ///Checks rows are affected or not
		{
			echo "<script>alert('User Created Successfully');
            self.location = '../login.php';</script>";
		}
		else
		{
			echo "<script>alert('User not Created');</script>";
		}
	}
}

?>