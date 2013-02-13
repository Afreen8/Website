<?php
include_once("header.php");
include_once('includes/website.php');
include_once('includes/library.php');
session_start();

$websiteid = $_GET['id'];
//echo $_GET['pageurlid'];
if(isset($_GET['pageurlid']))
{
    $pageid=Mod_addslashes($_GET['pageurlid']);
    
    $delpage=new Website();
    if(isset($_GET['pageurlid'])) {
    $res=$delpage->deletepage($pageid);

    $db=new DBConnection();
    $pagerow=$db->affected_rows();
    if($res>0){
                echo "<script>alert('page info is deleted successfuly.')</script>";
                echo "<script>window.location='viewpages.php?id=$websiteid'</script>";
            }   
            else{
                echo "<script>alert('page info not deleted.');<script>";
                echo "<script>window.location='viewpages.php'</script>";
            }       
               
    }
    
}  

include_once("header.php");
?> 
 
