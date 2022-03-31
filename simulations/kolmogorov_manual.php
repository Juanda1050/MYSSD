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
    <div class="form-wrapper result-wrapper">
        <a href="../simulations/kolmogorov.php">
            <h4>Prueba Estadístico de Kolmogorov-Smirnov aleatorios</h4>
        </a>
    </div>
    <div class="form-wrapper">
        <div class="form-container">
            <form class="form" method="post" id="myform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-line">
                    <label for="num_rectangulares">Números rectangulares</label>
                    <input type="number" id="num_rectangulares" name="num_rectangulares" value="<?php echo $num_rectangulares?>" placeholder="Valor en enteros" required>
                </div>
                <div class="form-button">
                    <input class="add-button" type="submit" name="add" value="Agregar" onclick="addNumber()">
                </div>
                <div class="form-line">
                    <label for="alfa">Valor porcentual de alfa (α)</label>
                    <input type="number" id="alfa" name="alfa" value="<?php echo $alfa; ?>" placeholder="Valor de α" required>
                </div>
                <div class="form-button">
                    <input class="button" type="submit" name="submit" value="Calcular">
                </div>
            </form>
        </div>
    </div>
    <h6>Muestra:</h6>
    <div id="print_num" class="mb-2"></div>

    <script type="text/javascript" src="../includes/num_manual.js"></script>

    <?php
    if (isset($_POST['add'])) {
        $list_num_rectangulares = json_decode($_POST['jsonString'], true);
        print_r($list_num_rectangulares);
        foreach ($list_num_rectangulares as $num) {
            echo $num . "<br>";
        }
        $count = count($list_num_rectangulares);
    }
    ?>
</main>
<?php include("../includes/footer.php") ?>