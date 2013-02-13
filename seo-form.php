<?
session_start();
//print_r($_SESSION);
include('includes/website.php');
include('includes/user.php');
//$website_id = $_GET['id'];
$website_id = $_GET['id'];
//echo "$website_id";
?>
<html>
    <head>
        <title>
            SEO Settings Form
        </title>
        <script type="text/javascript" src="js/validation.js"></script>
    </head>
    <body>
        <form method="post" name="seo-form" id="seo-form" onsubmit="return validate_seo_form()" action="includes/seo-tags-processing.php?id=<?=$website_id?>">
            <table>
<br />
                <tr>
                    <th colspan="2">
                        Seo Settings
                    </th>
                </tr>
                <tr>
                    <td>Enter Site Title</td>
                    <td><input type="text" name="site_title" id="site_title" /></td>
                </tr>
                <tr>
                    <td>Enter Keywords</td>
                    <td><textarea name="keywords" id="keywords" cols="20" rows="5"></textarea></td>
                </tr>
                <tr>
                    <td>Ente Meta Description</td>
                    <td><textarea name="meta_desc" id="meta_desc" cols="20" rows="5"></textarea></td>
                </tr> 
                <tr>
                    <td colspan="2"><input type="submit" name="btnsubmit" id="btnsubmit" value="Submit"/>
                    <input type="reset" name="reset" id="reset" value="Clear"/></td>
                </tr>
                
            </table>            
        </form>
    </body>
</html>