<?php 

session_start();

if ($_SESSION['user_login']!= "") {
?>
<html>
<head>
    <title>
    File Under Process
    </title>
    <script type="text/javascript" src="js/validation.js"></script>
    <script type="text/javascript">
        function view()
        {
            self.location = 'view-file.php';
        }
        function back()
        {
            self.location = 'create-website.php';
        }
    </script>
</head>
<body>
	<h1>File upload</h1>
	<hr/>
	<form name ='upload-file-form' method='POST' action='upload-file-processing.php' onsubmit="return validatefileupload();" enctype="multipart/form-data">
	Select Image/Video Files <input type = 'file' name= 'file'/> <br />
	<input type = 'submit' name ='btnupload' value ='Upload file' /> 
	<input type ='reset' name ='Clear'/>  
	
    </form>
    <input type="button" name="view" id="view" value="View Files" onclick="view();"/>
	<input type="button" name="back" id="back" value="Back" onclick="back();"/> 
</body>
</html>

<?php 

}
?>