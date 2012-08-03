<?php include ('inc/header.php') ?>

<div id="header">
  <img src="img/sklik_logo.png" />
    <div id="klient">  
    <?php   
    $klient = volej("client.getAttributes");
    
    echo $klient["user"]["username"]."<br />";
    $kreditTecka = $klient["user"]["walletCredit"]/100;
    $kredit=str_replace(".", ",", $kreditTecka);
    echo $kredit." Kè";
    ?>    
    </div>

  <img id="logout" src="img/logout.png" />
</div>

<?php
  $kampane = volej("listCampaigns");
    // print_r($kampane);
    
    foreach ($kampane["campaigns"] as $kampan) {   
      $id = $kampan["id"];
      $vytvoreniKampane = $kampan["createDate"];    
      
      
      $datumDo = new stdClass;
      // $datumDo->scalar = "20120724T15:00:37+0200";
      $datumDo->scalar = date("c");
      $datumDo->xmlrpc_type = "datetime";
      $datumDo->timestamp = time();

      
      $statistikyArray = array($id,$vytvoreniKampane,$datumDo);
      $statistiky = volej("campaign.stats",$statistikyArray);
      // print_r($statistiky);
      $ctr = $statistiky["stats"]["impressions"]/$statistiky["stats"]["clicks"];  
      $cpc = $statistiky["stats"]["money"]/$statistiky["stats"]["clicks"]; 
      
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
              <strong>'.$statistiky["stats"]["impressions"].'</strong>
            </div>
            
            <div class="jednaTri">
              CTR
              <strong>'.$ctr.'</strong>
            </div>
                      
           
            <div class="jednaTri">
              Denní rozpoèet
              <strong>'.$rozpocet.'</strong>
            </div>
            
            <div class="jednaTri">
              Prùmìrná CPC
              <strong>'.$cpc.'</strong>
            </div>
            
            <div class="jednaTri">
              Cena
              <strong>'.$statistiky["stats"]["money"].'</strong>
            </div>                    
          
            <br class="clear" />
          
          </div>
          </div>
        </div>';                         
      
    };
       
?>             

<?php include ('inc/footer.php') ?>