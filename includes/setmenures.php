<?php session_start(); 
	include_once("dbconnect.php");
	include_once("website.php");	
		if(isset($_POST['selectmenu'])){
				$menu=$_POST['menu'];
                //echo "$menu";
 		    	$websiteid=3;
	 		  	//echo " in res websiteid=".$websiteid;
	         	$setmenu=new Website();
	 			$setmenures=$setmenu->addPageMenu($websiteid,$menu);
		 			if($setmenures>0){
		 				echo "<script>alert('Menus are added to your website successfully!!!!');</script>";
		 				echo "<script>window.location='../setmenu.php';</script>";
		 			}	
		 		    else{
		 		    	echo "<script>alert('menus are not updated.');<script>";
		 				echo "<script>window.location='../setmenu.php'</script>";
		 			}
 		}	