<?php

$array = array();

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['list_num_rectangulares'])) {
        $_SESSION['list_num_rectangulares'] = $array;
    }
}
?>

<form method="post">
    <input type="number" name="num_rectangulares" required>
    <input type="hidden" name="num_rectangulares_value" value="<?php echo implode(",", $_SESSION['list_num_rectangulares'])  ?>">
    <input type="submit" name="add" value="agregar">
</form>

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
    echo "Suma " . array_sum($num_rectangulares_value) . "<br>";
}
?>
<a href="../simulations/kolmogorov_manual.php">Regresar</a>
<form method="post">
    <input type="submit" name="reset" value="back">
</form>

<?php
if (isset($_POST['reset'])) {
    $_SESSION['list_num_rectangulares'] = array();
    // clean the session variable
    session_unset();

    // destroy the session
    session_destroy();
    echo "Array eliminado.";
}
?>