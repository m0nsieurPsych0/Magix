
window.addEventListener("load", () => {
    setTimeout(state(), 1000); // Appel initial (attendre 1 seconde)
    
});

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
    else if(data == "LAST_GAME_LOST" || data == "LAST_GAME_WON" ){
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

    if(send[0] == "END_TURN"){
        attack(send[0]);
    }
    if(send[0] == "PLAY"){
        console.log("I see PLAY");
        formData.append("type", send[0])
        formData.append("uid", send[1])
    }
    else if(send[0] == "ATTACK"){
        console.log("I see ATTACK");
        formData.append("type", send[0]);
        formData.append("uid", send[1]);
        formData.append("targetuid", send[2]);
    }
    else{
        formData.append("type", send);
    }
        console.log(formData);
    fetch("ajax.php", {   // Il faut créer cette page et son contrôleur appelle
        method : "POST",       // l’API (games/state)
        credentials: "include",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // game(data);
        console.log('then');
        console.log(data);

    })
}

// GLOBAL VARIABLES
let cardDestination = [
    {
        htmlDestination : "players-hand", 
        dataRoot: "",//data.hand, 
        className: "players-hand",
        functionCall: "gameAction(['PLAY', this.id]);"
    },
    {
        htmlDestination : "players-board", 
        dataRoot: "", //data.board, 
        className: "players-card",
        functionCall: "attack([this.className, this.id]);"
    },
    {
        htmlDestination : "opponent-board", 
        dataRoot: "", //data.opponent.board, 
        className: "opponent-card",
        functionCall: "attack([this.className, this.id]);"
    },

];

const game = (data) => {

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


    cardDestination.map(elem => {
        // console.log(elem);
        switch(elem.htmlDestination){
            case "players-hand": elem.dataRoot = data.hand; break;
            case "players-board": elem.dataRoot = data.board; break;
            case "opponent-board": elem.dataRoot = data.opponent.board; break;
        }
        createCard(elem);
	});
    

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

// TODO Change for Map()
let Accumulator = [];
const attack = (data) =>{
    console.log(data);
        
    if (data[0] == "players-card"){
        console.log("clicked players card");
        Accumulator[1] = data[1];
    }
    else if(Accumulator[1] != null && data[0] == "opponent-card" || Accumulator[1] != null && data[0] == "hero"){
        console.log("clicked opponents card");
        Accumulator[2] = data[1];
        Accumulator[0] = 'ATTACK';
        console.log(Accumulator);
        gameAction(Accumulator);
        Accumulator = [];
    }
    else if(data == "END_TURN"){
        Accumulator = [];
        console.log("reset accumulator");
    }

    
}
// Source: https://www.gjtorikian.com/Earthbound-Battle-Backgrounds-JS/
function background() {

}