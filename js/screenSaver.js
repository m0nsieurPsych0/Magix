
let timer = 300000; // 5 minutes
// let timer = 5000; // 5 secondes pour test
let active = true; // TODO User settings
let timeout = null;


function screenSaverTimeout () {
    timeout = setTimeout(() => {
        destination = "index.php"; //screensaver's page
        window.location = destination;
        
    }, timer);
    document.onclick = () =>{
        clearTimeout(timeout);
        screenSaverTimeout();}
    document.onkeyup  = () =>{
        clearTimeout(timeout);
        screenSaverTimeout();
    }
    document.onmousemove  = () =>{
        clearTimeout(timeout);
        screenSaverTimeout();
    }
}