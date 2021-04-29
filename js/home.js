window.onload = () => {
    screenSaverTimeout();
}

window.addEventListener("load", () => {
    applyStyles();
    // TODO: KbControl();
})

function KbControl() {
    // TODO
}

// On sauvegarde le nom d'utilisateur dans LocalStorage
function saveUsername(username) {
    if (username != null){
        localStorage["Username"] = username;
    }
}
