
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
    // console.log(send);
    let formData = new FormData();

    formData.append("type", send);
    // console.log(formData);
    fetch("ajax.php", {   // Il faut créer cette page et son contrôleur appelle
        method : "POST",       // l’API (games/state)
        credentials: "include",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // game(data);
        // console.log('then');
        // console.log(data);

    })
}

window.addEventListener("load", () => {
    setTimeout(state(), 1000); // Appel initial (attendre 1 seconde)

});

const game = (data) => {
   
    // player data
    let player = document.getElementById("player-wrapper").children;
    for (let i = 0; i < player.length; i++){
        let current = player[i].attributes["class"].value;
        if(current == "player-endTurn" || current == "hand"){
            continue;
        }
        document.querySelector("." + current + "#player").innerHTML = current + ": " + data[current];
    }   
    // opponent data
    let opponent = document.getElementById("opponent-wrapper").children;
    for (let i = 0; i < opponent.length; i++){
        let current = opponent[i].attributes["class"].value;

        document.querySelector("." + current + "#opponent").innerHTML = current + ": " + data["opponent"][current];
    }

    let playersHand = data.hand;
    let playersCard = data.board;

    createCard(data);
    createPlayersHand(data);

}

const createCard = (data) =>{
    let opponentsCard = data.opponent.board;

    document.getElementById("opponent-board").innerHTML = "";
    let template = document.querySelector("#card-template").innerHTML;

    for (let i = 0; i < opponentsCard.length; i++){
        let div = document.createElement("button");
        div.className = "opponent-card";
        div.innerHTML = template;

        for (key in opponentsCard[i]){
            // if (div.querySelector(key))
            div.querySelector("#"+key).innerText = key + " " +  opponentsCard[i][key];
            // console.log(key + " " +  opponentsCard[i][key]);
            // console.log(opponentsCard[i]);
            
        }
        document.getElementById("opponent-board").append(div);
    }
}

const createPlayersHand = (data) =>{
    let hand = data.hand;
    // console.log(hand);

    document.getElementById("players-hand").innerHTML = "";
    let template = document.querySelector("#card-template").innerHTML;

    for (let i = 0; i < hand.length; i++){
        let div = document.createElement("button");
        div.className = "players-hand";
        div.innerHTML = template;

        for (key in hand[i]){
            div.querySelector("#"+key).innerText = key + " " +  hand[i][key];            
        }
        document.getElementById("players-hand").append(div);
    }

}


// Source: https://www.gjtorikian.com/Earthbound-Battle-Backgrounds-JS/
function background() {

}