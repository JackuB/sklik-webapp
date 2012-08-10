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


<!DOCTYPE html> 
<html> 
<head> 
  <title>Sklik Mobile</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
  <meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0-alpha.1/jquery.mobile-1.2.0-alpha.1.min.css" />
  <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/index.css" />
  
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
</head> 

<body> 
	<div data-role="content">	
	<div id="wrap">	
		<?php 
      if(isset($_GET["error"])) {
        if($_GET["error"] == "empty") { echo "<p>Musíte vyplnit jméno i heslo</p>"; } 
      }
    ?>
    <h1>Přihlášení</h1>
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
      <input type="password" name="password" id="password" value="" /><br />
      <input type="submit" value="Přihlásit" />
    </form>
    </div>	
		
	 </div>	

		
	</div><!-- /content -->


</body>
</html>