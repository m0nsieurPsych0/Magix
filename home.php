<?php
    require_once("action/HomeAction.php");

    $action = new HomeAction();
    $data = $action->execute();
    $page = "home";
    // var_dump($_SESSION);
    require_once("partial/header.php");
?>
            <main>
                <div class="sidebar">
                    <div class="menu-title-wrapper">
                        <div class="menu-title">-=≡ MENU ≡=-</div>
                    </div>
                    <div class="button-wrapper"><button id="jouer" onclick="window.location.href='?pvp=true';">__Jouer</button></div>
                    <div class="button-wrapper"><button id="pratiquer" onclick="window.location.href='?pve=true';">__Pratiquer</button></div>
                    <div class="button-wrapper"><button id="screensaver" onclick="window.location.href='index.php';">__ScreenSaver</button></div>
                    <div class="button-wrapper"><button id="quitter" onclick="window.location.href='?logout=true';">__Quitter</button></div>
                </div>
                <div class="chat">
                    <div class="chat-title">°º¤ø,¸¸,ø¤º°`°º¤ø,¸,ø¤°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`</div>
                    <iframe onload="applyStyles(this)" 
                            src=<?php echo(CHATURL . $_SESSION['key'] . "/large"); ?>>
                    </iframe>
                </div>
            </main>


<?php
	require_once("partial/footer.php");   