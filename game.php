<?php
    require_once("action/GameAction.php");

    $action = new GameAction();
    $data = $action->execute();
    $page = "game";
    // $iframe = 'https://magix.apps-de-cours.com/server/#/chat/';
    // $iframe .= $_SESSION['key'];
    require_once("partial/header.php");
?>
                <main>
                    <div>Game Time!</div>
                </main>
<?php
	require_once("partial/footer.php");