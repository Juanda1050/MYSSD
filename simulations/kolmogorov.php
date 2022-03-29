<?php
$nav_title = "Prueba Estadístico de Kolmogorov-Smirnov";
ob_start();
include("../includes/header_simulation.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "Kolmogorov-Smirnov", $buffer);
echo $buffer;

//Variables
$num_rectangulares = $alfa = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num_rectangulares = get_input($_POST["num_rectangulares"]);
    $alfa = get_input($_POST["alfa"]);
}

function get_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<main class="form-main">
    <div class="form-wrapper">
        <div class="form-container">
            <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-line">
                    <label for="num_rectangulares">Cantidad de números rectangulares</label>
                    <input type="number" id="num" name="num_rectangulares" table_value="<?php echo $num_rectangulares; ?>" placeholder="Valor en enteros" required>
                </div>
                <div class="form-line">
                    <label for="alfa">Valor porcentual de alfa (α)</label>
                    <input type="number" id="alfa" name="alfa" table_value="<?php echo $alfa; ?>" placeholder="Valor de α" required>
                </div>
                <div class="form-button">
                    <input class="button" type="submit" name="submit" table_value="Calcular">
                </div>
            </form>
        </div>
    </div>
    <?php
    $random_num = array();

    if (isset($_POST['submit'])) {
        echo '<div class="form-wrapper result-wrapper">
        <h3>Números rectangulares aleatorios</h3>';
        for ($i = 0; $i < $num_rectangulares; $i++) {
            $random_num[$i] = round((float)rand() / (float)getrandmax(), 5);
            echo "[" . ($i + 1) . "]\t" . $random_num[$i] . "<br>";
        }
        echo "</div>";

        echo '<table class="form-wrapper">
            <tr>
            <th>i</th>
            <th>Xi</th>
            <th>F(Xi)</th>
            <th>Dn = max|Fx(i) - Xi|</th>
        </tr>';

        $Fx = array();
        $Dn = array();
        $len_num = count($random_num);
        sort($random_num);

        for ($i = 0; $i < $num_rectangulares; $i++) {
            $Fx[$i] = (float)($i + 1) / $num_rectangulares;
            $Dn[$i] = abs($Fx[$i] - $random_num[$i]);
            echo '<tr>
            <td>' . ($i + 1) . '</td>
            <td>' . $random_num[$i] . '</td>
            <td>' . ($i + 1) . ' / ' . $num_rectangulares . ' = ' . round($Fx[$i], 2) . '</td>
            <td>' . round($Fx[$i], 2) . ' / ' . $random_num[$i] . ' = ' . round($Dn[$i], 5) . '</td>
            </tr>';
        }
        echo "</table>";

        $max_Dn = round(max($Dn), 5);

        if ($alfa == 10) {
            staticResult_alfa10($num_rectangulares, $max_Dn);
        }
        else if ($alfa == 5){
            staticResult_alfa5($num_rectangulares, $max_Dn);
        }
        else if ($alfa == 1){
            staticResult_alfa1($num_rectangulares, $max_Dn);
        }
        else{
            echo '<div class="form-wrapper result-wrapper">
                <h4>Alfa no existente</h4>
            </div>';
        }
    }
    
    function staticResult_alfa10($num_rectangulares, $max_Dn){
        include("../includes/estadistico_kolmogorov.php");
        foreach ($alfa_10 as $n => $estadistico) {
            if ($n == $num_rectangulares) {
                $table_value = $estadistico;
                echo '<div class="form-wrapper result-wrapper">
                            <h4>Valor mayor de estadisticos calculados: '.$max_Dn.'</h4>
                            <h4>Estadistico de tablas: '.$table_value.'</h4>
                            <h4>'.$max_Dn.' < '. $table_value .'</h4>
                            </div>';
            }
        }

        if ($max_Dn < $table_value){
            echo '<div class="form-wrapper result-wrapper">
                <h4>Los números son aceptados</h4>
            </div>';
        }
        else{
            echo '<div class="form-wrapper result-wrapper">
                <h4>Los números no son aceptados</h4>
            </div>';
        }
    }

    function staticResult_alfa5($num_rectangulares, $max_Dn){
        include("../includes/estadistico_kolmogorov.php");
        foreach ($alfa_5 as $n => $estadistico) {
            if ($n == $num_rectangulares) {
                $table_value = $estadistico;
                echo '<div class="form-wrapper result-wrapper">
                            <h4>Valor mayor de estadisticos calculados: '.$max_Dn.'</h4>
                            <h4>Estadistico de tablas: '.$table_value.'</h4>
                            <h4>'.$max_Dn.' < '. $table_value .'</h4>
                            </div>';
            }
        }

        if ($max_Dn < $table_value){
            echo '<div class="form-wrapper result-wrapper">
                <h4>Los números son aceptados</h4>
            </div>';
        }
        else{
            echo '<div class="form-wrapper result-wrapper">
                <h4>Los números no son aceptados</h4>
            </div>';
        }
    }

    function staticResult_alfa1($num_rectangulares, $max_Dn){
        include("../includes/estadistico_kolmogorov.php");
        foreach ($alfa_1 as $n => $estadistico) {
            if ($n == $num_rectangulares) {
                $table_value = $estadistico;
                echo '<div class="form-wrapper result-wrapper">
                            <h4>Valor mayor de estadisticos calculados: '.$max_Dn.'</h4>
                            <h4>Estadistico de tablas: '.$table_value.'</h4>
                            <h4>'.$max_Dn.' < '. $table_value .'</h4>
                            </div>';
            }
        }

        if ($max_Dn < $table_value){
            echo '<div class="form-wrapper result-wrapper">
                <h4>Los números son aceptados</h4>
            </div>';
        }
        else{
            echo '<div class="form-wrapper result-wrapper">
                <h4>Los números no son aceptados</h4>
            </div>';
        }
    }
    ?>
</main>

<?php include("../includes/footer.php") ?>