// Initialise une fonction qui va intercepter le retour en arrière du navigateur
// Lorsqu'on capte un retour en arrière on appel la fonction de vidéo 'exit' puis on retourne à home.php
((global) => {catchingBackButtonEvent(global);})(window);

window.addEventListener("load", () => {
    playVideo(videoSource.enter); // video intro
    resetAccumulator(); // initialiser la variable Accumulator
    importJson();
    gameBackground();
    setTimeout(gameState(), 1000);// Appel initial (attendre 1 seconde)
});

// GLOBAL VARIABLES *****************************************
let opponentInfo;
let errorDef;
const importJson = () => {
    // let path = ["asset/classTalent.json", "asset/errorDef.json"];
    // for (let file in path){
    //     fetch(file)
    //     .then(response => response.json())
    //     .then(data => {
    //         if(file == "asset/classTalent.json"){
    //             opponentInfo = data;
    //         }
    //         else{
    //             errorDef = data;
    //         }
    //     })
    // }
    fetch("asset/classTalent.json")
    .then(response => response.json())
    .then(data => {
        opponentInfo = data;
    })

    fetch("asset/errorDef.json")
    .then(response => response.json())
    .then(data => {
        errorDef= data;
    })
}
let cardDestination = [
    {
        // htmlDestination : "players-hand", 
        htmlDestination : "hand", 
        dataRoot: "",//data.hand, 
        className: "players-hand",
        functionCall: "gameAction({type: 'PLAY', uid: this.id});"
    },
    {
        htmlDestination : "player-board", 
        dataRoot: "", //data.board, 
        className: "players-card",
        functionCall: "attack({nom: this.className, uid: this.id});"
    },
    {
        htmlDestination : "opponent-board", 
        dataRoot: "", //data.opponent.board, 
        className: "opponents-card",
        functionCall: "attack({nom: this.className, uid: this.id});"
    },

];
const videoSource = {
    enter: String.raw`<source src="asset/video/enter_door1080p60Med.mp4" type="video/mp4">`,
    exit: String.raw`<source src="asset/video/exit_door1080p60Med.mp4" type="video/mp4">`
};
let exitPlayed = false; //Prévenir que la vidéo 'exit' joue deux fois en terminant une partie
let Accumulator;
let opponentMaxHp = 0;
let opponentMaxMp = 0;

const setOpponentMaxMpHp = (data) => {
    if (data.opponent.hp > opponentMaxHp){
        opponentMaxHp = data.opponent.hp;
    }
    if (data.opponent.mp > opponentMaxMp){
        opponentMaxMp = data.opponent.mp;
    }
}
const resetAccumulator = () =>{
    
    Accumulator = 
    {
        type: 'ATTACK',
        source:'',
        destination:''
    } 
}

// ************************************************************

const gameState = () => {
    fetch("ajax.php", {   // Il faut créer cette page et son contrôleur appelle
        method : "POST",       // l’API (games/state)
        credentials: "include",
    })
    .then(response => response.json())
    .then(data => {
    // console.log(data); // contient les cartes/état du jeu.
        try{
            switch(data){
                case "LAST_GAME_LOST":
                case "LAST_GAME_WON" :
                    endScreen(data);
                    break;
                case "GAME_NOT_FOUND":
                case "":
                case null: 
                    playVideo(videoSource.exit);
                    break;
                case "WAITING": 
                    console.log("I see waiting");
                    setTimeout(gameState, 1000);
                    break;
                default:
                    game(data);
                    setTimeout(gameState, 1000);
            }
        }
        catch(e) {
            console.log(e);
            // playVideo(videoSource.exit);
        }
    })
}

const gameAction = (send) =>{
    // console.log(send);

    let formData = new FormData();

    switch(send.type){
        case "PLAY": 
            console.log("I see PLAY");
            formData.append("type", send.type);
            formData.append("uid", send.uid);
            break;
        case "ATTACK": 
            console.log("I see ATTACK");
            formData.append("type", send.type);
            formData.append("uid", send.source);
            formData.append("targetuid", send.destination);
            break;
        case "END_TURN": resetAccumulator();
        default: formData.append("type", send.type);
    }

    //Envoi les requêtes à l'API
    console.log(formData);
    fetch("ajax.php", { 
        method : "POST",       
        credentials: "include",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        
        console.log('then');
        console.log(typeof data);
        if (data && data.length != 0 && typeof data != "object"){
            error(errorDef[data]);
        }
    })
}

