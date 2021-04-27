// Initialise une fonction qui va intercepter le retour en arrière du navigateur
// Lorsqu'on capte un retour en arrière on appel la fonction de vidéo 'exit'
(function(global) {catchingBackButtonEvent(global);})(window);

window.addEventListener("load", () => {
    playVideo(videoSource.enter); // video intro
    resetAccumulator(); // initialisé la variable Accumulator
    setTimeout(gameState(), 1000); // Appel initial (attendre 1 seconde)
});

// GLOBAL VARIABLES *****************************************
let cardDestination = [
    {
        htmlDestination : "players-hand", 
        dataRoot: "",//data.hand, 
        className: "players-hand",
        functionCall: "gameAction({type: 'PLAY', uid: this.id});"
    },
    {
        htmlDestination : "players-board", 
        dataRoot: "", //data.board, 
        className: "players-card",
        functionCall: "attack({nom: this.className, uid: this.id});"
    },
    {
        htmlDestination : "opponent-board", 
        dataRoot: "", //data.opponent.board, 
        className: "opponent-card",
        functionCall: "attack({nom: this.className, uid: this.id});"
    },

];

const videoSource = {
    enter: String.raw`<source src="asset\video\enter_door1080p60Med.mp4" type="video/mp4">`,
    exit: String.raw`<source src="asset\video\exit_door1080p60Med.mp4">`
};

let Accumulator;

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

    switch(data){
        case "WAITING": 
            console.log("I see waiting"); 
            break;
        case "LAST_GAME_LOST":
        case "LAST_GAME_WON" :
        case "GAME_NOT_FOUND":
        case "":
        case null: 
            window.location.href = "game.php#!!";
            // history.go(-1);
            break;
        default:
            game(data);
    }
    
    setTimeout(gameState, 1000); // Attendre 1 seconde avant de relancer l’appel
    })
}

const gameAction = (send) =>{
    console.log(send);

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
        console.log(data);

    })
}

const game = (data) => {

    updateGameData(data);

    cardDestination.map(elem => {
        switch(elem.htmlDestination){
            case "players-hand": elem.dataRoot = data.hand; break;
            case "players-board": elem.dataRoot = data.board; break;
            case "opponent-board": elem.dataRoot = data.opponent.board; break;
        }
        createCards(elem);
	});
    
}

const updateGameData = (data) =>{
    // player data
    let player = document.getElementById("player-wrapper").children;
    for (let i = 0; i < player.length; i++){
        let current = player[i].attributes["class"].value;
        if(current == "player-endTurn" || current == "hand" || current == "heroPower"){
            continue;
        }
        document.querySelector("." + current + "#player").innerHTML = current + ": " + data[current];
    }   
    // opponent data
    let opponent = document.getElementById("opponent-wrapper").children;
    for (let i = 0; i < opponent.length; i++){
        let current = opponent[i].attributes["class"].value;
        if(current == "hero"){
            continue;
        }

        document.querySelector("." + current + "#opponent").innerHTML = current + ": " + data["opponent"][current];
    }
}

const createCards = (target) => {

    document.getElementById(target.htmlDestination).innerHTML = "";
    
    for (let i = 0; i < target.dataRoot.length; i++){
        let div = document.createElement("button");
        div.id = target.dataRoot[i]["uid"];
        div.className = target.className;
        div.innerHTML = document.querySelector("#card-template").innerHTML;

        for (key in target.dataRoot[i]){
            div.querySelector("."+key).innerText = key + " " +  target.dataRoot[i][key];            
        }
        div.setAttribute("onclick", target.functionCall);
        document.getElementById(target.htmlDestination).append(div);
    }

}

const attack = (data) =>{
    console.log(data);

    switch(data.nom){
        case "players-card":
            console.log("clicked players card"); 
            Accumulator.source = data.uid; 
            break;
        case "hero": console.log("clicked opponents Hero");
        case "opponent-card": 
            
            if(Accumulator.source != null){
                console.log("clicked opponents card");
                Accumulator.destination = data.uid;
                console.log(Accumulator);
                gameAction(Accumulator);
                resetAccumulator(); 
            }
    }
}

// Source: https://www.gjtorikian.com/Earthbound-Battle-Backgrounds-JS/
function background() {

}

function playVideo(source) {
    
    let body = document.body;
    let video = document.createElement("video");
    video.id = source == videoSource.enter ? "enter" : "exit";
    video.setAttribute("onloadedmetadata","this.muted=true"); // Wow. ça c'est sneaky!! Sources: https://stackoverflow.com/questions/51464647/html5-video-doesnt-autoplay-even-while-muted-in-chrome-67-using-angular
    video.setAttribute("autoplay", "");
    video.innerHTML = source;
    body.append(video);

    if (source == videoSource.enter){
        let enter = document.getElementById("enter");
        enter.addEventListener('ended', ()=>{video.remove()}, true );
        enter.playbackRate = 1.50;
    }
    else{
        
        let exit = document.getElementById("exit");
        exit.addEventListener('ended', function(){window.location.href = "home.php";}, true);
        exit.play();
    }
}


function catchingBackButtonEvent(global){
    // On override le hash de la page jusqu'à ce qu'on n'y retrouve que des '!'

    global.location.href += "#";
    global.setTimeout(function () {
        global.location.href += "!";
    }, 50);
    
	let loaded = 0;
    let _hash = "!";

    // Lorsque qu'un retour en arrière est appelé on intercepte et on fait jouer le vidéo 'exit'
    // Une fois la vidéo terminée on redirige à home.php
    global.onhashchange = function () {
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
