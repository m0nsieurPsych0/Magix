
window.addEventListener("load", () => {
    SetFocus();
    screenSaverTimeout();
})

// Met le premier form field en focus
function SetFocus () {
    let input = document.getElementById("username");
    input.focus();
    // let input = document.getElementsByClassName("form-input");
    // input[0].focus();
    window.onfocus = () => {
        input.focus();
    }
}
function screenSaverTimeout () {
    //TODO si une touche est pesé redémarrer le compteur
    
    active = true;
    if (active){
        setTimeout(gotoindex, 5000);
    }
}

function gotoindex () {
    destination = "index.php";
    window.location = destination;
}