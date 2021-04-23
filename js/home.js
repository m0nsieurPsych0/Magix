const applyStyles = iframe => {
	let styles = {
		fontColor: "#FFF",
        fontGoogleName: "Inconsolata",
        backgroundColor : "rgba(0,0,0,0)",
        fontSize:"clamp(1.0rem, 0.767rem + 0.93vw, 3.0rem)",
        inputBackgroundColor:"white",
        inputFontColor:"black",
        hideIcons: true,
        
	}

	iframe.contentWindow.postMessage(JSON.stringify(styles), "*");	
}

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
function saveUsername(username) {
    if (username != null){
        localStorage["Username"] = username;
    }
}
