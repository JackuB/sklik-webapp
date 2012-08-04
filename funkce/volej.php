<?php

function volej($metoda,$dalsi = "") {
  $predat = array($_COOKIE["Session"]);
  
  if($dalsi != "") {
    $predat = array_merge((array)$predat,(array)$dalsi);
  }
  
  
  $request = xmlrpc_encode_request($metoda, $predat);
  
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