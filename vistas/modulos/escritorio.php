<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
      if(!isset($_SESSION['idchofer'])){
        include_once("vistas/modulos/inc/aside.php"); }
 }
?>
<!-- INICIO DEL ESCRITORIO USUARIOS COMUNES -->
<!-- FIN DEL BODY -->
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<!-- SCRIPT UNICOS-->
<script type="text/javascript" src="vistas/js/escritorio.js"></script> 
<?php ob_end_flush(); ?>