<?php
session_start();
print_r($_SESSION);
if ($_SESSION['user_login'] != null) {
	include_once('header.php');
	include_once('menu.php');
	include_once('includes/website.php');
    include_once('includes/user.php');
?>
<body>
	<h2>SEO Settings</h2>
	<hr>
	<form name ='seo-form' method='POST' action='./includes/seo-tags-processing.php' autocomplete='off'>
		<table>
		<tr>
			<td>Select website </td>
			<td>
				<select id='website_id' name='website_id'>
					<?php
                        $user = new user();
                        $result_set = $user->getuserpk($_SESSION['user_login']);
                        $res = $user->fetch_array($result_set);
                        
                        $user_id = $res['user_pk'];
                        //echo "$user_id";
						$website = new Website();
						$result = $website->getwebsites($user_id);

						if ($website->num_rows($result)<1) {
								//echo "<option value=' '>None</option>";
						} else {
							echo "<option value=' '>Select</option>";
							while ($row = $website->fetch_array($result)) {
								echo "<option value=".$row['website_id'].">".$row['website_name']."</option>";
							}
						}
					?>
				</select>
			</td>
		</tr>
		<tr><td>Site Title</td><td><input type='text' id = 'sitetitle' name ='sitetitle'/></td></tr>
		<tr><td>Keywords</td><td><textarea name='keywords' id = 'keywords' cols='16'></textarea></td></tr>
		<tr><td>Meta Description</td><td><textarea name = 'description' id = 'description' cols='16'></textarea></td></tr>
		<tr><td><input type='submit' id='save' name='btnsubmit'  value='Save' onclick="return validateseoform()"/>
			<input type='submit' id='update' name='btnupdate'  value='Update' onclick="return validateseoform()"/>
		<input type='reset' name='btnreset' value='Clear'/></td></tr>
	</form>
</body>
<?php include_once('footer.php');
} else {
	header('Location: ./index.php');
}
?>