let canvas = null;
let ctx = null;
let letterList = [];

window.addEventListener("load", ()=>{
    isBooted();

})

const bootingAnimation = () => {

    canvasConstructor();
    canvasSize();

    ctx.font = "clamp(1.5rem, 1.326rem + 0.698vw, 3.0rem) inconsolata, monospace";
    ctx.fillStyle = "white";
    let word = "Booting |\\/|agix__OS";
    let x = canvas.width/2 - 600;

    for(let i = 0; i < word.length; i++){
        word.charAt(i);
        letterList.push(new Letter(word.charAt(i), x, 30));
        x += 30;
    }
    tick();
    
}
const tick = () =>{
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    type();

}


class Letter {
    constructor(letter, x) {
        this.letter = letter; 
        this.x = x;
        
    }
    tick() {
        ctx.fillText(this.letter, this.x, canvas.height/2);
    }

}

const type = () =>{
    let i =0;
    const interval = setInterval(()=>{
        if(i< letterList.length){
            const letter = letterList[i];
            letter.tick();
            i++;
        }
        else{
            clearTimeout(interval);
            return;
        } 
    }, 250)
    
}




const canvasSize = () =>{
    canvas.width = innerWidth;
    canvas.height = innerHeight;

    //Si on change la taille de la fenêtre
    window.onresize = () =>{
        canvas.width = innerWidth;
        canvas.height = innerHeight;
    };

}
const canvasConstructor = () =>{
    canvas = document.getElementById("myCanvas");
    ctx = canvas.getContext("2d");
}

const isBooted = () => {
    if (localStorage["booted"] == null || localStorage["booted"] == "false"  || localStorage["booted"] == undefined || localStorage["booted"] == "undefined"){
        localStorage["booted"] = "true";
        bootingAnimation();
        setTimeout(()=>{window.location.href = "home.php"}, 7000);
    }
    else{
        window.location.href = "home.php";
    }
}