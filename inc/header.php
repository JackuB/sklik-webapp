<?php
/* uživatele bez cookie přesměrovat na login */
if(!isset($_COOKIE["TestCookie"])) {
  header('Location: index.php');
  die;
}

function volej($metoda) {
  $request = xmlrpc_encode_request($metoda, array($_COOKIE["TestCookie"]));
  
  $context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",     
      'content' => $request
  )));
    
  $xmlOdpoved = file_get_contents("https://api.sklik.cz/RPC2", FILE_TEXT, $context);
  $odpoved = xmlrpc_decode($xmlOdpoved);
  
  return $odpoved;
}
?>
<!DOCTYPE html> 
<html> 
<head> 
	<title>Sklik Mobile</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head> 

<body>


<div data-role="header">
	<h1>Sklik webapp</h1>
	<a href="/sklik-webapp" data-icon="check" data-theme="b">Zpátky</a>
</div>