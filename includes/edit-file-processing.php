<?php
include_once('file.php');
$id = $_POST['id'];
// echo "$id";

// $result = $file->getfile($id);

// $row = $file->fettch_object($result);
// $filename = $row->file_path.$row->file_name;
// echo "<img src='$filename' height='100' width='100'>";
// if (isset($_POST['btnupload'])) {
// $result = $file->updatefile($id)

if (isset($_POST['btnupload'])) {
	$file = new Fileclass();

	$error ='';

	if ($_FILES["file"]["error"] > 0)
	{
		// echo "Error: " . $_FILES["file"]["error"] . "<br>";
		echo "Please Select file to upload.<br>";
		echo "<a href='view-file.php'>Back</a>";
	}
	else {

		$image_extension =  array('jpg' ,'jpeg' ,'gif','png');
		$video_extension = array('avi','mpeg','mp4');
		$result = $file->getfile($id);
		$row = $file->fetch_object($result);
		$filename = $row->file_path.$row->file_name;
		// echo "test ".$filename."<br>";
		unlink($filename);
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		
        $extension = strtolower($extension);
        //echo "$extension";
		if ($extension =='jpg' || $extension =='jpeg' || $extension =='gif' ||$extension =='png' ) {
			// echo "extension ".$extension."<br>";
			$target_path = "images/";
		}
		elseif ($extension =='avi' || $extension =='mpeg' || $extension =='mp4') {
			// echo "extension ".$extension."<br>";
			$target_path = "videos/";	
		}
		else
		{
			$error ="File type not valid";
		}
		if(empty($error)){

			$file_path = $target_path;
			$file_name = $id.".".$extension;
			
			$final = $target_path . $file_name; 
		
			if(move_uploaded_file($_FILES['file']['tmp_name'], $final)) {

				// echo $final;
			    $result = $file->editfile($id,$target_path,$file_name);
			  //  if ($file->affected_rows()>0) {
				// echo "The file ".  basename( $_FILES['file']['name'])." has been uploaded";
			  
			    echo "<script>alert('File has been uploaded')</script>";
				echo "<script>window.location.href='view-file.php'</script>";
			   /* }
			    else
			    {
			    	unlink($final);
			    	echo "<script>alert('There was an error uploading the file, please try again!')</script>";
					echo "<script>window.location.href='view-file.php'</script>";
			    	echo "There was an error uploading the file, please try again!";	
			    }*/
			} else{
				unlink($final);
				echo "<script>alert('There was an error uploading the file, please try again!')</script>";
				echo "<script>window.location.href='upload-file.php'</script>";
			    echo "There was an error uploading the file, please try again!";
			}
		}
		else{
			echo "".$error;
		}
		
	}	
}
?>