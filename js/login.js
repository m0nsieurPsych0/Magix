window.addEventListener("load", () => {
    screenSaverTimeout();
    loadUsername();
    SetFocus();
})

const loadUsername = () => {
    if (localStorage["Username"] != null){
        document.getElementById("username").value = localStorage["Username"];
    }
}

function SetFocus () {
    window.onfocus = () =>{
        if (document.getElementById("username").value != ""){
            document.getElementById("password").focus();    
        }
        else {
            document.getElementById("username").focus();
        }
    }
}