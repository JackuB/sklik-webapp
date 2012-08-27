<?php


/* Hlavní volej() */
function volej($metoda,$dalsi = "") {
$predat = array($_COOKIE["Session"]);
$apiUrl = "https://77.75.77.28/RPC2"; /* nebudeme ztrácet èas s DNS */
  if($dalsi != "") {
    $predat = array_merge((array)$predat,(array)$dalsi);
  }

$request = xmlrpc_encode_request($metoda, $predat);
$req = curl_init($apiUrl);

// Nastavení hlavièek
$headers = array();
array_push($headers,"Content-Type: text/xml");
array_push($headers,"\r\n");

// údaje o pøipojení
curl_setopt($req, CURLOPT_URL, $apiUrl);

// curl nastavení
curl_setopt($req, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($req, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt( $req, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt($req, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($req, CURLOPT_HTTPHEADER, $headers );
curl_setopt( $req, CURLOPT_POSTFIELDS, $request );

// pøipojení
$file = curl_exec($req);

curl_close($req);

$odpoved = xmlrpc_decode($file);

return $odpoved;
}




/* pro multicall */
function multivolej($metoda,$dalsi = "") {
$predat = array($_COOKIE["Session"]);
$apiUrl = "https://77.75.77.28/RPC2"; /* nebudeme ztrácet èas s DNS */
$request = xmlrpc_encode_request($metoda, $dalsi);
$req = curl_init($apiUrl);

// Nastavení hlavièek
$headers = array();
array_push($headers,"Content-Type: text/xml");
array_push($headers,"\r\n");

// údaje o pøipojení
curl_setopt($req, CURLOPT_URL, $apiUrl);

// curl nastavení
curl_setopt($req, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($req, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt( $req, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt($req, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($req, CURLOPT_HTTPHEADER, $headers );
curl_setopt( $req, CURLOPT_POSTFIELDS, $request );

// pøipojení
$file = curl_exec($req);

curl_close($req);

$odpoved = xmlrpc_decode($file);

return $odpoved;
}

function prekoduj($co) {

  if(mb_detect_encoding($co, 'UTF-8', true) == "UTF-8") { /* OBÈAS se nìco vrací jako UTF-8 - ale zbytek obsahu je windows-1250 - WTF */
    $vysledek = iconv("UTF-8", "WINDOWS-1250//TRANSLIT", $co);     
  } else {
    $vysledek = $co;
  }   
  return $vysledek;

}
?>