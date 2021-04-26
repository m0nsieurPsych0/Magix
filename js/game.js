
window.addEventListener("load", () => {
    resetAccumulator();
    setTimeout(state(), 1000); // Appel initial (attendre 1 seconde)
    
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

const state = () => {
    fetch("ajax.php", {   // Il faut créer cette page et son contrôleur appelle
        method : "POST",       // l’API (games/state)
        credentials: "include",
    })
    .then(response => response.json())
    .then(data => {
    // console.log(data); // contient les cartes/état du jeu.

    if(data == "WAITING"){
        console.log("I see waiting");
    }
    else if(data == "LAST_GAME_LOST" || data == "LAST_GAME_WON" || data == null){
        window.location = "home.php";
    }
    else{
        game(data);
    }

    setTimeout(state, 1000); // Attendre 1 seconde avant de relancer l’appel
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

    //Ajax request
    console.log(formData);
    fetch("ajax.php", {   // Il faut créer cette page et son contrôleur appelle
        method : "POST",       // l’API (games/state)
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
        createCard(elem);
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

const createCard = (target) => {

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
        case "hero":
        case "opponent-card": 
            
            console.log("clicked opponents Hero");
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