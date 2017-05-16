<?php 
session_start();
unset($_SESSION['nick']);
session_destroy();
header("location:login.php");
?>
<script type="text/javascript"> 
  window.location="login.php"; 
 </script> 