const game = (data) => {
    
    updateGameData(data);
    
    cardDestination.map(elem => {
        switch(elem.htmlDestination){
            case "hand": elem.dataRoot = data.hand; break;
            case "player-board": elem.dataRoot = data.board; break;
            case "opponent-board": elem.dataRoot = data.opponent.board; break;
        }
        createCards(elem);
	});

    checkIfCanPlay(data);
}

const updateGameData = (data) =>{
    setOpponentMaxMpHp(data);

    for (let key in data){
        switch(key){
            // player
            case "yourTurn":
                if (data[key]){ 
                    document.getElementById("player-turn").style.backgroundImage =  "radial-gradient(circle, rgba(255, 255, 255, 0.75), black 50%, transparent)";
                    document.getElementById("opponent-turn").style.backgroundImage =  "none";
                }
                else{
                    document.getElementById("opponent-turn").style.backgroundImage =  "radial-gradient(circle, rgba(255, 255, 255, 0.75), black 50%, transparent)";
                    document.getElementById("player-turn").style.backgroundImage =  "none";

                }
                break;
            case "remainingTurnTime": document.querySelector("." + key + ".player").innerHTML = data[key]; break;
            case "remainingCardsCount" : document.querySelector("." + key + ".player").innerHTML = "Deck: " + data[key]; break;
            case "hp": document.querySelector("." + key + ".player").innerHTML = "Hp: " + data[key] + "/" + data["maxHp"]; break;
            case "mp": document.querySelector("." + key + ".player").innerHTML = "Mp: " + data[key] + "/" + data["maxMp"]; break;
            
            // opponent
            case "opponent":
                for (let key in data.opponent){
                    switch(key){
                        case "board": break; //skip

                        case "heroClass":
                            document.querySelector("." + key + ".opponent").innerHTML = splitWords(data.opponent[key]) + ":";
                            // Description "heroClass"
                            document.querySelector("#class-description").innerHTML = opponentInfo.heroClass[data.opponent[key]];
                            break;

                        case "talent":
                            document.querySelector("." + key + ".opponent").innerHTML = splitWords(data.opponent[key]) + ":";
                            // Description "talent"
                            document.querySelector("#talent-description").innerHTML = opponentInfo.talent[data.opponent[key]];
                            break;

                        case "hp": document.querySelector("." + key + ".opponent").innerHTML = "Hp: " + data.opponent[key] + "/" + opponentMaxHp; break;
                        case "mp": document.querySelector("." + key + ".opponent").innerHTML = "Mp: " + data.opponent[key] + "/" + opponentMaxMp; break;
                        case "remainingCardsCount" : document.querySelector("." + key + ".opponent").innerHTML = "Deck: " + data.opponent[key]; break;
                        case "handSize" : document.querySelector("." + key + ".opponent").innerHTML = "Hand: " + data.opponent[key]; break;
                        default: 
                            document.querySelector("." + key + ".opponent").innerHTML = data.opponent[key];
                    }
                };
                break;
            default:
                break; // Si ce n'est pas un des cas évalués on skip
        }
        
    }

}

