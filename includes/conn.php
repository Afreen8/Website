<?php

/**
* This is a User Class that enables, to do different operations for user
*/
include_once('dbconnect.php');
class User 
{
	var $database =null;
	function __construct()
	{
		$this->database = new DBConnection();
	}

	public function adduser($name,$email,$username,$password)
	{
		$query ="INSERT INTO user_info (name,user_email,user_name,user_password)values('$name','$email','$username','$password')";
		$result_set = $this->database->query($query);
		return $result_set;
	}
	public function login($username,$password)
	{
        
		$query ="SELECT * FROM user_info WHERE user_name ='$username' and user_password='$password' and user_status='active'";
		$result_set = $this->database->query($query);
		return $result_set;	
	}
	public function getuserid($username)
	{
		$query ="SELECT user_pk FROM user_info WHERE user_name ='$username'";
		$result_set = $this->database->query($query);
		return $result_set;		
	}
	public function rowsaffected()
	{
		return $this->database->affected_rows();
	}
	public function num_rows($result_set)
	{
		return $this->database->num_rows($result_set);
	}

	public function fetch_object($result_set)
	{
		return $this->database->fetch_object($result_set);
	}
}
?>