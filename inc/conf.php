 <?php 

   ob_start(); session_start();
 
 date_default_timezone_set('Europe/Istanbul');
 
	$mysqli = new mysqli("localhost", "maestro", "%F3Y4nihvkiqn8Ra", "maestro"); 
	$mysqli->query("SET NAMES 'utf8'  ");
	$mysqli->query("SET CHARACTER SET utf8");
	$mysqli->query("SET COLLATION_CONNECTION = 'utf8_general_ci' "); 
	
	function seocuk($seoID){ 
		
		global $mysqli;
		
		$idd		= (int)$seoID;
		$seobcc 	= $mysqli->query("select * from seo where id='$idd' ");
		$seobul		= $seobcc->fetch_array();
		$seo 		= $seobul['seo'];
		// $seo 			= "sanane";
				
		return $seo; 
		}
		
  
	require_once(dirname(__FILE__).'/security.php');
	$gelenurl = $_SERVER['REQUEST_URI'];
	 
	 function bosluksil($gelenurl){
	$url1 	= str_replace(" ","",$gelenurl);
  
	$enson = $url1;
	return $enson;
}