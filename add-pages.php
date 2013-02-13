<?php
session_start();
if ($_SESSION['user_login'] != null) {
include_once("header.php");
//include_once('menu.php');
if (!isset($_GET['id'])) {
 	header("Location: create-website.php");
 } else {
	
?>
<body>
	<div id ="dialog-add-menu" title ="Select Menu Pages"></div>
	<h2>Add Pages</h2>
	<hr>
	<form name= 'add-page-form' autocomplete='off'>
       
		<div id='pages'></div>
        <table > 
        
		<input type='hidden' id= 'website_id' name='website_id' value ='<?php echo "".$_GET['id'];?>'></tr>
        <tr>
		<td colspan="2"><input type='button' id='addpages' value='Add page'/></td>
		<td colspan="2"><input type='button' id='create' value='Create' /></td></tr>
        </table>
	</form>
</body>
<?php 
include_once("footer.php");
	}
} else {
	header('Location: ./index.php');
}
?>
