<?php
if(isset($_COOKIE["Session"])) {
  include ('funkce/volej.php');
  /* je uživatelův cookie stále platný? */
  $sessionOk = volej("client.getAttributes");  
  if($sessionOk["status"] == "200") {
    header('Location: welcome.php');
  }
}
?>
<?php include ('inc/config.php') ?>
<!DOCTYPE html> 
<html> 
<head> 
  <title>Mobyklik</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />


    <!-- mobilní meta tagy -->
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />  
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        
    <link rel="apple-touch-icon-precomposed" href="img/webapp/apple-touch-icon-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/webapp/apple-touch-icon-precomposed-iphone4.png" />

    <link rel="apple-touch-startup-image" media="(max-device-width: 480px) and not (-webkit-min-device-pixel-ratio: 2)" href="img/webapp/loading-small.png" />
    <link rel="apple-touch-startup-image" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" href="img/webapp/loading.png" />    
    
    <!-- /mobilní meta tagy -->
  
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script type="text/javascript">
    $( document ).bind( 'mobileinit', function(){
      $.mobile.loader.prototype.options.text = "loading";
      $.mobile.loader.prototype.options.textVisible = true;
      $.mobile.loader.prototype.options.theme = "a";
      $.mobile.loader.prototype.options.html = '<div class="fixed"><div id="background"></div><div id="prvni"></div><div id="druhy"></div><img class="loadingLogo" src="img/sklik_logo_bile.png" /"></div>';
    });
  </script>
	<script src="http://code.jquery.com/mobile/1.2.0-alpha.1/jquery.mobile-1.2.0-alpha.1.min.js"></script>
  <script src="js/add2home.js"></script>
  
  
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0-alpha.1/jquery.mobile-1.2.0-alpha.1.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/index.css" />    
</head> 

<body> 
	<div data-role="content">	
	<div id="wrap">
  
  <?
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"iphone")) {
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
    <form data-ajax="false" action="setcookie.php" method="post">
      <label for="name">Přihlašovací jméno:</label>
      <input type="text" name="name" id="name" value="<?php 
        if(isset($_COOKIE["LoginName"])) {
          echo $_COOKIE["LoginName"]; /* Zavolá poslední login */
        } ?>"  />
      <br />
      <label for="password">Heslo:</label>
      <input type="password" name="password" id="password" value="" /><br /><br />
      <input type="submit" value="Přihlásit" />
    </form>
    </div>	
    
<?php    
      }
}else{
   echo('<br /><h3>Je mi líto, ale iOS je zatím jediná otestovaná platforma. Co je v plánu? Sledujte <a style="color:white;font-weight:700" href="'.$CwebUrl.'">web Mobykliku</a>.</h3>');
}
?>
    
    
		
	 </div>	

		
	</div><!-- /content -->


</body>
</html>