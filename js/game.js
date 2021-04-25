
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

    createCard(data);
    createPlayersHand(data);
}

const createCard = (data) =>{
    let template = document.querySelector("#card-template").innerHTML;
    
    let opponentsCard = data.opponent.board;
    document.getElementById("opponent-board").innerHTML = "";

    for (let i = 0; i < opponentsCard.length; i++){
        let div = document.createElement("button");
        div.className = "opponent-card";
        div.innerHTML = template;
        div.id = opponentsCard[i]["uid"];
        for (key in opponentsCard[i]){
            // div.setAttribute("onclick", "gameAction(['PLAY'," + hand[i]['uid'] + "]);");
            div.querySelector("."+key).innerText = key + " " +  opponentsCard[i][key];
            // console.log(key + " " +  opponentsCard[i][key]);
            // console.log(opponentsCard[i]);
            
        }
        // div.id = opponentsCard[i]["uid"];
        div.setAttribute("onclick", "attack([this.className, this.id]);");
        document.getElementById("opponent-board").append(div);
    }

    let playersCard = data.board;
    document.getElementById("players-board").innerHTML = "";
    for (let i = 0; i < playersCard.length; i++){
        let div = document.createElement("button");
        div.className = "players-card";
        div.innerHTML = template;
        div.id = playersCard[i]["uid"];
        for (key in playersCard[i]){
            div.querySelector("."+key).innerText = key + " " +  playersCard[i][key];
            // console.log(key + " " +  opponentsCard[i][key]);
            // console.log(opponentsCard[i]);
            
        }
        div.setAttribute("onclick", "attack([this.className, this.id]);");
        document.getElementById("players-board").append(div);
    }
}

const createPlayersHand = (data) =>{
    let hand = data.hand;
    // console.log(hand);

    document.getElementById("players-hand").innerHTML = "";
    let template = document.querySelector("#card-template").innerHTML;

    for (let i = 0; i < hand.length; i++){
        let div = document.createElement("button");
        div.id = hand[i]["uid"];
        div.className = "players-hand";
        div.innerHTML = template;

        for (key in hand[i]){
            div.setAttribute("onclick", "gameAction(['PLAY'," + hand[i]['uid'] + "]);");
            div.querySelector("."+key).innerText = key + " " +  hand[i][key];            
        }
        
        document.getElementById("players-hand").append(div);
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
    else if(Accumulator[1] != null && data[0] == "opponent-card" || data[0] == "hero"){
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