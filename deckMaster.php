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
                    <div id="chat">
                        <iframe onload="applyStyles(this)" 
                            src=<?php echo(CHATURL . $_SESSION['key'] . "/large"); ?>>
                        </iframe>
                    </div>
                    <div id="deck">
                        <iframe src=<?php echo(DECKMASTER . $_SESSION['key']); ?>></iframe>
                    </div>   
                </main>
<?php
	require_once("partial/footer.php");