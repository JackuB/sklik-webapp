<?php include ('inc/header.php') ?>
<a href="adgroup.php?id=<?php echo $_GET["back"];?>"><img src="img/back.png" /></a>
<a href="logout.php" rel="external"><img id="logout" src="img/logout.png" /></a>
<div id="header">
  
<?php
 $nazevKamapane = volej("campaign.getAttributes",intval($_GET["back"]));
 echo '<h2><a href="adgroup.php?id='.$_GET["back"].'">'.$nazevKamapane["campaign"]["name"].'</a></h2>';
?>   
<?php
 $nazevgroup = volej("group.getAttributes",intval($_GET["id"]));
 echo "<h2 class=\"lime\">&#8618; ".$nazevgroup["group"]["name"]."</h2>";
?>    
  
</div>

<h3 class="desetleva magenta">Prokliky za posledních 7 dnù</h3>

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
$proklikyGraf = volej("group.stats",$proklikyArray);

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
if ($hodnota < 15) {
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
?>
</div>

<div class="buttonWrap activekey">
  <a href="javascript:;" class="button activekey">Klíèová slova</a>
  <a href="vypis_reklam.php?id=<?php echo $_GET["id"] ?>&amp;back=<?php echo $_GET["back"];?>" class="button adsbutton">Reklamy</a>
</div>

<?php
  $keywords = volej("listKeywords",intval($_GET["id"]));
  // print_r($groups);
    
    foreach ($keywords["keywords"] as $keyword) {   
      $id = $keyword["id"];
      $vytvoreniKeyword = $keyword["createDate"];
      
      if(mb_detect_encoding($keyword["name"], 'UTF-8', true) == "UTF-8") { /* OBÈAS se keyword vrací jako UTF-8 - ale zbytek stránky je windows-1250 - WTF */
        $nazevKeyword = iconv("UTF-8", "WINDOWS-1250//TRANSLIT", $keyword["name"]);     
      } else {
        $nazevKeyword = $keyword["name"];
      }   
      
      /* dnešní datum jako objekt */     
      $datumDo = new stdClass;
      $datumDo->scalar = date("c");
      $datumDo->xmlrpc_type = "datetime";
      $datumDo->timestamp = time();

      $statistikyArray = array($id,$vytvoreniKeyword,$datumDo);
      $statistiky = volej("keyword.stats",$statistikyArray);
      
      
      if($statistiky["stats"]["clicks"] == "0") { 
        $ctr = "0"; $cpc = "0"; 
      } else {      
        $ctr = $statistiky["stats"]["clicks"]/$statistiky["stats"]["impressions"]*100;  
        $cpc = $statistiky["stats"]["money"]/$statistiky["stats"]["clicks"]/100; 
      }
      
      $cena = $statistiky["stats"]["money"]/100;                                            
      $prumernaPozice = $statistiky["stats"]["avgPosition"];
      $status = $keyword["status"];
               
        echo      
        '<div class="kampan '.$status.'">
          <a class="kampanLink otevritKeyword" href=""><span></span></a>
          <div class="inside">
          <h3>'.$nazevKeyword.' ('.$statistiky["stats"]["clicks"].')</h3>
          <div class="keywordsData kampanData">
          
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
              <strong>'.number_format($prumernaPozice,1,","," ").'</strong>
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

        </div>';                         
      
    };       
?>             


<script>

jQuery(document).ready(function(){
    $(".otevritKeyword span").unbind("click").click( function() {
      $(this).parent().next(".inside").children(".keywordsData").slideToggle("fast");
    });
});

</script>


<?php include ('inc/footer.php') ?>