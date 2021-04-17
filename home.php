<?php
    require_once("action/HomeAction.php");

    $action = new HomeAction();
    $data = $action->execute();
    $page = "home";
    $iframe = 'https://magix.apps-de-cours.com/server/#/chat/';
    $iframe .= $_SESSION['key'];
    require_once("partial/header.php");
?>
            <main>
                <div class="sidebar">
                    <div class="menu-title-wrapper">
                        <div class="menu-title">-=≡ MENU ≡=-</div>
                    </div>
                    <div class="button-wrapper"><button>__Jouer</button></div>
                    <div class="button-wrapper"><button>__pratiquer</button></div>
                    <div class="button-wrapper"><button>__ScreenSaver</button></div>
                    <div class="button-wrapper"><button>__Quitter</button></div>
                </div>
                <div class="chat">
                    <div class="chat-title">°º¤ø,¸¸,ø¤º°`°º¤ø,¸,ø¤°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸¸,ø¤º°`°º¤ø,¸</div>
                    <iframe onload="applyStyles(this)" 
                            src=<?php echo($iframe); ?>>
                    </iframe>
                </div>
            </main>


<?php
	require_once("partial/footer.php");   