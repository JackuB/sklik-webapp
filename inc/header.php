<?php
/* uživatele bez cookie přesměrovat na login */
if(isset($_COOKIE["Session"])) {} else {
  header('Location: index.php');
  die;
}
header('Content-Type: text/html; charset=windows-1250');

include ('inc/config.php');

include ('funkce/volej.php');

/* refresh cookie na dalších 13 dnů */
$refreshSession = volej("client.getAttributes");
setcookie ("Session", 
$refreshSession['session'],
time() + 60*60*24*13);
?>
<!DOCTYPE html> 
<html> 
<head> 
	<title>Mobyklik</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <link rel="stylesheet" href="css/style.css" />
  
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

  <script src="js/jquery.js"></script>
  <script src="js/scripts.js"></script>
 
  <?php include ('inc/google.inc'); ?>
</head> 

<body>
<div data-dom-cache="true" data-role="page" id="wrap"><!-- it's a wrap! -->