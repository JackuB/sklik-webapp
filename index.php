


<?php include ('inc/config.php') ?>
<!DOCTYPE html> 
<html> 
<head> 
  <title>Mobyklik</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<?php
if(isset($_COOKIE["Session"])) {
  include ('funkce/volej.php');
  /* je uživatelův cookie stále platný? */
  $sessionOk = volej("client.getAttributes");  
  if($sessionOk["status"] == "200") { ?>
    <script type="text/javascript">
    <!--
    window.location = "welcome.php"
    //-->
    </script>
<?php
  }
}
?>
  <!-- mobilní meta tagy -->
  	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />  
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        
    <link rel="apple-touch-icon-precomposed" href="img/webapp/apple-touch-icon-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/webapp/apple-touch-icon-precomposed-iphone4.png" />
  
    <link rel="apple-touch-startup-image" media="(max-device-width: 480px) and not (-webkit-min-device-pixel-ratio: 2)" href="img/webapp/loading-small.png" />
    <link rel="apple-touch-startup-image" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" href="img/webapp/loading.png" />        
  <!-- /mobilní meta tagy -->
  
  <script src="js/jquery.js"></script>  

  <script src="js/add2home.js"></script>
  
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/index.css" />
  <?php include ('inc/google.inc'); ?>    
</head> 

<body> 
	<div data-role="content">	
	<div id="wrap">
  
<?php
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"iphone") or strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"ipad")) {
   if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"safari")) {
      echo('<br /><h3>Mobyklik si musíte nejdříve nainstalovat.</h3>');
   }else{ ?>

	
		<?php 
      if(isset($_GET["error"])) {
        if($_GET["error"] == "empty") { echo "<p>Musíte vyplnit jméno i heslo</p>"; } 
      }
    ?>
		<!-- form -->
		<div data-role="fieldcontain">
    Použijte přihlašovací údaje jako do Sklik.cz<br /><br />    
    <form data-ajax="false" action="setcookie.php" method="post">
      <label for="name">Přihlašovací jméno:</label>
      <input type="text" name="name" id="name" value="<?php 
        if(isset($_COOKIE["LoginName"])) {
          echo $_COOKIE["LoginName"]; /* Zavolá poslední login */
        } ?>"  />
      <br />
      <label for="password">Heslo:</label>
      <input type="password" name="password" id="password" value="" /><br /><br />
      <input id="login" type="submit" value="Přihlásit" />
    </form>
    </div>	
    
<?php    
      }
}else{
?>

	
		<?php 
      if(isset($_GET["error"])) {
        if($_GET["error"] == "empty") { echo "<p>Musíte vyplnit jméno i heslo</p>"; } 
      }
    ?>
		<!-- form -->
		<div data-role="fieldcontain">
    Použijte přihlašovací údaje jako do Sklik.cz<br /><br />
    <form data-ajax="false" action="setcookie.php" method="post">
      <label for="name">Přihlašovací jméno:</label>
      <input type="text" name="name" id="name" value="<?php 
        if(isset($_COOKIE["LoginName"])) {
          echo $_COOKIE["LoginName"]; /* Zavolá poslední login */
        } ?>"  />
      <br />
      <label for="password">Heslo:</label>
      <input type="password" name="password" id="password" value="" /><br /><br />
      <input id="login" type="submit" value="Přihlásit" />
    </form>
    </div>	
    
<?php
}
?>		
	 </div>	
	</div><!-- /content --> 
</body>
</html>