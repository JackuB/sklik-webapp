<?php include ('inc/header.php') ?>
<a data-transition="slidefade" href="adgroup.php?id=<?php echo $_GET["back"];?>"><img src="img/back.png" /></a>
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
echo '
<div class="wrapSloupce" style="left:'.$left.'%;width:'.$leftProcento.'%;height:'.$hodnota.'%">
<div title="'.$den.'" class="sloupecGrafu"></div>
</div>';
$n++;
}

?>
</div>





<?php
  $keywords = volej("listKeywords",intval($_GET["id"]));
  // print_r($groups);
    
    foreach ($keywords["keywords"] as $keyword) {   
      $id = $keyword["id"];
      $vytvoreniKeyword = $keyword["createDate"];
      $nazevKeyword = $keyword["name"];   
      
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
          <h2>'.$nazevKeyword.' <em>('.$statistiky["stats"]["clicks"].')</em></h2>
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