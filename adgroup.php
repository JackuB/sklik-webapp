<?php include ('inc/header.php') ?>
<a href="welcome.php"><img src="img/back.png" /></a>
<img id="logout" src="img/logout.png" />
<div id="header">
  
    
  
</div>
<div class="grafProkliku">
<?php
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
echo '
<div class="wrapSloupce" style="left:'.$left.'%;width:'.$leftProcento.'%;height:'.$hodnota.'%">
<div title="'.$den.'" class="sloupecGrafu"></div>
</div>';
$n++;
}

?>
</div>





<?php
  $groups = volej("listGroups",intval($_GET["id"]));
  // print_r($groups);
    
    foreach ($groups["groups"] as $group) {   
      $id = $group["id"];
      $vytvoreniGroup = $group["createDate"];
      $nazevGroup = iconv("UTF-8", "WINDOWS-1250//TRANSLIT", $group["name"]); /* v�n� se group vrac� v UTF8?! */    
      
      /* dne�n� datum jako objekt */     
      $datumDo = new stdClass;
      $datumDo->scalar = date("c");
      $datumDo->xmlrpc_type = "datetime";
      $datumDo->timestamp = time();

      $statistikyArray = array($id,$vytvoreniGroup,$datumDo);
      $statistiky = volej("group.stats",$statistikyArray);
      // print_r($statistiky);
      
      
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
          <h2>'.$nazevGroup.'</h2>
          <div class="kampanData">
          
            <div class="jednaTri">
              Prokliky
              <strong>'.$statistiky["stats"]["clicks"].'</strong>
            </div>
            
            <div class="jednaTri">
              Zobrazen�
              <strong>'.number_format($statistiky["stats"]["impressions"],0,","," ").'</strong>
            </div>
            
            <div class="jednaTri">
              CTR
              <strong>'.number_format($ctr,2,","," ").'</strong>
            </div>
                      
           
            <div class="jednaTri">
              Pr�m�rn� pozice
              <strong>'.$prumernaPozice.'</strong>
            </div>
            
            <div class="jednaTri">
              Pr�m�rn� CPC
              <strong>'.number_format($cpc,2,","," ").'</strong>
            </div>
            
            <div class="jednaTri">
              Cena
              <strong>'.number_format($cena,2,","," ").'</strong>
            </div>                    
          
            <br class="clear" />
          
          </div>
          </div>
        </div>';                         
      
    };       
?>             

<?php include ('inc/footer.php') ?>