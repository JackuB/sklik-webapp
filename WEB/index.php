<?php 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"iphone") or strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"ipad")) {
    header('Location: app/');
}else{ ?>
<!DOCTYPE html> 
<html> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
  <title>Mobyklik - rozhraní pro Sklik.cz</title> 
  <meta name="keywords" content="sklik,iphone,ios,ipad,mobilní aplikace,mobilní reklamy,seznam,seznam.cz,mobilní sklik">
  <link rel="stylesheet" href="css/style.css" />
  <?php include ('google.inc'); ?>    
</head> 

<body> 

<div id="pruh">
  <img src="img/logo.jpg" alt="Mobyklik - mobilní rozhraní pro Sklik.cz" />
</div>

	<div id="wrap">
         <img src="img/mobyklik.jpg" alt="mobyklik - sklik.cz pro iPhone, Android, iPad" />
         
         

      <h2>Mobyklik je <s style="color:#ccc">mobilní</s> rozhraní pro <a href="http://sklik.cz">Sklik.cz</a></h2>
      
      <p>Vytváří ho <a href="http://jakub.jedenbod.cz/">Jakub Mikuláš</a> jako <a href="https://github.com/JackuB/sklik-webapp">open-source</a>. Využívá <a href="http://api.sklik.cz/">Sklik API</a>.</p>
      
      <p>Hlavním cílem je přinést příjemné rozhraní</p>
      
      <a href="app/" class="button">
        Spustit Mobyklik              
      </a><small style="margin-bottom:35px;display:block;">Nebo navštivte tento web na svém telefonu</small>
      
      <h2>Co funguje?</h2>
      <ul>
        <li>Výpis kampaní, reklam a klíčových slov</li>
        <li><strong>Přístup přes telefony</strong> <em>(iPhone, Android)</em>, <strong>tablety</strong> <em>(iPad, Android)</em> a <strong>desktopy</strong> <em>(Win, OS X i Linux)</em></strong></li>
        <li>Počítání CTR, CPC</li>
        <li><strong>Grafy v Skliku</strong></li>
        <li>Detekce aktivních a neaktivních kampaní</li> 
      </ul>
        
      <h2>Co je v plánu?</h2>
      
      <ul>
        <li>Urychlení (přes <em>system.multicall</em>)</li>
        <li>Řazení a filtrování dat</li>
        <li>Editace dat</li>
        <li>Vkládání dat</li>      
        <li>Uživatelská nastavení</li>
        <li>Automatická tvorba přehledů</li>
        <li>Sledování výkonnosti reklam</li>
        <li>Desktopová app</li>
        <li>...</li>  
      </ul>
		
	 </div>	

		

</body>
</html>

<?php 
  }
?>