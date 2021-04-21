<?php
    require_once("action/GameAction.php");

    $action = new GameAction();
    $data = $action->execute();
    $page = "game";
    
    require_once("partial/header.php");

?>
                <main>
                    <div class="opponent">
                        <div class="opponent-welcomeText"></div>
                        <div class="opponent-name"></div>
                        <div class="opponent-class"></div>
                        <div class="opponent-life"></div>
                        <div class="opponent-hp"></div>
                        <div class="opponent-mp"></div>
                        <div class="opponent-remainingCards"></div>
                        <div class="opponent-handSize"></div>

                    </div>

                    <div class="player">
                        <div class="player-welcomeText"></div>
                        <div class="player-name"></div>
                        <div class="player-class"></div>
                        <div class="player-life"></div>
                        <div class="player-hp"></div>
                        <div class="player-mp"></div>
                        <div class="player-remainingCards"></div>
                        <div class="player-handSize"></div>
                        <div class="player-heroPower"></div>
                        <div class="player-endTurn"></div>
                        <div class="player-time"></div>
                        
                    </div>

                    <div></div>
                    
                </main>
<?php
	require_once("partial/footer.php");