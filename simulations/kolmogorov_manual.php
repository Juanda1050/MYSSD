<?php
$nav_title = "Prueba Estadístico de Kolmogorov-Smirnov";
ob_start();
include("../includes/header_simulation.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "Kolmogorov-Smirnov", $buffer);
echo $buffer;

//Variables
session_start();
if (!isset($_SESSION['list_num_rectangulares'])) {
    $_SESSION['list_num_rectangulares'] = array();
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
    <div class="form-wrapper result-wrapper">
        <a href="../simulations/kolmogorov.php">
            <h4>Prueba Estadístico de Kolmogorov-Smirnov aleatorios</h4>
        </a>
    </div>
    <div class="form-wrapper">
        <div class="form-container">
            <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-line">
                    <label for="num_rectangulares">Números rectangulares</label>
                    <input type="number" id="num_rectangulares" name="num_rectangulares" placeholder="Valor en enteros" required>
                    <input type="hidden" name="num_rectangulares_value" value="<?php echo implode(",", $_SESSION['list_num_rectangulares'])  ?>">
                </div>
                <div class="form-button">
                    <input class="add-button" type="submit" name="add" value="Agregar">
                </div>
                <!-- <div class="form-line">
                    <label for="alfa">Valor porcentual de alfa (α)</label>
                    <input type="number" id="alfa" name="alfa" value="<?php echo $alfa; ?>" placeholder="Valor de α" required>
                </div>
                <div class="form-button">
                    <input class="button" type="submit" name="submit" value="Calcular">
                </div> -->
            </form>
        </div>
    </div>
    <h6>Muestra:</h6>
    <div id="print_num" class="mb-2"></div>

    <?php
    if (isset($_POST['add'])) {
        $num_rectangulares = $_POST['num_rectangulares'];
        if (!empty($_POST['num_rectangulares_value'])) {
            $num_rectangulares_value = explode(",", $_POST['num_rectangulares_value']);
        } else {
            $num_rectangulares_value = array();
        }

        array_push($num_rectangulares_value, $num_rectangulares);
        $_SESSION['list_num_rectangulares'] = $num_rectangulares_value;

        for ($i = 0; $i < count($num_rectangulares_value); $i++) {
            echo $num_rectangulares_value[$i] . "<br>";
        }
    }

    ?>
</main>
<?php include("../includes/footer.php") ?>