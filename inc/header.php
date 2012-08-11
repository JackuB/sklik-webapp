<?php
/* uživatele bez cookie přesměrovat na login */
if(isset($_COOKIE["Session"])) {} else {
  header('Location: index.php');
  die;
}

include ('inc/config.php');

include ('funkce/volej.php');

/* refresh cookie na dalších 13 dnů */
$refreshSession = volej("client.getAttributes");
setcookie ("Session", $refreshSession['session'], time() + 60*60*24*13);
?>
<!DOCTYPE html> 
<html> 
<head> 
	<title>Mobyklik</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
  <meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0-alpha.1/jquery.mobile-1.2.0-alpha.1.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script type="text/javascript">
$( document ).bind( 'mobileinit', function(){
  $.mobile.loader.prototype.options.text = "loading";
  $.mobile.loader.prototype.options.textVisible = true;
  $.mobile.loader.prototype.options.theme = "a";
  $.mobile.loader.prototype.options.html = '<div class="fixed"><div id="background"></div><div id="prvni"></div><div id="druhy"></div><img class="loadingLogo" src="img/sklik_logo_bile.png" /"></div>';
});
  </script>
	<script src="http://code.jquery.com/mobile/1.2.0-alpha.1/jquery.mobile-1.2.0-alpha.1.min.js"></script>

	
	
</head> 

<body>