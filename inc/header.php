<?php
/* u�ivatele bez cookie p�esm�rovat na login */
if(!isset($_COOKIE["Session"])) {
  header('Location: index.php');
  die;
}

include ('funkce/volej.php');

/* refresh cookie na dal��ch 13 dn� */
$refreshSession = volej("client.getAttributes");
setcookie ("Session", $refreshSession['session'], time() + 60*60*24*13);
?>
<!DOCTYPE html> 
<html> 
<head> 
	<title>Sklik Mobile</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head> 

<body>