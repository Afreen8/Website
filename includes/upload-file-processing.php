<?php
session_start();
include_once("file.php");
include_once("conn.php");
if (isset($_POST['btnupload'])) {

	$file = new Fileclass();
	$user = new User();
	// $filename =$_POST['filename'];

	$error ='';

	if ($_FILES["file"]["error"] > 0)
	{
		// echo "Error: " . $_FILES["file"]["error"] . "<br>";
		echo "Please Select file to upload.<br>";
		echo "<a href='upload-file.php'>Back</a>";
	}
	else {

		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        //var $target_path;
		//echo "$extension";
        $extension = strtolower($extension);
		if ($extension == "jpg" || $extension =='jpeg' || $extension =='gif' || $extension =='png' ) {
			//echo "extension ".$extension."<br>";
			$target_path = "images/";
		}
		elseif ($extension =='avi' || $extension =='mpeg' || $extension =='mp4' || $extension == 'mov') {
			// echo "extension ".$extension."<br>";
			$target_path = "videos/";	
		}
		else
		{
            //echo "$extension";
			$error ="File type not valid";
		}
		if(empty($error)){

			$file_path = $target_path;
            //echo "target path is : $file_path";
			$result =$file->getmaxid();
			
			$row = $file->fetch_object($result);
			// while ($row = $file->fetch_array($result)) {
			// 	$id = $row['id']+1;
			// }
            //echo "$row[file_pk]";
            
			$id = $row->file_pk + 1;
           // echo "ID is ".$id;
			$file_name = $id.".".$extension;
            //echo "$file_name";
            //echo "$target_path";
			$final = $target_path . $file_name; 

			$result= $user->getuserid($_SESSION['user_login']);
			$row = $user->fetch_object($result);
			$user_id = $row->user_pk;
			
			if(move_uploaded_file($_FILES['file']['tmp_name'], $final)) {

				//echo "ID is".$id;
			    $result = $file->uploadfile($id,$user_id,$target_path,$file_name);
			    if ($file->affected_rows()>0) {
					// echo "The file ".  basename( $_FILES['file']['name'])." has been uploaded";
			  
			    echo "<script>alert('File has been uploaded')</script>";
				echo "<script>window.location.href='upload-file.php'</script>";
			    }
			    else
			    {
			    	unlink($final);
			    	echo "<script>alert('There was an error uploading the file, please try again!')</script>";
					echo "<script>window.location.href='upload-file.php'</script>";
			    	echo "There was an error uploading the file, please try again!";	
			    }
			} else{
				
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