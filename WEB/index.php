<?php 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"iphone")) {
    header('Location: app/');
}else{ ?>
<!DOCTYPE html> 
<html> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
  <title>Mobyklik - mobiln� rozhran� pro Sklik.cz</title> 
  <meta name="keywords" content="sklik,iphone,ios,ipad,mobiln� aplikace,mobiln� reklamy,seznam,seznam.cz,mobiln� sklik">
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/index.css" />
  <?php include ('google.inc'); ?>    
</head> 

<body> 
	<div data-role="content">	
	<div id="wrap">
  
    <div class="fialova">
      <h2>Mobyklik je mobiln� rozhran� pro <a href="http://sklik.cz">Sklik.cz</a></h2>
      
      <p>Vytv��� ho <a href="http://jakub.jedenbod.cz/">Jakub Mikul�</a> jako <a href="https://github.com/JackuB/sklik-webapp">open-source</a></p>
      
      <p>Vyu��v� <a href="http://api.sklik.cz/">Sklik API</a></p>
      
      <p>Hlavn�m c�lem je p�in�st p��jemn� rozhran�</p>
      
      <p>Prozat�m podporuje jen iOS, ale m��ete mi <a href="http://jakub.jedenbod.cz/">napsat</a>, Android mus�m nejd��ve otestovat.</p>
        
      <h2>Co je v pl�nu?</h2>
      
      <ul>
        <li>V�pis reklam</li>
        <li>Podpora Androidu</li>
        <li>Podpora Windows Phone 7</li>
        <li>Urychlen� p�es <em>system.multicall</em></li>
        <li>Editace dat</li>
        <li>Vkl�d�n� dat</li>      
        <li>U�ivatelsk� nastaven�</li>
        <li>Verze pro desktopov� prohl�e�e</li>
        <li>Desktopov� app</li>
        <li>...</li>  
      </ul>
    </div>
    
    <div class="screenshot">
      <img src="img/mobyklik.jpg" alt="Mobiln� aplikace pro Sklik.cz" />
    </div>
		
	 </div>	

		
	</div><!-- /content -->


</body>
</html>

<?php 
  }
?>