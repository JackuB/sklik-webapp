<!DOCTYPE html> 
<html> 
<head> 
	<title>Chybová stránka</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head> 
<body> 
<h1>Něco se nepovedlo</h1>

<?php

$apiUrl = "https://api.sklik.cz/RPC2";

if(($_POST["name"] != "") or ($_POST["password"] != "")) {

  $params = array($_POST["name"],$_POST["password"]);
  
  $request = xmlrpc_encode_request("client.login", $params);
  $context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",
      'content' => $request
  )));
  $file = file_get_contents($apiUrl, false, $context);
  $response = xmlrpc_decode($file);
  
  /* sledujeme response status - potom rozhodneme co dál */
  if ($response["status"] == "200") {
    setcookie ("LoginName", $_POST["name"], time()+60*60*24*365*10); 
    setcookie ("Session", $response['session'], time() + 6000); 
    header('Location: welcome.php');
  } elseif($response["status"] == "401") {
    echo "<p>Špatná kombinace hesla a emailu</p>";
  } elseif($response["status"] == "500") {
    echo "<p>Chyba serveru</p>";
  } elseif($response["status"] == "") {
    echo "<p>Server vrátil prázdnou odezvu.</p>";
  } else {
    echo "<p>Jiná chyba</p>";
  }

} else { 
  /* při prázdném $_POST přesměrujeme na index */    
  header('Location: index.php?error=empty');
} 

?>

</body>
</html>