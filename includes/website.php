<?php
/**
* This is Website class
*/
include_once('dbconnect.php');
class Website
{
	var $database = null;
	function __construct()
	{
		$this->database = new DBConnection();
	}

	public function createwebsite($user_id, $name)
	{
		$query ="INSERT INTO website (user_id, website_name) VALUES('$user_id','$name')";
		error_log($query);
		$result_set = $this->database->query($query);
		return $result_set;
	}

	public function getuserwebsites($user_id)
	{
		$query = "SELECT website_id, website_name, main_page FROM website WHERE user_id='$user_id'";
		error_log($query);
		$result_set = $this->database->query($query);
		return $result_set;
	}

	public function getmenupages($website_id)
	{
		$query = "SELECT page_id, page_name FROM page WHERE website_id='$website_id' AND menu='Yes' AND page_status='Active'";
		error_log($query);
		$result_set = $this->database->query($query);
		return $result_set;
	}
    
    public function setmenupages($website_id,$pagearray)
	{
		$query="UPDATE page SET menu='No' WHERE website_id='$website_id'";
		$result_set = $this->database->query($query);

		for ($i=0; $i < count($pagearray) ; $i++) {
			$query="UPDATE page SET menu='Yes' WHERE website_id='$website_id' AND page_id='".$pagearray[$i]."'";
			$result_set = $this->database->query($query);
		}
		return $result_set;
	}
    
    public function getpages($website_id)
	{
		$query = "SELECT page_id, page_name,menu FROM page WHERE website_id='$website_id' AND page_status='Active'";
		$result_set = $this->database->query($query);
		return $result_set;
	}
    
    public function getmpages($website_id)
	{
		$query = "SELECT page_id, page_name,menu FROM page WHERE website_id='$website_id' and menu='Yes' AND page_status='Active'";
		$result_set = $this->database->query($query);
		return $result_set;
	}
    
    public function setmainpage($page_id, $website_id)
    {
        $query = "update website set main_page = '$page_id' where website_id = $website_id";
        $result_set = $this->database->query($query);
        return $result_set;
    }
	   
    public function addpage($website_id,$page_name)
	{
		$query ="INSERT INTO page (website_id, page_name) VALUES";
		$i=0;
		foreach ($page_name as $key => $value) {
			$page = trim($value);
			$query .= "('$website_id','$page')";
			if ($i < count($page_name)-1 ) {
				$query .= ",";
			}
			$i++;
		}
		$result_set = $this->database->query($query);
		return $result_set;
	}
    
    public function addsubmenu($pageid,$submenupages,$presubmenu){
		$query =" UPDATE page SET menu='No',submenu='No',parent_id='0' WHERE parent_id='$pageid'";
		$result_set = $this->database->query($query);
		if($presubmenu!=''){
			foreach($presubmenu as $presubmenu){
				$query =" UPDATE page SET menu='No',submenu='Yes',parent_id='$pageid' WHERE page_id='$presubmenu'";
				$result_set = $this->database->query($query);
	    	}	
        }
        if($submenupages!=''){
        	foreach($submenupages as $submenu){
			$query =" UPDATE page SET menu='No',submenu='Yes',parent_id='$pageid' WHERE page_id='$submenu'";
			$result_set = $this->database->query($query);
    		}
        }	
		return $result_set;
	}  
    
    public function fetchsubmenuspages($websiteid,$pageid){
		
		$query = "SELECT  page_id,website_id,page_name,page_content,page_status,parent_id,menu,submenu 
		FROM page WHERE website_id = '$websiteid' AND parent_id='$pageid'";
		
		$result_set = $this->database->query($query);
		return $result_set;
	}
    
    public function editblankpages($websiteid,$pageid)	{
		$query = "SELECT page_id,website_id,page_name,page_content,page_status,parent_id,menu,submenu FROM page WHERE website_id = '$websiteid'
		AND menu='No' AND  parent_id='0' AND page_id !='$pageid' ";
		$result_set = $this->database->query($query);
		return $result_set;
	}
    
    function addpagecontent($pageid,$pagecontent,$pagemenu){
		$query =" UPDATE page SET page_content='$pagecontent',menu='$pagemenu' WHERE page_id ='$pageid'";
       // echo "query=".$query;
		$result_set = $this->database->query($query);
		return $result_set;
	}

	public function setseotags($website_id,$keywords,$sitetitle,$description)
	{
		$query ="INSERT INTO seo_settings (website_id, keyword, site_title, meta_description)values('$website_id', '$keywords', '$sitetitle', '$description')";
		error_log($query);
		$result_set = $this->database->query($query);
		return $result_set;
	}

