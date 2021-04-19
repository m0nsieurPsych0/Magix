<?php
    require_once("action/GameAction.php");

    $action = new GameAction();
    $data = $action->execute();
    $page = "game";
    
    require_once("partial/header.php");
    //test
    var_dump($data);
    // var_dump($_SESSION);

?>
                <main>
                    <div>Game Time!</div>
                    
                </main>
<?php
	require_once("partial/footer.php");