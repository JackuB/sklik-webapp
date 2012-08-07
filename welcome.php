<?php include ('inc/header.php') ?>

<div id="header">
  <img src="img/sklik_logo.png" />
    <div id="klient">  
    <?php   
    $klient = volej("client.getAttributes");
    
    echo $klient["user"]["username"]."<br />";
    $kreditTecka = $klient["user"]["walletCredit"]/100;
    $kredit=number_format($kreditTecka,2,","," ");
    echo $kredit." Kè";
    ?>    
    </div>

  <a href="logout.php"><img id="logout" src="img/logout.png" /></a>
</div>

<?php
  $kampane = volej("listCampaigns");
    // print_r($kampane);
    
    foreach ($kampane["campaigns"] as $kampan) {   
      $id = $kampan["id"];
      $vytvoreniKampane = $kampan["createDate"];    
      
      
      $datumDo = new stdClass;
      $datumDo->scalar = date("c");
      $datumDo->xmlrpc_type = "datetime";
      $datumDo->timestamp = time();

      
      $statistikyArray = array($id,$vytvoreniKampane,$datumDo);
      $statistiky = volej("campaign.stats",$statistikyArray);
      // print_r($statistiky);
      
      
      if($statistiky["stats"]["clicks"] == "0") { 
        $ctr = "0"; $cpc = "0"; 
      } else {      
        $ctr = $statistiky["stats"]["clicks"]/$statistiky["stats"]["impressions"]*100;  
        $cpc = $statistiky["stats"]["money"]/$statistiky["stats"]["clicks"]/100; 
      }
      
      $cena = $statistiky["stats"]["money"]/100;                                            
      $rozpocet = $kampan["dayBudget"]/100;
      $status = $kampan["status"];
    
    
       
                  
        echo      
        '<div class="kampan '.$status.'">
          <div class="inside">
          <h2>'.$kampan["name"].'</h2>
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
              Denní rozpoèet
              <strong>'.$rozpocet.'</strong>
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
          <a data-transition="fade" class="kampanLink" href="adgroup.php?id='.$id.'"><span></span></a>
        </div>';                         
      
    };
       
?>             

<?php include ('inc/footer.php') ?>