const checkChange = () =>{
    //TODO optimisation du réaffichage des cartes et de la mise à jour des informations.
}
const createCards = (target) => {

    document.getElementById(target.htmlDestination).innerHTML = "";

    // On crée la carte
    for (let i = 0; i < target.dataRoot.length; i++){
        
        let div = document.createElement("div");
        div.id = target.dataRoot[i]["uid"];
        div.className = target.className;
        div.innerHTML = document.querySelector("#card-template").innerHTML;

        // On met à jour ses informations
        for (key in target.dataRoot[i]){
            
            if (div.querySelector("."+key) != null){                
                switch(key){
                    
                    case "state": div.querySelector("."+key).innerText = target.dataRoot[i][key]; break;
                    case "mechanics":
                        target.dataRoot[i].mechanics.map(elem => {
                            if(elem == "Taunt"){
                                div.innerHTML += '<img id="card-taunt" src="asset/cartes/TAUNT-ICON.png">';
                            }
                            if(elem == "Stealth"){
                                div.innerHTML += '<img id="card-stealth" src="asset/cartes/Card-STEALTH-SMALLBORDER.png">';
                            }
                        })
                        div.querySelector("."+key).innerText = target.dataRoot[i][key]; break;
                    default:
                        div.querySelector("."+key).innerText = key + " " +  target.dataRoot[i][key];
                }
            }
        }
        div.setAttribute("onclick", target.functionCall);
        document.getElementById(target.htmlDestination).append(div);
    }
}

const attack = (data) =>{

    switch(data.nom){
        case "players-card":
            console.log("clicked players card");
            // When card clicked make flashy-flashy
            // document.getElementById(data.uid + "card-side").className += "flashy-flashy";
            
            Accumulator.source = data.uid; 
            break;
        case "hero": console.log("clicked opponents Hero");
        case "opponents-card": 
            
            if(Accumulator.source.length != 0 ){
                console.log("clicked opponents card");
                Accumulator.destination = data.uid;
                console.log(Accumulator);
                gameAction(Accumulator);
                resetAccumulator(); 
            }
            else{
                // choisir une carte avant d'attaquer
               error("Choisir une carte avant d'attaquer");
            }
    }
}

const checkIfCanPlay = (data) =>{
    // **NOTE: Le id des cartes dans le html c'est le uid dans la logique du jeu **

    // Make glowy-glowy

    if(data.yourTurn == true){
        //'hand' Vérifie le coût des cartes
        data.hand.map(card => {
            if(card.cost <= data.mp){
                document.getElementById(card.uid).style.boxShadow = "0 0 1rem chartreuse";
            }
        })
        
        //'board' Vérifie si la carte est 'idle'
        data.board.map(card =>{
            if(card.state != "SLEEP"){
                document.getElementById(card.uid).style.boxShadow = "0 0 1rem chartreuse";
            }
        })

        //'hero-Power'
        if(!data.heroPowerAlreadyUsed && data.mp >= 2){
            document.getElementById("hero-Power").style.boxShadow = "0 0 1rem chartreuse";
        }
        else{
            document.getElementById("hero-Power").style.boxShadow = "none";
        }
}
    
}

const playVideo = (source) => {
    // Ne rejoue pas la vidéo 'enter' si on reload la page
    // Fonctionne seulement pour Firefox
    if (performance.getEntriesByType("navigation")[0].type == "navigate" || source == videoSource.exit ){
    
        let body = document.body;
        let video = document.createElement("video");

        video.id = source == videoSource.enter ? "enter" : "exit";
        video.setAttribute("onloadedmetadata","this.muted=true"); // Wow. ça c'est sneaky!! Sources: https://stackoverflow.com/questions/51464647/html5-video-doesnt-autoplay-even-while-muted-in-chrome-67-using-angular
        if(source == videoSource.enter){
            video.setAttribute("autoplay", "");
        }
        video.innerHTML = source;
        body.append(video);


        if (source == videoSource.enter){
            let played = false;
            let enter = document.getElementById("enter");

            enter.addEventListener('ended', ()=>{
                played = true;
                document.querySelector("main").style.visibility = "visible";
                loadingChat();
                video.remove();
            }, true );
            enter.playbackRate = 1.50;

            // La vérification du reload ne fonctionne pas dans chrome/chromium
            setTimeout(() => {
                if(!played){
                    document.querySelector("main").style.visibility = "visible";
                    loadingChat();
                    video.remove();
                }
            }, 4500);
            
        }
        else if (!exitPlayed){
            exitPlayed = true;
            let exit = document.getElementById("exit");

            // Améliore les performance lors de la vidéo 'exit'
            document.getElementById("board-background").remove();

            exit.addEventListener('ended', () =>{window.location.href = "home.php";}, true);

            // Edge case où si on reviens en arrière sans avoir cliquer préalablement dans la fenêtre de jeu
            // la vidéo de fin ne joue pas.
            // C'est à cause de la protection du navigateur qui empêche de la jouer sans l'interraction de l'utilisateur.
            // Par conséquent, on reste prit dans game.php. 
            new Promise((resolve, reject) => {
                resolve(exit.play());
                reject(setTimeout(() =>{window.location.href = "home.php"}, 1000));
            });
        }
    }
    else {
        document.querySelector("main").style.visibility = "visible";
        loadingChat();
    }
}   

