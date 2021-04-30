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
                            <div class="heroClass opponent">
                                <div id="class-description"></div>
                            </div>
                            <div class="talent opponent">
                                talent</div>
                                <div id="talent-description"></div>
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
                            <img src="asset\opponent\isolatedbrainFromimage.svg" id="brain" onclick="attack({nom:'hero', uid: '0'});">
                            <div class="hp opponent" ></div>
                            <div class="mp opponent" ></div>
                        </div>

                        <div class="board" id="board">
                            <div id="opponent-board"></div>
                            <div id="player-board"></div>
                            <div class="remainingTurnTime player" ></div>
                            <canvas id="board-background"></canvas>
                        </div>
                        
                        
                        <div id="player">
                            <div id="hand">
                                
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
                        </div>
                    </div>

                    <!-- À DÉPLACER ET REFACTOR -->
                    

                        <!-- <div class="welcomeText" ></div>
                        <div class="heroClass" ></div>
                        <div class="talent"></div> -->
                        
                        
                        
                        <!-- <div class="hand" id="players-hand" ></div>
                        <div class="heroPowerAlreadyUsed" ></div> -->
                        
                        
                   
                   

                    <!------------- Section Template -------------->

                    
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
                    
                    <template id="chat-template">
                        <iframe onload="applyStyles(this)" 
                                src=<?php echo(CHATURL . $_SESSION['key'] . "/large"); ?>>
                        </iframe>
                    </template>
                    
                    
                </main>
                
                <div class="welcomeText opponent"></div>
                
            
<?php
	require_once("partial/footer.php");