<?php
ob_start();
include("../includes/header_simulation.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "Generador Mixto", $buffer);
echo $buffer;

//Variables
$multiplicativa = $semilla = $aditiva = $modulo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $multiplicativa = get_input($_POST["multiplicativa"]);
    $semilla = get_input($_POST["semilla"]);
    $aditiva = get_input($_POST["aditiva"]);
    $modulo = get_input($_POST["modulo"]);
} else {
    $_POST = array();
}

function get_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<div class="header">
    <h1 id="nav-title"><a href="#">Generador Congruencial Mixto</a></h1>
    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
        </ul>
    </nav>
</div>
<main class="form-main">
    <div class="form-wrapper">
        <div class="form-container">
            <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-line">
                    <label for="constante_a">Constante multiplicativa (a)</label>
                    <input type="number" id="a" name="multiplicativa" value="<?php echo $multiplicativa; ?>" placeholder="Valor de a" required>
                </div>
                <div class="form-line">
                    <label for="semilla_xo">Semilla inicial (X₀)</label>
                    <input type="number" id="xo" name="semilla" value="<?php echo $semilla; ?>" placeholder="Valor de X₀" required>
                </div>
                <div class="form-line">
                    <label for="constante_c">Constante aditiva (c)</label>
                    <input type="number" id="c" name="aditiva" value="<?php echo $aditiva; ?>" placeholder="Valor de c" required>
                </div>
                <div class="form-line">
                    <label for="modulo_m">Módulo (m)</label>
                    <input type="number" id="m" name="modulo" value="<?php echo $modulo; ?>" placeholder="Valor de m" required>
                </div>
                <div class="form-button">
                    <input class="button" type="submit" value="Calcular">
                </div>
            </form>
        </div>
    </div>
    <table class="form-wrapper">
        <tr>
            <th>n</th>
            <th>X₀</th>
            <th>((a * X₀) + c) mod m</th>
            <th>Xn + 1</th>
            <th>Numeros Rectangulares</th>
        </tr>
        <?php
        $i = 0;
        $n = 1;
        $aux_semilla = $semilla;
        do {
            $solution = (($multiplicativa * $semilla) + $aditiva) / $modulo;
            $semilla_generada = (($multiplicativa * $semilla) + $aditiva) % $modulo;
            $num_rectangulares = $semilla_generada / $modulo;
            echo '<tr>
            <td>' . $n . '</td>
            <td>' . $semilla . '</td>
            <td>' . round($solution) . ' + ' . $semilla_generada . ' / ' . $modulo . '</td>
            <td>' . $semilla_generada . '</td>
            <td>' . $semilla_generada . ' / ' . $modulo . ' = ' . round($num_rectangulares, 5) . '</td>
            </tr>';
            $semilla = $semilla_generada;
            $n = $n + 1;
            if ($semilla_generada == $aux_semilla) {
                $i = $modulo;
            } else if ($n > $modulo) {
                $i = $modulo;
            }
        } while ($i != $modulo);
        ?>
    </table>
    <?php
    if ($aux_semilla == $semilla_generada && $n - 1 == $modulo) {
        echo '<div class="form-wrapper result-wrapper">
                <h4>Generador Congruencial Mixto Confible</h4>
            </div>';
    } else {
        echo '<div class="form-wrapper result-wrapper">
                <h4>Generador Congruencial Mixto No Confible</h4>
            </div>';
    }
    ?>
</main>


<?php include("../includes/footer.php") ?>