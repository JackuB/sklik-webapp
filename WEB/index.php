<?php 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"iphone")) {
    header('Location: app/');
}else{ ?>
<!DOCTYPE html> 
<html> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
  <title>Mobyklik - mobilní rozhraní pro Sklik.cz</title> 
  <meta name="keywords" content="sklik,iphone,ios,ipad,mobilní aplikace,mobilní reklamy,seznam,seznam.cz,mobilní sklik">
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/index.css" />
  <?php include ('google.inc'); ?>    
</head> 

<body> 
	<div data-role="content">	
	<div id="wrap">
  
    <div class="fialova">
      <h2>Mobyklik je mobilní rozhraní pro <a href="http://sklik.cz">Sklik.cz</a></h2>
      
      <p>Vytváří ho <a href="http://jakub.jedenbod.cz/">Jakub Mikuláš</a> jako <a href="https://github.com/JackuB/sklik-webapp">open-source</a></p>
      
      <p>Využívá <a href="http://api.sklik.cz/">Sklik API</a></p>
      
      <p>Hlavním cílem je přinést příjemné rozhraní</p>
      
      <p>Prozatím podporuje jen iOS, ale můžete mi <a href="http://jakub.jedenbod.cz/">napsat</a>, Android musím nejdříve otestovat.</p>
        
      <h2>Co je v plánu?</h2>
      
      <ul>
        <li>Výpis reklam</li>
        <li>Podpora Androidu</li>
        <li>Podpora Windows Phone 7</li>
        <li>Urychlení přes <em>system.multicall</em></li>
        <li>Editace dat</li>
        <li>Vkládání dat</li>      
        <li>Uživatelská nastavení</li>
        <li>Verze pro desktopové prohlížeče</li>
        <li>Desktopová app</li>
        <li>...</li>  
      </ul>
    </div>
    
    <div class="screenshot">
      <img src="img/mobyklik.jpg" alt="Mobilní aplikace pro Sklik.cz" />
    </div>
		
	 </div>	

		
	</div><!-- /content -->


</body>
</html>

<?php 
  }
?>