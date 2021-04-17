<!-- <?php
    // header('Location: login.php'); // On redirige vers login.php pour l'instant
?> -->
<?php
    require_once("action/IndexAction.php");

    $action = new IndexAction();
    $data = $action->execute();
    $page = "index";
    require_once("partial/header.php");
    
?>
            <main>
                <canvas id="myCanvas"></canvas>
            </main>



<?php
	require_once("partial/footer.php");