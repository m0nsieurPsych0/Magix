<?php
    require_once("action/GameAction.php");

    $action = new GameAction();
    $data = $action->execute();
    $page = "game";
    
    require_once("partial/header.php");

    var_dump($data);

?>
                <main>
                    <div>Game Time!</div>
                    
                </main>
<?php
	require_once("partial/footer.php");