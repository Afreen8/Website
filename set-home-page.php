<?php
session_start();
//$websiteid=$_GET['id'];
if ($_SESSION['user_login'] != '') {

	include_once('header.php');
	include_once('includes/website.php');
	include_once('includes/user.php');
	$website_id = $_GET['id'];
	$website = new Website();
	$username = $_SESSION['user_login'];
	$user = new User();
	$result = $user->getuserpk($_SESSION['user_login']);
	$row = $user->fetch_array($result);
	$user_id = $row['user_pk'];
?>
<body>
<div id ='dialog-home-page' title='Select Main Page For Website'>
	<form id="newwebsite">
        <table>
    <fieldset>
        <?php
        	$result = $website->getmpages($website_id);
        	if ($website->num_rows($result)<=0) {
        ?>
            <label for="name">Come back after adding pages to website.</label>
        <?php } else { ?>
                <tr>
                    <th colspan="2">
   					    <label for="name">Select main page for website</label>
                    </th>
                </tr>
   				<?php
					while ($row = $website->fetch_array($result)) {
						$page_name = $row['page_name'];
						$page_id = $row['page_id'];
				?>
                <tr>
         		     <td><input type="radio" name="page" id="name" value='<?php echo $page_id; ?>'/></td>
         		     <td><label for="name"><?php echo $page_name;?></label></td>
                </tr>
        	<?php 	}
    		}//echo "$website_id";
        	?>
        	<input type='hidden' name='website_id' value = '<?php echo $website_id; ?>' />
    </fieldset>
    </table>
    <p class="validateTips"></p>
    
    </form>
</div>
</body>
<?php
include_once('footer.php');
} else {
	header("Location: ./index.php");
}
?>
