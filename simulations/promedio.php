<?php
$nav_title = "Prueba Estadistico de Promedio";
ob_start();
include("../includes/header_simulation.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "Promedio", $buffer);
echo $buffer;

$random_num = array();
for ($i = 0; $i < 10; $i++){
    $random_num[$i] = round((float)rand()/(float)getrandmax(), 5);
}

sort($random_num);
foreach($random_num as $sort_num){
}

?>

<main class="form-main">
    <div class="form-wrapper">
        <div class="form-container">
            <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-line">
                    <label for="constante_a">Cantidad de números rectangulares</label>
                    <input type="number" id="a" name="multiplicativa" value="<?php echo $multiplicativa; ?>" placeholder="Valor en enteros" required>
                </div>
                <div class="form-line">
                    <label for="semilla_xo">Valor porcentual de alfa (α)</label>
                    <input type="number" id="xo" name="semilla" value="<?php echo $semilla; ?>" placeholder="Valor de α" required>
                </div>
                <div class="form-line">
                    <label for="modulo_m">Módulo (m)</label>
                    <input type="number" id="m" name="modulo" value="<?php echo $modulo; ?>" placeholder="Valor de m" required>
                </div>
                <div class="form-button">
                    <input class="button" type="submit" name="submit" value="Calcular">
                </div>
            </form>
        </div>
    </div>
</main>


<?php include("../includes/footer.php") ?>