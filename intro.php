<?php 
session_start();
if(!isset($_SESSION["nick"])) { ?>
<script type="text/javascript"> 
   window.location="login.php"; 
</script> 
<?php }
?>



