
<script type="text/javascript">
function goback(id)
{
    self.location = 'viewpages.php?id='+id;
}
</script>

<?php
include_once("header.php");
include_once('includes/website.php');
include_once('includes/library.php');
session_start();
//print_r($_SESSION);
$websiteid=$_GET['id'];


if(isset($_GET['pageurlid']))
{
    
    $pageid=Mod_addslashes($_GET['pageurlid']);
    
    $viewpage=new Website();
    if(isset($_GET['pageurlid'])) {
        //echo "Hello";
    $res=$viewpage->fetchpage($websiteid,$pageid);
    $db=new DBConnection();
    $pagerow=$db->fetch_assoc($res);
                //print_r($pagerow);
                $pageid=$pagerow['page_id'];
                $pagename=$pagerow['page_name'];
                $pagecontent=$pagerow['page_content'];
               
            }
    
}   ?>
<!-- BEGIN: Page Content -->
    <title><?php echo $pagename;?></title>
    <h2>Page Name:<?php echo $pagename;?></h2>     
     <h3> <?php echo $pagecontent;?></h3> 
  <? //echo "$websiteid";?>
  
<input type="button" name="back" id="back" value="Go Back" onclick="goback('<?=$websiteid?>');"/>
<?php include_once("footer.php");?>
 
