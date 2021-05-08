<?php
    require_once("action/DeckMasterAction.php");

    $action = new DeckMasterAction();
    $data = $action->execute();
    $page = "deckMaster";
    
    require_once("partial/header.php");
    //test
    
    // var_dump($_SESSION);

?>
                <main>
                    <iframe src=<?php echo(DECKMASTER . $_SESSION['key']); ?>></iframe>
                </main>
<?php
	require_once("partial/footer.php");