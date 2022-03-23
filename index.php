<?php include("./includes/header.php") ?>
<div class="header">
    <h1 id="nav-title"><a href="#">MYSSD</a></h1>
    <nav>
        <ul>
            <li><a href="#">Inicio</a></li>
        </ul>
    </nav>
</div>
<main class="main">
    <div class="container">
        <div class="wrapper">
            <?php
            include("includes/simulations.php");
            for ($i = 0; $i < $sim_length; $i++) {
                if ($i < 10) {
                    echo '<div class="card">
                <div class="content">
                    <h2> 0' .$i + 1 . '</h2>
                    <h3>' .$simulation[$i][0]. '</h3>
                    <a href="simulations/'.$simulation[$i][1].' ">Probar simulación</a>
                </div>
            </div>';
                } else {
                    echo '<div class="card">
                 <div class="content">
                     <h2>' . $i + 1 . '</h2>
                     <h3>' .$simulation[$i][0]. '</h3>
                     <a href=""simulations/'.$simulation[$i][1].' class="button-29" ">Probar simulación</a>
                 </div>
             </div>';
                }
            }
            ?>
        </div>
    </div>
</main>
<?php include("./includes/footer.php") ?>