<?php
/* Hlavní volej() */
function volej($metoda,$dalsi = "") {
	$predat = array($_COOKIE["Session"]);
	if (isset($_SESSION['apiIP'])) {
		$apiUrl = "https://" . $_SESSION['apiIP'] . "/bajaja/RPC2";
	} else {
		$apiIP = gethostbyname('api.sklik.cz');
		$apiUrl = "https://" . $apiIP . "/bajaja/RPC2";
		$_SESSION['apiIP'] = $apiIP;
	}
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

	// ošetøení stavù
	$odpoved = xmlrpc_decode($file);
	if(!empty($odpoved)) {
		if($odpoved["status"] === 200) {
			return $odpoved;
		} else {
			echo "<h1>Server odpovìdìl chybovým kódem " . $odpoved["status"] . "</h1>";
			switch ($odpoved["status"]) {
			    case 500:
			        echo "Chyba serveru";
			        break;
			    case 400:
			        echo "Špatné parametry volání";
			        break;
			    case 401:
			        echo "Problém s vaší session. Zkuste se znovu pøihlásit.";
			        break;
			    case 404:
			        echo "Nenalezen server Skliku";
			        break;
			}
		}
	} else {
		die("Server vrátil prázdnou odpovìï (nebo odpovìï neodpovídá formátu XMLRPC). Zkuste to pozdìji.");
	}
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