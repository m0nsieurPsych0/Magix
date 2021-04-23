<?php
    require_once("action/GameAction.php");

    $action = new GameAction();
    $data = $action->execute();
    $page = "game";
    
    require_once("partial/header.php");

?>

                <main>
                    
                    <div class="opponent-wrapper" id="opponent-wrapper">
                        <div class="hero" id="opponent"></div>
                        
                        <div class="trophyCount" id="opponent"></div>
                        <div class="winCount" id="opponent"></div>
                        <div class="lossCount" id="opponent"></div>
                        <div class="welcomeText" id="opponent"></div>
                        <div class="heroClass" id="opponent"></div>
                        <div class="talent" id="opponent"></div>
                        <div class="remainingCardsCount" id="opponent"></div>
                        <div class="handSize" id="opponent"></div>
                        <div class="hp" id="opponent"></div>
                        <div class="mp" id="opponent"></div>

                    </div>
                    <div class="board">
                        <div class="opponent-board" id="opponent-board">
                            opponent
                        </div>
                        
                        <div class="players-board" id="players-board">player</div>
                        
                    </div>
                    <div class="player-wrapper" id="player-wrapper">
                        <div class="welcomeText" id="player"></div>
                        <div class="heroClass" id="player"></div>
                        <div class="talent"id="player"></div>
                        <div class="remainingCardsCount" id="player"></div>
                        <div class="hp" id="player"></div>
                        <div class="mp" id="player"></div>
                        <div class="maxHp" id="player"></div>
                        <div class="maxMp" id="player"></div>
                        
                        <div class="remainingTurnTime" id="player"></div>
                        <div class="hand" id="players-hand" id="player">hand</div>
                        <div class="heroPowerAlreadyUsed" id="player"></div>
                        <div class="heroPower" id="player"><button onclick="gameAction('HERO_POWER');"> HERO_POWER </button></div>
                        <div class="player-endTurn" id="player"><button onclick="gameAction('END_TURN');"> END_TURN </button></div>
                        
                    </div>
                   

                    <!------------- Section Template -------------->

                    <template class="opponent">

                    </template>
                    
                    <template class="card-template" id="card-template">
                        <div id="id"></div>
                        <div id="name"></div>
                        <div id="cost"></div>
                        <div id="hp"></div>
                        <div id="baseHP"></div>
                        <div id="atk"></div>
                        <div id="state"></div>
                        <div id="mechanics">
                            <div id="mechanic-content">
                            </div>
                        </div>
                        <div id="dedicated"></div>
                        <div id="uid"></div>
                    </template>
                    
                </main>
<?php
	require_once("partial/footer.php");