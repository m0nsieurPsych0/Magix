window.addEventListener("load", () => {
    SetFocus();
})

function SetFocus () {
    window.onfocus = () =>{
        document.getElementById("username").focus();
    }
    document.getElementById("username").focus();
}