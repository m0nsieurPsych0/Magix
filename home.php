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
                    <div class="button-wrapper"><button id="jouer" onclick="window.location.href='?pvp=true';">__Jouer</button></div>
                    <div class="button-wrapper"><button id="pratiquer" onclick="window.location.href='?pve=true';">__Pratiquer</button></div>
                    <div class="button-wrapper"><button id="guide" onclick="window.location.href='guide.php';">__Guide_Stratégique</button></div>
                    <div class="button-wrapper"><button id="screensaver" onclick="window.location.href='index.php';">__Écran_de_Veille</button></div>
                    <div class="button-wrapper"><button id="quitter" onclick="window.location.href='?logout=true';">__Quitter</button></div>
                </div>
                <div class="chat">
                    <div class="chat-title">°º¤ø,¸¸,ø¤º°`°º¤ø,¸,ø¤°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸</div>
                    <iframe onload="applyStyles(this)" 
                            src=<?php echo(CHATURL . $_SESSION['key'] . "/large"); ?>>
                    </iframe>
                    <?php
					    if (isset($data["hasConnectionError"])){
						    ?><div class="error-div"> <?php echo("Erreur: " . $data["errorCode"]); ?> </div><?php
					    }
				    ?>
                </div>
                
            </main>


<?php
	require_once("partial/footer.php");   