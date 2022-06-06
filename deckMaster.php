<?php
    require_once("action/DeckMasterAction.php");

    $action = new DeckMasterAction();
    $data = $action->execute();
    $page = "deckMaster";
    
    require_once("partial/header.php");

?>
                <main>
                    <button id="toggle" onclick="hideShowChat();"></button>
                    <div id="chat">
                        <iframe id="chatIframe" onload="applyStyles(this)" 
                            src=<?php
                                if($_SESSION["visibility"]>=VISIBILITY_MODERATOR){
                                    echo(CHATURL . $_SESSION['key'] . "/large");
                                }
                                else{
                                    //TODO Set proper message
                                    echo("https://magix.apps-de-cours.com/server/#/chat/demoaccount/large");
                                }    
                            ?>>
                        </iframe>
                    </div>
                    <div id="deck">
                        <iframe 
                            src=<?php
                                if($_SESSION["visibility"]>=VISIBILITY_MODERATOR){
                                    echo(DECKMASTER . $_SESSION['key']);
                                }
                                else{
                                    //TODO Set proper message
                                    echo("https://magix.apps-de-cours.com/server/#/chat/demoaccount/large");
                                }    
                        ?>>
                        </iframe>
                    </div>
                </main>
<?php
	require_once("partial/footer.php");