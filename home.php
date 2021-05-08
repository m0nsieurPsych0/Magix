<?php
    require_once("action/HomeAction.php");

    $action = new HomeAction();
    $data = $action->execute();
    $page = "home";
    
    // var_dump($_SESSION["username"]);
    require_once("partial/header.php");
    ?>
        <script>saveUsername( "<?php echo($_SESSION["username"]); ?>" );</script>
    <?php
?>
            <main>
                <div class="sidebar">
                    <div class="menu-title-wrapper">
                        <div class="menu-title">-=≡ MENU ≡=-</div>
                    </div>
                    <div class="button-wrapper" onclick="window.location.href='?pvp=true';"><button id="jouer" >__Jouer</button></div>
                    <div class="button-wrapper" onclick="window.location.href='?pve=true';"><button id="pratiquer" >__Pratiquer</button></div>
                    <div class="button-wrapper" onclick="window.location.href='#';"><button id="deck" >__Deck_Master</button></div>
                    <div class="button-wrapper" onclick="window.location.href='guide.php';"><button id="guide" >__Guide_Stratégique</button></div>
                    <div class="button-wrapper" onclick="window.location.href='index.php';"><button id="screensaver" >__Écran_de_Veille</button></div>
                    <div class="button-wrapper" onclick="window.location.href='?logout=true';"><button id="quitter" >__Quitter</button></div>
                </div>
                <div class="chat">
                    <div class="chat-title">°º¤ø,¸¸,ø¤º°`°º¤ø,¸,ø¤°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸</div>
                    <div id="chat">
                        <iframe onload="applyStyles(this)" 
                            src=<?php echo(CHATURL . $_SESSION['key'] . "/large"); ?>>
                        </iframe>
                    </div>
                    <script>test();</script>
                    <!-- <iframe onload="applyStyles(this)" 
                            src=<?php echo(DECKMASTER . $_SESSION['key']); ?>>
                    </iframe> -->
                    <?php
					    
				    ?>
                    <div id="system-messages-title">Messages_Système_____________________________________________________________________________________________________
                        <div id="log">
                            <?php
                                if(isset($data['info'])){
                                    foreach($data['info'] as $key => $value){
                                        ?> <li id=><?php echo($key . $value); ?> </li> <?php
                                    }
                                    unset($value); //Détruire par sécurité recommandé ici: https://www.php.net/manual/en/control-structures.foreach.php
                                }
                                if (isset($data["hasConnectionError"])){
                                    ?><li class="error-div"> <?php echo("Erreur: " . $data["error"]); ?> </li><?php
                                }
				            ?>
                            
                        </div>
                    </div>

                </div>
                
            </main>


<?php
	require_once("partial/footer.php");   