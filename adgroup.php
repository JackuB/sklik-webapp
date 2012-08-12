<?php include ('inc/header.php') ?>
<a href="welcome.php"><img src="img/back.png" /></a>
<a href="logout.php" rel="external"><img id="logout" src="img/logout.png" /></a>
<div id="header">
  
<?php
 $nazevKamapane = volej("campaign.getAttributes",intval($_GET["id"]));
 echo "<h2>".$nazevKamapane["campaign"]["name"]."</h2>";
?>    
  
</div>

<h3 class="desetleva magenta">Prokliky za posledních 7 dnù</h3>
<div class="grafProkliku">
<?php
/* VYKRESLENÍ GRAFU */

$i = 0;
$grafProkliku = array();
do {
  $i++;
  $datum = time() - $i*3600*24;
  $c = $i-1;
  $datumDalsiDen = time() - $c*3600*24;

    $datumOd = new stdClass;
    $datumOd->scalar = date('c', $datum);
    $datumOd->xmlrpc_type = "datetime";
    $datumOd->timestamp = $datum;
    
    $datumDo = new stdClass;
    $datumDo->scalar = date('c', $datumDalsiDen);
    $datumDo->xmlrpc_type = "datetime";
    $datumDo->timestamp = $datumDo;  
    
$proklikyArray = array(intval($_GET["id"]),$datumOd,$datumDo);  
$proklikyGraf = volej("campaign.stats",$proklikyArray);

array_push($grafProkliku, $proklikyGraf["stats"]["clicks"]);
  
} while ($i < 7);

$grafProklikuMax = max($grafProkliku);

$n = 0;
$grafProklikuPozpatku = array_reverse($grafProkliku);

foreach ($grafProklikuPozpatku as $den) {
$leftProcento = 100/count($grafProkliku);
$left = $n*$leftProcento;
if ($den != 0) {
$hodnota = $den/$grafProklikuMax*100;
} else {
$hodnota = 5; }
if ($hodnota < 10) {
  echo '
  <div class="wrapSloupce" style="left:'.$left.'%;width:'.$leftProcento.'%;height:'.$hodnota.'%">
  <div title="'.$den.'" class="sloupecGrafu"></div>
  </div>';
} else {
  echo '
  <div class="wrapSloupce" style="left:'.$left.'%;width:'.$leftProcento.'%;height:'.$hodnota.'%">
  <div title="'.$den.'" class="sloupecGrafu">'.$den.'</div>
  </div>';
}
$n++;
}       
/* KONEC VYKRESLENÍ GRAFU */
?>
</div>





<?php
/* TODO multicall 
    $paramArray = array(
          array(
             array(
                   'methodName'   => 'listGroups',
                   'params'      => array($_COOKIE["Session"],intval($_GET["id"]))
                ),
              array(
                   'methodName'   => 'listGroups',
                   'params'      => array($_COOKIE["Session"],intval($_GET["id"]))
                )
          )
       );

$multipass = multivolej("system.multicall",$paramArray);
print_r($multipass);
*/
?>


<?php
  /* VÝPIS */
  $groups = volej("listGroups",intval($_GET["id"]));
  
    foreach ($groups["groups"] as $group) { 
            
      $id = $group["id"];
      $vytvoreniGroup = $group["createDate"];
      if(mb_detect_encoding($group["name"], 'UTF-8', true) == "UTF-8") { /* OBÈAS se group vrací jako UTF-8 - ale zbytek stránky je windows-1250 - WTF */
        $nazevGroup = iconv("UTF-8", "WINDOWS-1250//TRANSLIT", $group["name"]);     
      } else {
        $nazevGroup = $group["name"];
      }

      /* dnešní datum jako objekt */     
      $datumDo = new stdClass;
      $datumDo->scalar = date("c");
      $datumDo->xmlrpc_type = "datetime";
      $datumDo->timestamp = time();
            
      $statistikyArray = array($id,$vytvoreniGroup,$datumDo);
      $statistiky = volej("group.stats",$statistikyArray);
    
      if($statistiky["stats"]["clicks"] == "0") { 
        $ctr = "0"; $cpc = "0"; 
      } else {      
        $ctr = $statistiky["stats"]["clicks"]/$statistiky["stats"]["impressions"]*100;  
        $cpc = $statistiky["stats"]["money"]/$statistiky["stats"]["clicks"]/100; 
      }
      
      $cena = $statistiky["stats"]["money"]/100;                                            
      $prumernaPozice = $statistiky["stats"]["avgPosition"];
      $status = $group["status"];

      echo      
        '<div class="kampan '.$status.'">
          <div class="inside">
          <h3>'.$nazevGroup.'</h3>
          <div class="kampanData">
          
            <div class="jednaTri">
              Prokliky
              <strong>'.$statistiky["stats"]["clicks"].'</strong>
            </div>
            
            <div class="jednaTri">
              Zobrazení
              <strong>'.number_format($statistiky["stats"]["impressions"],0,","," ").'</strong>
            </div>
            
            <div class="jednaTri">
              CTR
              <strong>'.number_format($ctr,2,","," ").'</strong>
            </div>
                      
           
            <div class="jednaTri">
              Prùmìrná pozice
              <strong>'.$prumernaPozice.'</strong>
            </div>
            
            <div class="jednaTri">
              Prùmìrná CPC
              <strong>'.number_format($cpc,2,","," ").'</strong>
            </div>
            
            <div class="jednaTri">
              Cena
              <strong>'.number_format($cena,2,","," ").'</strong>
            </div>                    
          
            <br class="clear" />
          
          </div>
          </div>
          <a class="kampanLink" href="keyword.php?id='.$id.'&back='.$_GET["id"].'"><span></span></a>
        </div>';                         

    };    

?>             

<script>
$(document).delegate('.ui-page', 'pageshow', function () {
    $(".grafProkliku").fadeIn("slow");
});
</script>

<?php include ('inc/footer.php') ?>