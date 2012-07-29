<?php include ('inc/header.php') ?>

<h1>Odeslaná data</h1>
<?php echo $_POST["name"]; ?><br />
<?php echo $_POST["password"]; ?>




<?php

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

if ($response && xmlrpc_is_fault($response)) {
    trigger_error("xmlrpc: $response[faultString] ($response[faultCode])");
} else {
   // print_r($response['session']);
   setcookie ("TestCookie", $response['session'], time() + 60); 
   
   
   
   /* $request = xmlrpc_encode_request("listCampaigns", array($response['session']));


    $context = stream_context_create(array('http' => array(
        'method' => "POST",
        'header' => "Content-Type: text/xml",
        'content' => $request
    )));
    
    $kampane = file_get_contents($apiUrl, false, $context);
    $kampaneDec = xmlrpc_decode($kampane);
    print_r($kampaneDec);  */
}





header('Location: welcome.php');


?>



<?php include ('inc/footer.php') ?>