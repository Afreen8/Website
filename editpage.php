<?php include_once('header.php');
 include_once('includes/website.php');
session_start();
$websiteid=$_GET['id'];
if(!isset($_GET['pageurlid']))
{
	header('Location: viewpages.php');
}
if(isset($_GET['pageurlid']))
{
   $pageid=$_GET['pageurlid'];
	$viewpage=new Website();
    $res=$viewpage->fetchpage($websiteid,$pageid);
    $db=new DBConnection();
    $pagerow=$db->fetch_assoc($res);
    			$pageid=$pagerow['page_id'];
   		 		$pagename=$pagerow['page_name'];
    			$pagecontent=$pagerow['page_content'];
    			$dbmenu=$pagerow['menu'];
    			$dbsubmenu=$pagerow['submenu'];
    			$dbpagestatus=$pagerow['page_status'];
}

//echo 'dbmenu'.$dbmenu;
?>
<title>Edit Page</title>
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
function editepagevalidate()
{  
	
	  String.prototype.trim = function() {
      return this.replace(/^\s+|\s+$/g,"");
    }
    
	var page=document.getElementById('pagename').value;
	var pagecont=document.getElementById('pagecontent').value;
	var menu=document.getElementById('pagemenu').value;
	var pgstatus=document.getElementById('pagestatus').value
	
	if((page.trim() == '')||(page.trim() == null))
	{
		
		alert('Please Enter Page Name');
		document.getElementById('pagename').focus();
		return false;
	}

	if((pagecont.trim() == '')||(pagecont.trim() == null))
	{
		alert('Please Enter Page Contents');
		document.getElementById('pagecontent').focus();
		return false;
	}
	
	if((menu=='Yes')||(menu== null)){
	    smenu=document.getElementById('checksubmenu').value;
       
	   	    /*
 * if(smenu ==''){
 * 	    	alert('please select submenu option');
 * 	    	document.getElementById('checksubmenu').focus();
 * 	    	return false;
 * 	    }
 */
	  	if(smenu == 'Yes'){
	  		if(check()){
	  			return true;
	  		}
	  		else{ 
	  			return false;
	  		}
	  	}
	  	if(smenu == 'No'){
			return true;
		}
		return true;
	}
	
	if((pgstatus=="")||(pgstatus==null))
	{
		alert('please select Page status field. ');
		document.getElementById('pagestatus').focus();
		return false;
	}
	
	   return true
}

$(document).ready(function(){
	$('#submenudiv').hide();
	$('#submenucontent').hide();
	if($('#pagemenu').val()=='Yes')
	{
		$('#submenucontent').show();		
	}	
$("#pagemenu").change(function() {
      var menuvalue = $(this).val();
      if(menuvalue=='Yes')
      $('#submenucontent').show();
  	  if(menuvalue=='No')
  	  $('#submenucontent').hide();	

});

// $('#submenucontent').hide();
$("#checksubmenu").change(function() {
      var selectvalue = $(this).val();
      if(selectvalue=='Yes')
      $('#submenudiv').show();
  	  if(selectvalue=='No')
  	  $('#submenudiv').hide();	
});
});
</script>
	<h2>Modify page</h2>
	<form name='createpage' action='includes/createpage_res.php?id=<?=$websiteid?>' method='post' >
	<table border='0'>
	<tr>
		<td colspan='2'><input type='hidden'  name='pageid' id="pageid" value="<?php if(!empty($pageid)) echo $pageid;?>" ></td>
	</tr>
	<tr>
		<td>Page Name</td>
		<td><input type='text'  name='pagename' id="pagename" value="<?php if(!empty($pagename)) echo $pagename;?>" ></td>
	</tr>
	<tr>
		<td>Page Content</td>
		<td><textarea name='pagecontent' id="pagecontent"  height='50' width='70'><?php if(!empty($pagecontent)) echo $pagecontent; ?></textarea></td>
	</tr>	
	<tr><td>Menu page</td>
		<td><select id='pagemenu' name='pagemenu'>
			<option value='Yes'<?php if($dbmenu=='Yes') echo 'selected';?>>Yes</option>
		    <option value='No' <?php if($dbmenu=='No') echo 'selected'; ?>>No </option>
		    </select>
		</td>
	</tr>
	<td colspan='2'>
		<div id='submenucontent'>
	  		<?php //if($dbmenu=='Yes')
				//{		  			
	  			$website = new Website();
	  			$submenu=$website->fetchsubmenuspages($websiteid,$pageid);
	  		  	$num=$website->num_rows($submenu);
	  			if($num>0){
	  				echo "Submenu pages:<br>";
	  				while($pages=$website->fetch_assoc($submenu)) {
	  			?>
	  			<input type='checkbox' name='arrsubmenu[]' value='<?php echo $pages['page_id'];?>' <?php if($pages['parent_id']==$pageid) {echo 'checked';}?>> <?php echo $pages['page_name']; echo "<br>"; ?>
	
	  			<?php } 
	  			}
	  			
	  			$website = new Website();
	  			$submenus=$website->editblankpages($websiteid,$pageid);
	  		  	$smenunum=$website->num_rows($submenus);
	  		  	if($smenunum>0)
	  		  	{
	  			?>
	  			Want to add more submenu ? 
				<select id='checksubmenu' name='checksubmenu'>
				<option value='' selected >Select</option>
				<option value='Yes'>Yes</option>	
				<option value='No'>No</option>
				</select> 
	  			<!--<input type='checkbox' id="checksubmenu" name='checksubmenu' value='yes'><br>-->
	  			<div id='submenudiv'>
	  			Submenu pages :<br>
	  			<?php while($nonmenupages=$website->fetch_assoc($submenus)){
	  					 ?>
	  					<input type='checkbox' name='submenu[]' value='<?php echo $nonmenupages['page_id'];?>' > <?php echo $nonmenupages['page_name']; echo "<br>"; ?>
	  					<?php 
	  					}
	  			}
	  		
	  			?>
	  			</div>	
	  	</div>

	<tr><td>Page Status</td>
		<td><select id='pagestatus' name='pagestatus'>
			<option value='Active'<?php if($dbpagestatus=='Active') echo 'selected';?>>Active</option>
		    <option value='Inactive' <?php if($dbpagestatus=='Inactive') echo 'selected'; ?>>Inactive</option>		    </select>
		</td>
	</tr>
	  <tr><td colspan='2' align='center'><input type='submit'  name='btnmodifypage' value="Modify page " onClick="return editepagevalidate();" ></td></tr>
	</table>	
	</form>
<?php  include_once('footer.php');?>