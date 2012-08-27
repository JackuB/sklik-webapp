<?php


/* Hlavn� volej() */
function volej($metoda,$dalsi = "") {
$predat = array($_COOKIE["Session"]);
$apiUrl = "https://77.75.77.28/RPC2"; /* nebudeme ztr�cet �as s DNS */
  if($dalsi != "") {
    $predat = array_merge((array)$predat,(array)$dalsi);
  }

$request = xmlrpc_encode_request($metoda, $predat);
$req = curl_init($apiUrl);

// Nastaven� hlavi�ek
$headers = array();
array_push($headers,"Content-Type: text/xml");
array_push($headers,"\r\n");

// �daje o p�ipojen�
curl_setopt($req, CURLOPT_URL, $apiUrl);

// curl nastaven�
curl_setopt($req, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($req, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt( $req, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt($req, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($req, CURLOPT_HTTPHEADER, $headers );
curl_setopt( $req, CURLOPT_POSTFIELDS, $request );

// p�ipojen�
$file = curl_exec($req);

curl_close($req);

$odpoved = xmlrpc_decode($file);

return $odpoved;
}




/* pro multicall */
function multivolej($metoda,$dalsi = "") {
$predat = array($_COOKIE["Session"]);
$apiUrl = "https://77.75.77.28/RPC2"; /* nebudeme ztr�cet �as s DNS */
$request = xmlrpc_encode_request($metoda, $dalsi);
$req = curl_init($apiUrl);

// Nastaven� hlavi�ek
$headers = array();
array_push($headers,"Content-Type: text/xml");
array_push($headers,"\r\n");

// �daje o p�ipojen�
curl_setopt($req, CURLOPT_URL, $apiUrl);

// curl nastaven�
curl_setopt($req, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($req, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt( $req, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt($req, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($req, CURLOPT_HTTPHEADER, $headers );
curl_setopt( $req, CURLOPT_POSTFIELDS, $request );

// p�ipojen�
$file = curl_exec($req);

curl_close($req);

$odpoved = xmlrpc_decode($file);

return $odpoved;
}

function prekoduj($co) {

  if(mb_detect_encoding($co, 'UTF-8', true) == "UTF-8") { /* OB�AS se n�co vrac� jako UTF-8 - ale zbytek obsahu je windows-1250 - WTF */
    $vysledek = iconv("UTF-8", "WINDOWS-1250//TRANSLIT", $co);     
  } else {
    $vysledek = $co;
  }   
  return $vysledek;

}
?>