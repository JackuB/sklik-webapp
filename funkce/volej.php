<?php
/* Hlavn� volej() */
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

	// o�et�en� stav�
	$odpoved = xmlrpc_decode($file);
	if(!empty($odpoved)) {
		if($odpoved["status"] === 200) {
			return $odpoved;
		} else {
			echo "<h1>Server odpov�d�l chybov�m k�dem " . $odpoved["status"] . "</h1>";
			switch ($odpoved["status"]) {
			    case 500:
			        echo "Chyba serveru";
			        break;
			    case 400:
			        echo "�patn� parametry vol�n�";
			        break;
			    case 401:
			        echo "Probl�m s va�� session. Zkuste se znovu p�ihl�sit.";
			        break;
			    case 404:
			        echo "Nenalezen server Skliku";
			        break;
			}
		}
	} else {
		die("Server vr�til pr�zdnou odpov�� (nebo odpov�� neodpov�d� form�tu XMLRPC). Zkuste to pozd�ji.");
	}
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