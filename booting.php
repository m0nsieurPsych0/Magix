<!-- <?php
    // header('Location: login.php'); // On redirige vers login.php pour l'instant
?> -->
<?php
    require_once("action/bootingAction.php");

    $action = new BootingAction();
    $data = $action->execute();
    $page = "booting";
    require_once("partial/header.php");
    
?>
            <main>
                <canvas id="myCanvas"></canvas>
            </main>


<?php
	require_once("partial/footer.php");