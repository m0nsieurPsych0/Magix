window.addEventListener("load", () => {
    document.getElementById("chatIframe").style.opacity = 0;
    document.getElementById("toggle").innerHTML = "Afficher le chat";
});

const hideShowChat = () => {
    let iframe = document.getElementById("chatIframe");
    let button = document.getElementById("toggle");

    if(iframe.style.opacity == 1){
        iframe.style.opacity = 0;
        button.innerHTML = "Afficher le chat";
    }
    else{
        iframe.style.opacity = 1;
        button.innerHTML = "Cacher le chat";
    }   
}