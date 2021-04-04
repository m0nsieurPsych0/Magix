<?php
header('Location: login.php'); // On redirige vers login.php pour l'instant
?>
<?php
    require_once("action/IndexAction.php");

    $action = new IndexAction();
    $data = $action->execute();

    require_once("partial/header.php");
    
    // index.php?redirect=lobby.php

?>
        <main>
            index.php
        </main>



<?php
	require_once("partial/footer.php");