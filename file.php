<?php
/**
* This class enable file related operations
*/
include_once('dbconnect.php');
class Fileclass
{
	var $database = null;
	function __construct()
	{
		$this->database = new DBConnection();
	}

	public function uploadfile($id,$user_id,$target_path,$file_name)
	{

		$query ="INSERT INTO file_upload (file_pk,user_fk,file_path,file_name)values('$id','$user_id','$target_path','$file_name')";
		//echo"$query";
        error_log(" ".$query);
		$result_set = $this->database->query($query);
		return $result_set;
	}

	public function getmaxid()
	{
		$query ="SELECT max(file_pk) as file_pk FROM file_upload ";
		$result_set = $this->database->query($query);
		return $result_set;
	}

	public function getuserfiles($user_id) //
	{
		$query ="SELECT file_pk, file_path , file_name FROM file_upload WHERE user_fk='$user_id'";
		$result_set = $this->database->query($query);
		return $result_set;
	}

	public function getfile($id)
	{
		$query ="SELECT file_path , file_name FROM file_upload WHERE file_pk='$id'";
		$result_set = $this->database->query($query);
		return $result_set;
	}
	public function deletefile($id)
	{
		$query ="DELETE FROM file_upload WHERE file_pk='$id'";
		$result_set = $this->database->query($query);
		return $result_set;
	}

	public function editfile($id,$target_path,$file_name)
	{
		$query ="UPDATE file_upload SET file_path='$target_path',file_name='$file_name' WHERE file_pk='$id'";
		error_log(" ".$query);
		$result_set = $this->database->query($query);
		return $result_set;
	}
	public function fetch_array($result_set)
	{
		return $this->database->fetch_array($result_set);
	}

	public function affected_rows() {
	    return $this->database->affected_rows();
	}

	public function fetch_object($result_set)
	{
		return $this->database->fetch_object($result_set);
	}	

	public function num_rows($result_set)
	{
		return $this->database->num_rows($result_set);
	}

}
?>