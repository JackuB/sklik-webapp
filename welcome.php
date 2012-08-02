<?php include ('inc/header.php') ?>

<?php 
    $kampane = volej("listCampaigns");
    // print_r($odpoved);
    foreach ($kampane["campaigns"] as $kampan) {     
            
      echo '<div data-role="button">
         <h1>'.$kampan["name"].'</h1>
         <div class="ui-grid-b">
         <div class="ui-block-a">CTR</div>
         <div class="ui-block-b">CTR</div>
         <div class="ui-block-c">CTR</div>
         </div>
         <div class="ui-grid-b">
         <div class="ui-block-a">CTR</div>
         <div class="ui-block-b">CTR</div>
         <div class="ui-block-c">CTR</div>
         </div>   
      </div>';                  
      
    };
?>

<?php include ('inc/footer.php') ?>