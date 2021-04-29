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
                            <div class="username opponent" >username</div>
                            <div class="heroClass opponent">
                                heroclass
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
                            <div class="hero opponent" ><button onclick="attack({nom:'hero', uid: '0'});">HERO</button></div>
                            <div class="welcomeText opponent"  ></div>
                            <div class="remainingCardsCount opponent" ></div>
                            <div class="handSize opponent" ></div>
                            <div class="hp opponent" ></div>
                            <div class="mp opponent" ></div>
                        </div>

                        <div class="board" id="board">
                            <div id="opponent-board">opponent-board</div>
                            <div id="player-board">player-board</div>
                        </div>
                        
                        <div id="player">
                            <div id="hand">
                                hand
                            </div>
                            <div id="player-dashboard">
                                <div class="hp player" ></div>
                                <div class="mp player" ></div>
                                <div class="maxHp player" ></div>
                                <div class="maxMp player" ></div>
                                <div class="remainingCardsCount player" ></div>
                                <div class="heroPower player" ><button onclick="gameAction({type:'HERO_POWER'});"> HERO_POWER </button></div>
                                <div class="player-endTurn player" ><button onclick="gameAction({type:'END_TURN'});"> END_TURN </button></div>
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
                <div class="remainingTurnTime player" ></div>
                
            
<?php
	require_once("partial/footer.php");