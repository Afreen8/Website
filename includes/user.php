<?php

include_once('dbconnect.php');

class user{
    
    var $database = null;
	function __construct() {
		$this->database = new DBConnection();
	}
    
    public function getuserpk($var)
    {
        $query = "select * from user_info where user_name = '$var'";
        
        $result_set = $this->database->query($query);
        return $result_set;
    }
    
    public function fetch_array($result_set) {
		return mysql_fetch_array($result_set);
	}
}

$user = new user();

?>