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
            <form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-line">
                    <label for="num_rectangulares">Números rectangulares</label>
                    <input type="number" id="num" name="num_rectangulares" value="<?php echo $num_rectangulares; ?>" placeholder="Valor en enteros" required>
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
    <?php
    $number_list = [];
        if (isset($_POST['add'])){
            array_push($number_list, $num_rectangulares);
            foreach ($number_list as $num) {
                echo $num . "<br>"; 
             }
             print_r($number_list);
        }
    ?>
</main>

<?php include("../includes/footer.php") ?>