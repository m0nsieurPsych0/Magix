<?php
    require_once("action/GameAction.php");

    $action = new GameAction();
    $data = $action->execute();
    $page = "game";
    
    require_once("partial/header.php");

?>

                <main>

                    <div id="info-wrapper">
                        <div id="opponent-info">
                            <div class="username opponent" ></div>
                            <div class="heroClass opponent"></div>
                            <div id="class-description" class="opponent"></div>
                            <div class="talent opponent"></div>
                            <div id="talent-description" class="opponent"></div>
                            <div id="stats">
                                <div id="trophy">
                                    Trophy
                                    <div class="trophyCount opponent" id="trophyCount"></div>
                                </div>
                                <div id="win">
                                    Win
                                    <div class="winCount opponent" id="winCount"></div>
                                </div>
                                <div id="loss">
                                    Loss
                                    <div class="lossCount opponent" id="lossCount"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="control-center">
                            

                        </div>
                    </div>

                    
                    <div id="game-wrapper">
                        <div id="opponent">
                            <div class="remainingCardsCount opponent" ></div>
                            <div class="handSize opponent" ></div>
                            <div class="brain" onclick="attack({nom:'hero', uid: '0'});"><img src="asset\opponent\isolatedbrainFromimage.svg" id="brain" ></div>
                            <div class="hp opponent" ></div>
                            <div class="mp opponent" ></div>
                            <div class="welcomeText opponent"></div>
                            <div id="opponent-turn"></div>
                        </div>
                        <div class="board" id="board">
                            <div id="opponent-board"></div>
                            <div id="player-board"></div>
                            <div class="remainingTurnTime player" ></div>
                            <canvas id="board-background"></canvas>
                        </div>

                        
                        
                        <div id="player">
                            <div id="hand">
                                <!-- <div class="players-hand" id="test">
                                    <div class="atk card">atk:7</div>
                                    <div class="hp card">hp:2</div>
                                    <div class="cost card">cost:8</div>
                                    <div class="mechanics card">
                                        <div class="mechanics-content">Stealth, At the start of your turn, give +1 HP to a random friendly minion</div>
                                    </div>
                                    <div class="state card">sleep</div>
                                    <img src="asset\cartes\Card-SIDES.png" id="card-side">
                                    <img id="card-center" src="asset\cartes\Card-CENTER.png">
                                    <img id="card-taunt" src="asset\cartes\Card-TAUNT.png">
                                </div> -->
                            </div>
                            <div id="player-dashboard">
                                <div class="hp player" ></div>
                                <div class="mp player" ></div>
                                <div class="remainingCardsCount player" ></div>
                                <div id="player-button">
                                    <button class="heroPower player" onclick="gameAction({type:'HERO_POWER'});"> _HERO_POWER </button>
                                    <button class="player-endTurn player" onclick="gameAction({type:'END_TURN'});"> _END_TURN </button>
                                </div>
                            </div>
                            <div id="player-turn"></div>
                        </div>
                    </div>

                    <!------------- Section Template -------------->

                    
                    <template class="card-template" id="card-template">
                        <!-- <div class="name"></div> -->
                        <div class="atk card"></div>
                        <div class="hp card"></div>
                        <div class="cost card"></div>
                        <!-- <div class="baseHP"></div> -->
                        <div class="mechanics card">
                            <div class="mechanics-content"></div>
                        </div>
                        <div class="state card"></div>
                        <img id="card-side" src="asset\cartes\Card-SIDES.png">
                        <img id="card-center" src="asset\cartes\Card-CENTER-SMALLBORDER.png">
                        <!-- <img id="card-taunt" src="asset\cartes\Card-TAUNT-SMALLBORDER.png"> -->
                    </template>

                    <template id="chat-template">
                        <iframe onload="applyStyles(this)" 
                                src=<?php echo(CHATURL . $_SESSION['key'] . "/large"); ?>>
                        </iframe>
                    </template>
                    
                    
                    
                </main>
                
                
                
            
<?php
	require_once("partial/footer.php");