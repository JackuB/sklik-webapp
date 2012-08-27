<?php 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"iphone") or strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"ipad")) {
    header('Location: app/');
}else{ ?>
<!DOCTYPE html> 
<html> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
  <title>Mobyklik - rozhran� pro Sklik.cz</title> 
  <meta name="keywords" content="sklik,iphone,ios,ipad,mobiln� aplikace,mobiln� reklamy,seznam,seznam.cz,mobiln� sklik">
  <link rel="stylesheet" href="css/style.css" />
  <?php include ('google.inc'); ?>    
</head> 

<body> 

<div id="pruh">
  <img src="img/logo.jpg" alt="Mobyklik - mobiln� rozhran� pro Sklik.cz" />
</div>

	<div id="wrap">
         <img src="img/mobyklik.jpg" alt="mobyklik - sklik.cz pro iPhone, Android, iPad" />
         
         

      <h2>Mobyklik je <s style="color:#ccc">mobiln�</s> rozhran� pro <a href="http://sklik.cz">Sklik.cz</a></h2>
      
      <p>Vytv��� ho <a href="http://jakub.jedenbod.cz/">Jakub Mikul�</a> jako <a href="https://github.com/JackuB/sklik-webapp">open-source</a>. Vyu��v� <a href="http://api.sklik.cz/">Sklik API</a>.</p>
      
      <p>Hlavn�m c�lem je p�in�st p��jemn� rozhran�</p>
      
      <a href="app/" class="button">
        Spustit Mobyklik              
      </a><small style="margin-bottom:35px;display:block;">Nebo nav�tivte tento web na sv�m telefonu</small>
      
      <h2>Co funguje?</h2>
      <ul>
        <li>V�pis kampan�, reklam a kl��ov�ch slov</li>
        <li><strong>P��stup p�es telefony</strong> <em>(iPhone, Android)</em>, <strong>tablety</strong> <em>(iPad, Android)</em> a <strong>desktopy</strong> <em>(Win, OS X i Linux)</em></strong></li>
        <li>Po��t�n� CTR, CPC</li>
        <li><strong>Grafy v Skliku</strong></li>
        <li>Detekce aktivn�ch a neaktivn�ch kampan�</li> 
      </ul>
        
      <h2>Co je v pl�nu?</h2>
      
      <ul>
        <li>Urychlen� (p�es <em>system.multicall</em>)</li>
        <li>�azen� a filtrov�n� dat</li>
        <li>Editace dat</li>
        <li>Vkl�d�n� dat</li>      
        <li>U�ivatelsk� nastaven�</li>
        <li>Automatick� tvorba p�ehled�</li>
        <li>Sledov�n� v�konnosti reklam</li>
        <li>Desktopov� app</li>
        <li>...</li>  
      </ul>
		
	 </div>	

		

</body>
</html>

<?php 
  }
?>