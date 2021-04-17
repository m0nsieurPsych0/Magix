  
window.addEventListener("load", () => {
    SetFocus();
    screenSaverTimeout();
    
})

// Met le username form field en focus
function SetFocus () {
    let input = document.getElementById("username");
    
    window.onload = () =>{
        input.focus();
    }
    
    window.onfocus = () => {
        input.focus();
    }
}