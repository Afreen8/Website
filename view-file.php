<br />
<script type="text/javascript">
    function goto()
    {
        self.location='upload-file.php';
    }
</script>
<script type="text/javascript">    

    function edit(value)
    {
        //alert("Hi");
        self.location='edit-file.php?action=edit&id='+value;
    }
</script>
<script type="text/javascript">
    function delete_file(value)
    {
        //alert('Hi');
        self.location = 'edit-file.php?action=delete&id='+value;
    }
</script>
<?php

session_start();

if ($_SESSION['user_login'] != null) {
	
    echo "Your Listed Files are: <br/><br/>";	

	include_once('file.php');
	include_once('conn.php');
	
	// echo "In View ";
	$username = $_SESSION['user_login'];
	// echo "Username ".$username."<br>";
?>
	
<?php
	$file = new Fileclass();
	$user = new User();
	$result = $user->getuserid($username);
	$row = $user->fetch_object($result);
	$user_id = $row->user_pk;
	// echo "User ID :".$user_id."<br>";
	$result = $file->getuserfiles($user_id);
	if ($file->num_rows($result)>0) {
			
		
		while ($row = $user->fetch_object($result)) {
			$id = $row->file_pk;
			$file = $row->file_path.$row->file_name;
			$pos =strpos($file, '/');
			$filename = substr($file, $pos+1);
			// echo "$file $filename";
            //echo "$file";
?>
    <div style="float: left;">
        <div style="width:150px;">
            <div style="width: 100px;float:left;">
                <img src='<?php echo $file; ?>' height='100' width='100'/><br />
            </div>
            <div style="float:left;">
                <input type="button" name="Edit" value="Edit" onclick="edit('<?=$id?>');"/>
                <input type="button" name="Delete" value="Delete" onclick="delete_file('<?=$id?>');"/>
            </div>
        </div>
        
	   <div class="clear"></div>
		
		<?php //echo "<a href='edit-file.php?action=edit&id=$id'> Edit</a>";?>
		<?php //echo "<a href='edit-file.php?action=delete&id=$id'> Delete</a>";?>
<?php
		}
	} else {
		echo "No files found.";
	}

?>

<?php 
} ?>

<div class="clear"></div>
<br /><br />
<div style="float:left;">
    <input type="button" name="new_file" id="new_file" onclick="goto();" value="Add New File"/>
    <input type="button" name="back" id="back" onclick="goto();" value="Go Back"/>
</div>

</div>