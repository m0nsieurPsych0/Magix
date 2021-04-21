
const state = () => {
    fetch("ajax.php", {   // Il faut créer cette page et son contrôleur appelle 
        method : "POST",       // l’API (games/state)
        credentials: "include"
    })
    .then(response => response.json())
    .then(data => {
    console.log(data); // contient les cartes/état du jeu.
    
    if(data == "WAITING"){
        console.log("I see waiting");
    }
    else if(data == "LAST_GAME_LOST"){
        window.location = "home.php";
    }
    else{
        game(data);
    }

    setTimeout(state, 1000); // Attendre 1 seconde avant de relancer l’appel
    })
}


window.addEventListener("load", () => {
    setTimeout(state, 1000); // Appel initial (attendre 1 seconde)
});

function game(data){
    //Exemple pour ajouter des éléments

    //document.createElement("div");
    // let div = document.createElement('div');
    // div.className = 'test';
    // let text = document.createTextNode('Test');
    // div.appendChild(text);
    // document.body.appendChild(div)
    
    document.querySelector(".player-time").innerHTML = "Temps: " + data.remainingTurnTime;
    document.querySelector(".player-hp").innerHTML = "HP:" + data.hp;


}


//Avec innerhtml appendchild removechild

// Source: https://www.gjtorikian.com/Earthbound-Battle-Backgrounds-JS/
function background() {
    
}