function catchingBackButtonEvent(global){
    // On override le hash de la page jusqu'à ce qu'on n'y retrouve que des '!'

    global.location.href += "#";
    global.setTimeout(() => {global.location.href += "!";}, 50);
    
	let loaded = 0;
    let _hash = "!";

    // Lorsque qu'un retour en arrière est appelé on intercepte et on fait jouer le vidéo 'exit'
    // Une fois la vidéo terminée on redirige à home.php
    global.onhashchange = () => {
        if (global.location.hash !== _hash && loaded < 5) {
            global.location.hash = _hash;
            loaded ++;
        }
        else {
            playVideo(videoSource.exit);
        }
    };
    //Source: 
    // https://stackoverflow.com/questions/12381563/how-can-i-stop-the-browser-back-button-using-javascript
    // Demo: https://output.jsbin.com/yaqaho#!
}

const loadingChat = () =>{
    // On load le chat après que la vidéo ait joué.

    document.getElementById("control-center").innerHTML = "";
    
    let div = document.createElement("div");
    div.id = "chat"
    div.innerHTML = document.querySelector("#chat-template").innerHTML;
    document.getElementById("control-center").append(div);
    
}

const splitWords = (str) =>{
    let regx = new RegExp('\\B.(?<=[A-Z])');
    if(regx.test(str)){
        let split = str.split(regx); //Résultat sans la lettre du split
        let whole = regx.exec(str) + split[1]; // Recombine le Résultat avec la lettre
        return split[0].concat(" ",whole); //recombine la string avec un espace en plus
    }
    else{
        return str;
    }
}

const endScreen = (state) =>{
    // Dim background
    for(let i = 1; i > 0.05;i -= 0.0001){
        document.querySelector("main").style.opacity = i;
    }    
    
    // Créer les élements textes 
    let main = document.querySelector("footer");

    let endScreen = document.createElement("div");
    let pressAKey = document.createElement("div");
    let classe = "endGame"

    endScreen.class = classe;
    // You lost
    if (state == "LAST_GAME_LOST"){
        endScreen.id = "youLost";
        endScreen.innerHTML = "Partie Perdue!";
        pressAKey.style.color = "rgb(182, 11, 11)";
        pressAKey.style.textShadow = "0 0 2rem #580f06";

    }
    // you won
    else {
        endScreen.id = "youWon";
        endScreen.innerHTML = "Partie Gagnée!";
        pressAKey.style.color = "rgb(11, 144, 11)";
        pressAKey.style.textShadow = "0 0 2rem  #0f5806";
    }
    // press a key
    pressAKey.innerHTML = "\n(cliquer pour quitter)";
    pressAKey.id = "pressAKey";
    pressAKey.class = classe;

    main.append(endScreen);
    main.append(pressAKey);

    // Ajout du events listeners
    document.onclick = () =>{endScreen.remove(); pressAKey.remove(); playVideo(videoSource.exit)};

}

const error = (message) => {
    //On enlève le message précédant s'il y a lieu
    let previousError = document.getElementById("game-error");
    if(previousError != null){
        previousError.parentNode.removeChild(previousError);
    }

    //On crée un message d'erreur
    let errorDiv =  document.createElement("div");
    errorDiv.className = "error-div";
    errorDiv.id = "game-error";
    errorDiv.innerHTML = message;
    // On l'ajoute au noeud '#opponent'
    document.getElementById("opponent").append(errorDiv)
    setTimeout(() =>{errorDiv.remove()}, 10000);
}