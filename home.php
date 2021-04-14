<?php
    require_once("action/HomeAction.php");

    $action = new HomeAction();
    $data = $action->execute();
    $page = "home";
    require_once("partial/header.php");
?>
            <main>
                
            </main>