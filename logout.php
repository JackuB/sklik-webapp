<?php

 if(isset($_COOKIE["Session"])) {
  setcookie('Session', 'content', 1);
  header('Location: index.php'); 
 }
 else {  
  header('Location: index.php');
 }

?>