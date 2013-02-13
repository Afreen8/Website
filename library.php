<?php 

 function Mod_addslashes($string) 
 {
 		
	 if (get_magic_quotes_gpc()==1) 
	{
	 return ($string);
	}
	 else 
	 { 
	 	return (addslashes($string));
	 } 
 }

 ?>