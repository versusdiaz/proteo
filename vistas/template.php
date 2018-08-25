<?php
ob_start();
session_start();
include_once('modulos/inc/header.php');
?>
<?php $module=new Enlaces(); $module->enlacesController();?>

</body>
</html>