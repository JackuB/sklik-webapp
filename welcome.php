<?php include ('inc/header.php') ?>

<div id="header">
  <img src="img/sklik_logo.png" />
    <div id="klient">
    <?php
    $klient = volej("client.getAttributes");

    echo $klient["user"]["username"]."<br />";
    $kreditTecka = $klient["user"]["walletCredit"]/100;
    $kredit=number_format($kreditTecka,2,","," ");
    echo $kredit." K�";
    ?>
    </div>

  <a href="logout.php" rel="external"><img id="logout" src="img/logout.png" /></a>
</div>

<?php
  $kampane = volej("listCampaigns");
    if(is_array($kampane)) {
      if(count($kampane["campaigns"]) > 0) {
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
                  Zobrazen�
                  <strong>'.number_format($statistiky["stats"]["impressions"],0,","," ").'</strong>
                </div>

                <div class="jednaTri">
                  CTR
                  <strong>'.number_format($ctr,2,","," ").'</strong>
                </div>


                <div class="jednaTri">
                  Denn� rozpo�et
                  <strong>'.$rozpocet.'</strong>
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
              <a data-transition="fade" class="kampanLink" href="adgroup.php?id='.$id.'" data-prefetch><span></span></a>
            </div>';
        };
      } else {
        echo "<center><h2>Nem�te nastaven� ��dn� kampan�</h2>Kampan� mus�te nejd��ve vytvo�ir na <a target=\"_blank\" href=\"http://sklik.cz\">Sklik.cz</a></center>";
      }
    } else {
      echo "Server p�i v�pisu kampan� neodpov�d�l polem";
      print_r($kampane);
    }

?>

<?php include ('inc/footer.php') ?>