<?php

 if(isset($_COOKIE["Session"])) {
  setcookie('Session', 'content', 1);
  header('Location: index.php'); 
 }

?>