<?php
$nav_title = "Prueba Estadistico de Frecuencias";
ob_start();
include("../includes/header_simulation.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "Frecuencias", $buffer);
echo $buffer;

?>

<?php include("../includes/footer.php") ?>