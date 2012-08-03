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
    
    $rozpocet = $kampan["dayBudget"]/100;
    $status = $kampan["status"];
    
              
        echo      
        '<div class="kampan '.$status.'">
          <div class="inside">
          <h2>'.$kampan["name"].'</h2>
          <div class="kampanData">
          
            <div class="jednaTri">
              Prokliky
              <strong>196</strong>
            </div>
            
            <div class="jednaTri">
              Zobrazení
              <strong>136 657</strong>
            </div>
            
            <div class="jednaTri">
              CTR
              <strong>1,68%</strong>
            </div>
                      
           
            <div class="jednaTri">
              Denní rozpoèet
              <strong>'.$rozpocet.'</strong>
            </div>
            
            <div class="jednaTri">
              Prùmìrná CPC
              <strong>9,68</strong>
            </div>
            
            <div class="jednaTri">
              Cena
              <strong>1 987,44</strong>
            </div>                    
          
            <br class="clear" />
          
          </div>
          </div>
        </div>';                         
      
    };
       
?>             

<?php include ('inc/footer.php') ?>