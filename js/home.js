window.onload = () => {
    screenSaverTimeout();
}

window.addEventListener("load", () => {    
    // TODO: KbControl();
})

function KbControl() {
    // TODO
}

// On sauvegarde le nom d'utilisateur dans LocalStorage
const saveUsername = (username) => {
    if (username != null){
        localStorage["Username"] = username;
    }
}

const systemMessage = (infoValue) =>{
    for(let key in infoValue){
        let li = document.createElement("li");
        li.innerHTML = key + infoValue[key];
        document.getElementById("log").append(li);
    }

}