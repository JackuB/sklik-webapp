<?php include ('inc/header.php') ?>

<h1>Něco se nepovedlo</h1>

<?php

/*
TODO Check empty fields
if($_POST["name"] == "") {
    header('Location: index.php');
} */


$login = $_POST["name"];
$password = $_POST["password"];





$request = xmlrpc_encode_request("client.login", array($login,$password));


$context = stream_context_create(array('http' => array(
    'method' => "POST",
    'header' => "Content-Type: text/xml",
    'content' => $request
)));
$file = file_get_contents($apiUrl, false, $context);
$response = xmlrpc_decode($file);

if ($response["status"] == "200") {
 setcookie ("TestCookie", $response['session'], time() + 60); 
 header('Location: welcome.php');
} elseif($response["status"] == "401") {
 echo "<p>Špatná kombinace hesla a emailu</p>";
} elseif($response["status"] == "500") {
 echo "Chyba serveru";
} else {
 echo "jiná chyba";
}









?>



<?php include ('inc/footer.php') ?>