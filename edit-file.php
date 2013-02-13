<?php
session_start();
if ($_SESSION['user_login'] != null) {

	include_once('file.php');
	$action = $_GET['action'];
	$id = $_GET['id'];
	//$user_id = $_GET['userid'];
	//echo "Action:".$action." Id:".$id;


	if ($action == 'edit') {
		// echo "Editing image";
	?>
		<a href="view-file.php">Go Back</a><br/>
		<form name ='upload-file-form' method='POST' action='edit-file-processing.php' enctype="multipart/form-data">
		<input type='hidden' name='id' value='<?php echo $id;?>'/>	
		Select Image/Video Files <input type = 'file' name= 'file'/> <br />
		<input type = 'submit' name ='btnupload' value ='Upload file' onclick="return validatefileupload()"/> 
		<input type ='reset' name ='Clear'/>  

	<?php
	}
	if ($action == 'delete') {
		// echo "Deleting image";

		$file = new Fileclass();
		$result = $file->getfile($id);
		$row = $file->fetch_object($result);
		$filename = $row->file_path . $row->file_name;
		//echo "$filename<br/>";
		//$pos =strpos($filename, '/');
		//$filename = substr($filename, $pos+1);
        //echo "$filename";
		//echo "<br>test Path".$filename."<br>";
		unlink($filename);
		$result = $file->deletefile($id);
		if ($file->affected_rows()==1) {
			echo "<script>alert('File has been deleted');</script>";
			echo "<script>window.location.href='view-file.php'</script>";
		} else {
			echo "<script>alert('File not deleted,some error occured,please try again.');</script>";
			echo "<script>window.location.href='view-file.php'</script>";
		}
	}
	
} 
?>