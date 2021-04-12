
window.addEventListener("load", () => {
    SetFocus();
})

// Met le premier form field en focus
function SetFocus () {
    let input = document.getElementById("username");
    input.focus();
}