	public function getseotags($website_id)
	{
		$query ="SELECT site_title ,keyword, meta_description FROM seo_settings WHERE website_id = '$website_id'";
		error_log($query);
		$result_set = $this->database->query($query);
		return $result_set;
	}
	public function updateseotags($website_id,$keywords,$sitetitle,$description)
	{
		$query ="UPDATE seo_settings set keyword = '$keywords',site_title = '$sitetitle', meta_description = '$description' WHERE website_id = '$website_id'";
		//echo "$query";
        error_log($query);
		$result_set = $this->database->query($query);
		return $result_set;
	}
	public function getwebsites($user_id)
	{
		error_log("User id:".$user_id);
		$query ="SELECT website_id , website_name FROM website WHERE user_id = '$user_id'";
		error_log($query);
		$result_set = $this->database->query($query);
		return $result_set;
	}

	
    
	function fetchewebsiteinfo($websiteid)
	{
		$query ="SELECT a.website_id, a.website_name, a.user_id, b.keyword,b.site_title, b.meta_description FROM website a LEFT OUTER JOIN seo_settings b ON a.website_id = b.website_id
WHERE a.website_id = '$websiteid' ";
		 //echo "query=".$query;
		 $result_set = $this->database->query($query);
		 return $result_set;
	}
    
    function fetchpage($websiteid,$pageid)
	{
		$query = "SELECT page_id,website_id,page_name,page_content,page_status,parent_id,menu,submenu FROM page WHERE website_id = '$websiteid' ";
		if($pageid>0){
		$query.= " AND page_id=$pageid";
	    }
	    //echo "query=".$query;
		$result_set = $this->database->query($query);
		return $result_set;

	}
    
    public function addPageMenu($websiteid,$menu)
    {	
    	$query =" UPDATE page SET menu='No' WHERE website_id ='$websiteid'";
		$result_set = $this->database->query($query);
		foreach($menu as $pageid)
		{
			$query =" UPDATE page SET menu='Yes' WHERE website_id ='$websiteid' AND page_id='$pageid'";
			$result_set = $this->database->query($query);
    	}
		return $result_set;
    	
    }

    function getwebsiteid($user_id, $website_name)
    {
        //$query = "select * from website";
        //$this->database->query($query);
        $sql = "select * from website where website_name = '$website_name' and user_id = '$user_id'";
        $result_set = $this->database->query($sql);
        return $result_set;      
    }
    public function fetchwebpages($websiteid)
	{
			 
		$query = "SELECT  page_id,website_id,page_name,page_content,page_status,parent_id,menu,submenu FROM page WHERE website_id = '$websiteid'
		AND (page_content='' OR page_content=NULL) ";
        //echo "$query";
		$result_set = $this->database->query($query);
		return $result_set;

	}
    
    function updatepage($pageid,$pagename,$pagecontent,$pagemenu,$pagestatus){
		$query =" UPDATE page SET page_name='$pagename',page_content='$pagecontent',menu='$pagemenu',page_status='$pagestatus' WHERE page_id ='$pageid'";
		$result_set = $this->database->query($query);
		//echo "in data base pagemenu==".$pagemenu;
		if($pagemenu == 'No'){ 
		 $query1 ="UPDATE page SET parent_id='0',menu='No',submenu='No' WHERE parent_id='$pageid'";
		 $result_set = $this->database->query($query1);
		}
		//echo "query==".$query1;
		return $result_set;
	}
    
    function deletepage($pageid){
		$query =" DELETE FROM page WHERE page_id='$pageid' ";
		$result_set = $this->database->query($query);
		//echo "query=".$query; die;
		return $result_set;
	}
    public function fetchblankpages($websiteid)
	{
		$query = "SELECT  page_id,website_id,page_name,page_content,page_status,parent_id,menu,submenu FROM page WHERE website_id = '$websiteid'
		AND menu='No' and submenu='No' ";
		$result_set = $this->database->query($query);
		return $result_set;
	}
	public function rowsaffected()
	{
		return $this->database->affected_rows();
	}

	public function num_rows($result_set)
	{
		return $this->database->num_rows($result_set);
	}

	public function fetch_object($result_set)
	{
		return $this->database->fetch_object($result_set);
	}
	public function fetch_array($result_set)
	{
		return $this->database->fetch_array($result_set);
	}

	public function fetch_assoc($result_set)
	{
		return $this->database->fetch_assoc($result_set);
	}
}
?>