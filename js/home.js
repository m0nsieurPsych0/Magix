window.onload = () => {
    screenSaverTimeout();
}

window.addEventListener("load", () => {
    // applyStyles();
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
    console.log(infoValue);
    

    for(let key in infoValue){
        // console.log( key + infoValue[key]);
        let li = document.createElement("li");
        li.innerHTML = key + infoValue[key];
        document.getElementById("log").append(li);
    }

}