<?php session_start();
    include_once("header.php");
    include_once("includes/website.php");
   
    $websiteid=$_GET['id'];
    
?>
<script language="JavaScript">
function check()
{
    var a=new Array();
    a=document.getElementsByName("menu[]");
    var checkflag=0;
    for(i=0;i<a.length;i++){
        if(a[i].checked){
           // alert("cheked"+a[i].value);
            checkflag=1;
        }
    }
    if (checkflag==0){
        alert('Please select at least one menu');
        return false;
    }
            
    document.forms[0].submitted.value='yes';
    return true;
}
</script>
<form method="post" action='includes/setmenures.php'>
choose as menu page:<br/><br/>
<?php 
    $viewpage=new Website();
    $res=$viewpage->fetchpage($websiteid, $pageid=0);
    $db=new DBConnection();
     while($pagerow=$db->fetch_assoc($res)) {
                $pageid=$pagerow['page_id'];
                $pagename=$pagerow['page_name'];
                $dbmenu=$pagerow['menu'];
           if($dbmenu == 'Yes'){
                echo "<input type='checkbox' name='menu[]' value='$pageid' checked >$pagename <br>";
            } 
            else {
            echo "<input type='checkbox' name='menu[]' value='$pageid' >$pagename <br>";
            }   
        }
?>
<input type="submit" name='selectmenu' onclick='return check();'/>
</form>
</body>
<html>
