<?php
$nav_title = "Generador Congruencial Multiplicativo";
ob_start();
include("../includes/header_simulation.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "Generador Multiplicativo", $buffer);
echo $buffer;

//Variables
$multiplicativa = $semilla = $modulo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $multiplicativa = get_input($_POST["multiplicativa"]);
    $semilla = get_input($_POST["semilla"]);
    $modulo = get_input($_POST["modulo"]);
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
                    <label for="constante_a">Constante multiplicativa (a)</label>
                    <input type="number" id="a" name="multiplicativa" value="<?php echo $multiplicativa; ?>" placeholder="Valor de a" required>
                </div>
                <div class="form-line">
                    <label for="semilla_xo">Semilla inicial (X₀)</label>
                    <input type="number" id="xo" name="semilla" value="<?php echo $semilla; ?>" placeholder="Valor de X₀" required>
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
    <?php
    $i = 0;
    $n = 1;
    $aux_semilla = $semilla;
    $periodo_finalizado = 0;
    if (isset($_POST['submit'])) {
        if (($modulo % 10) == 0) {
            $exponente = log10($modulo);
            if ($exponente >= 5) {
                $pe = 5 * pow(10, $exponente - 2);
                echo '<div class="form-wrapper result-wrapper">
                <h4>p.e. = 5 x 10' . $exponente . ' = ' . $pe . '</h4>
                </div>';
            } else if ($exponente < 5) {
                echo '<div class="form-wrapper result-wrapper">
                <h4>p.e. = m.c.m. λ(5<sup>' . $exponente . '</sup>), λ(2<sup>' . $exponente . '</sup>)</h4>';
                $lambda_5 = lambda_cinco($exponente);
                $lambda_2 = lambda_dos($exponente);

                $pe = mcm($lambda_5, $lambda_2);

                echo '
                <h4>p.e. = m.c.m. (' . $lambda_5 . ', ' . $lambda_2 . ')</h4>
            <h4>p.e. = ' . $pe . '</h4>
            </div>';
            }
        } else {
            $pe = $modulo / 4;
            echo '<div class="form-wrapper result-wrapper">
                <h4>p.e. = ' . $modulo . ' / 4 = ' . $pe . '</h4>
            </div>';
        }

        echo '<div class="form-wrapper result-wrapper">
                <h4>El periodo esperado es: ' . $pe . '</h4>
            </div>';

        echo '<table class="form-wrapper">
            <tr>
            <th>n</th>
            <th>X₀</th>
            <th>aX₀ mod m</th>
            <th>Xn + 1</th>
            <th>Numeros Rectangulares</th>
        </tr>';

        do {
            $solution = ($multiplicativa * $semilla) / $modulo;
            $semilla_generada = ($multiplicativa * $semilla) % $modulo;
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
                $i = $pe;
            } else if ($n > $pe) {
                $i = $pe;
            }
        } while ($i != $pe);

        echo "</table>";

        if ($aux_semilla == $semilla_generada && $n - 1 == $modulo) {
            echo '<div class="form-wrapper result-wrapper">
                            <h4>Generador Congruencial Mixto Confible</h4>
                        </div>';
        } else {
            echo '<div class="form-wrapper result-wrapper">
                                <h4>Generador Congruencial Mixto No Confible</h4>
                            </div>';
        }
    }

    function lambda_cinco($exponente)
    {
        $solution = 4 * pow(5, $exponente - 1);
        echo '<h4>λ(5<sup>' . $exponente . '</sup>) = 5<sup>' . $exponente . ' - 1</sup> (4)</h4>';
        return $solution;
    }

    function lambda_dos($exponente)
    {
        $solution = 0;

        if ($exponente == 0) $solution = 1;
        else if ($exponente == 1) $solution = 2;
        else if ($exponente > 1) {
            $solution = pow(2, $exponente - 2);
        }

        echo '<h4>λ(2<sup>' . $exponente . '</sup>) = 2<sup>' . $exponente . ' - 2</sup> (4)</h4>';
        return $solution;
    }

    function mcd($a, $b)
    {
        while ($b != 0) {
            $aux = $b;
            $b = $a % $b;
            $a = $aux;
        }
        return $a;
    }

    function mcm($a, $b)
    {
        return ($a * $b) / mcd($a, $b);
    }
    ?>
</main>

<?php include("../includes/footer.php") ?>