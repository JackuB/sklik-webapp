<?php include ('inc/header.php') ?>

<div id="header">
  <img src="img/sklik_logo.png" />
    
  <img id="logout" src="img/logout.png" />
</div>

<?php
  $groups = volej("listGroups",intval($_GET["id"]));
  // print_r($groups);
    
    foreach ($groups["groups"] as $group) {   
      $id = $group["id"];
      $vytvoreniGroup = $group["createDate"];    
      
      /* dnešní datum jako objekt */     
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
          <h2>'.$group["name"].'</h2>
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
        </div>';                         
      
    };       
?>             

<?php include ('inc/footer.php') ?>