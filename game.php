<?php
    require_once("action/GameAction.php");

    $action = new GameAction();
    $data = $action->execute();
    $page = "game";
    
    require_once("partial/header.php");

?>

                <main>
                    
                    <div class="opponent-wrapper" id="opponent-wrapper">
                        <div class="hero" id="opponent"><button onclick="attack({nom:'hero', uid: '0'});">HERO</div>
                        
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
                        <div class="hand" id="players-hand" id="player"></div>
                        <div class="heroPowerAlreadyUsed" id="player"></div>
                        <div class="heroPower" id="player"><button onclick="gameAction({type:'HERO_POWER'});"> HERO_POWER </button></div>
                        <div class="player-endTurn" id="player"><button onclick="gameAction({type:'END_TURN'});"> END_TURN </button></div>
                        
                    </div>
                   

                    <!------------- Section Template -------------->

                    <template class="opponent">

                    </template>
                    
                    <template class="card-template" id="card-template">
                        <div class="id"></div>
                        <div class="name"></div>
                        <div class="cost"></div>
                        <div class="hp"></div>
                        <div class="baseHP"></div>
                        <div class="atk"></div>
                        <div class="state"></div>
                        <div class="mechanics">
                            <div class="mechanic-content">
                            </div>
                        </div>
                        <div class="dedicated"></div>
                        <!-- NE PAS AFFICHER LE UID -->
                        <div class="uid"></div>
                    </template>
                    
                    
                </main>
                <!-- Video intro -->
                <template id="enterDoor">
                    <source src="asset\video\enter_door1080p60Med.mp4" type="video/mp4">
                </template>
                <!-- Exit door -->
                <template id="exitDoor">
                    <video autoplay muted id="enter">
                        <source id="exit" src="asset\video\exit_door1080p60Med.mp4" type="video/mp4">
                    </video>
                </template>
            
<?php
	require_once("partial/footer.php");