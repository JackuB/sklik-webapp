<?php include ('inc/header.php') ?>

<h1>Nastavený cookie</h1>
<?php 
echo $_COOKIE["TestCookie"];
$currentSession = $_COOKIE["TestCookie"];

   $request = xmlrpc_encode_request("listCampaigns", array($currentSession));


    $context = stream_context_create(array('http' => array(
        'method' => "POST",
        'header' => "Content-Type: text/xml",
        'content' => $request
    )));
    
    $kampane = file_get_contents($apiUrl, false, $context);
    $kampaneDec = xmlrpc_decode($kampane);
    echo "<h1>Výpis kampaní</h1>";
    print_r($kampaneDec);  

 ?>

<?php include ('inc/footer.php') ?>