const applyStyles = iframe => {
	let styles = {
		fontColor: "#FFF",
        fontGoogleName: "Inconsolata",
        backgroundColor : "rgba(0,0,0,0)",
        fontSize:"clamp(1.5rem, 1.326rem + 0.698vw, 3.0rem)",
        inputBackgroundColor:"white",
        inputFontColor:"black",
        hideIcons: true,
	}
	
	setTimeout(() =>{
        iframe.contentWindow.postMessage(JSON.stringify(styles), "*")
    }, 200);
}