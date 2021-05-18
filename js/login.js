window.addEventListener("load", () => {
    if(localStorage["booted"] != "true"){
        localStorage["booted"] != "true"
        window.location.href = "booting.php";
    }
    screenSaverTimeout("home.php");
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