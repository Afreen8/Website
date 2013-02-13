<?php include_once('header.php');
 include_once('includes/website.php');
 include_once('includes/library.php');
session_start();
$websiteid=$_GET['id']; //get from the page;
//echo "$websiteid";
function getwebsitepages($websiteid)
{
	$website= new Website();
	$res=$website->fetchwebpages($websiteid);
    
    $pagearr=array();
    $count=0;
     while($pagerow=$website->fetch_assoc($res)){
            if(empty($pagecontent)) {
                $pagearr[$count]=$pagerow['page_id'];
                $count++;
            }  
    	}
     return $pagearr;	
}
	

	$pagearray=getwebsitepages($websiteid);
	if(!empty($pagearray))
 	{ 
 		$pageid=$pagearray[0];
 		
	 	$website=new Website();
    	$res=$website->fetchpage($websiteid,$pageid);
    	$db=new DBConnection();   	    
   		$nrow=$db->num_rows($res);
	    $pagerow=$website->fetch_assoc($res);
			$pageid=$pagerow['page_id'];
		 	$pagename=$pagerow['page_name'];
			$pagecontent=$pagerow['page_content'];
			$dbmenu=$pagerow['menu'];
				
   }
   else{
   			echo "<script>alert('All pages created successfully!!')</script>";
    		echo "<script>window.location='viewpages.php?id=$websiteid'</script>";
    	}

?>
<title>Add Page</title>
<body>
<script type="text/javascript">
function check()
{
    var a=new Array();
    a=document.getElementsByName("submenu[]");
    var checkflag=0;
    for(i=0;i<a.length;i++){
        if(a[i].checked){
           // alert("cheked"+a[i].value);
            checkflag=1;
        }
    }
    if (checkflag==0){
        alert('Please select at least one submenu');
        return false;
    }
            
    document.forms[0].submitted.value='yes';
    return true;
}


function createpagevalidate(){  
 	String.prototype.trim = function() {
      return this.replace(/^\s+|\s+$/g,"");
    }
   	var pagecont=document.getElementById('pagecontent').value;
	var menu=document.getElementById('pagemenu').value;
	
	if((pagecont.trim() == '')||(pagecont.trim() == null)){

		alert('Please Enter Page Contents');
		document.getElementById('pagecontent').focus();
		return false;
	}
	if(menu=='Yes'){
	    smenu=document.getElementById('checksubmenu').value;
	   	    if(smenu ==''){
	    	alert('please select submenu option');
	    	document.getElementById('checksubmenu').focus();
	    	return false;
	    }
	  	if(smenu =='Yes'){
	  		if(check()){
	  			return true;
	  		}
	  		return false;
	  	}
	  	if(smenu == 'No'){
			return true;
		}
		return false;
	}
	return true;
}
</script>
<script>
$(document).ready(function(){
	$('#submenudiv').hide();

$("#checksubmenu").change(function() {
      var selectvalue = $(this).val();
      if(selectvalue=='Yes')
      $('#submenudiv').show();
  	  else
  	  $('#submenudiv').hide();	
});

});
</script>
	<h2>Add page</h2>
	<form name='createpage'  method='post' action='includes/createpage_res.php?id=<?=$websiteid?>'>
	<table border='0'>
	  <tr>
	  		<td colspan='2'><input type='hidden'  name='pageid' id="pageid" value="<?php if(isset($pageid)) echo $pageid;?>" ></td>
	  </tr>
	  <tr>
	  		<td>Page Name</td>
	  	  	<td><?php if(isset($pagename)) echo $pagename; ?></td>
	  </tr>
	  <tr>
	  		<td>Page Content</td>
	  		<td><textarea name='pagecontent' id="pagecontent" cols='16' rows='4'><?php  if(isset($pagecontent)) echo $pagecontent;?></textarea></td>
	  </tr>
	  <tr>	
	  		<td colspan='2'><input type='hidden'  id='pagemenu' name='pagemenu' value= "<?php if(!empty($dbmenu)) echo $dbmenu;?>"></td>	  </tr>	
	  <!--<tr>
	  		<td>Add as Menu page</td>
	  		<td><select id='pagemenu' name='pagemenu'>
	  			<option value="">Select</option>
	  		    <option value='Yes' <?php if($dbmenu=='Yes') echo "selected"?>>Yes</option> 
	  			<option value='No' <?php if($dbmenu=='No') echo "selected"?>>No </option>
	  			</select>
	  		</td>
	  	</tr>-->
	  	<tr>
		  	<td colspan='2'><div id='submenucontent'>
	  		<?php if($dbmenu=='Yes')
	  		{
	  			$website=new Website();
	  			$submenu=$website->fetchblankpages($websiteid);
	  		    //print_r($submenu);
	  			$num=$website->num_rows($submenu);
	  			if($num>0){
	  			

	  			?>
	  			Want to add submenu ? <select id='checksubmenu' name='checksubmenu'>
	  								<option value=''>Select</option>
	  								<option value='Yes'>Yes</option>	
	  								<option value='No'>No</option>
	  								</select> 


	  			<!--<input type='checkbox' id="checksubmenu" name='checksubmenu' value='yes'><br>-->
	  			<div id='submenudiv'>
	  				submenu pages <br>
	  			 <?php 
	  				while($pages=$website->fetch_assoc($submenu)) {
	  					echo "<input type='checkbox' name='submenu[]' value='".$pages['page_id']."' >  ".$pages['page_name']." <br>";
	  					}
	  				}
	  				else{
	  					echo "There are no more pages. ";
	  					
	  				} 
	  			?>
	  			</div>	
	  			<?php	
	  			}
	  	?>
	  		</div>
		  	</td>
	  	</tr>
	  <tr>
	  		<td colspan='1' align='center'><input type='submit'  name='addcontents' value="add contents " onClick="return createpagevalidate();" ></td>
	  </tr>
	</table>	
	</form>
	<?php  	
?>
<?php echo "<br><br>"; include_once('footer.php');?>