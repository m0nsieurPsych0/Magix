// source: https://codepen.io/acarva1/pen/GgbgLe

window.addEventListener("load", () => {
  screenSaver();
  exitScreenSaver();
  
})

function floatingText() {
  let text = document.getElementsByClassName("typing");

}

function exitScreenSaver() {
  destination = "login.php";
  node = document.getElementById("myCanvas");

  node.onclick = () => {window.location = destination;}
  document.onkeyup = () =>{window.location = destination;}
}

function screenSaver() {
  // Modifiers
  let speedMult = 0.005; // Vitesse de défilement des étoiles
  let maxStars = 250     // Nombre d'étoiles au maximum
  let xTrajecMod = 0;    // Modifie la trajectoire
  let yTrajecMod = 0;    // À '0' les étoiles arrive directement en face

  // Variables
  let starField = [];
  let starCounter = 0;

  // Sélectionne le canvas du html
  let myCanvas = document.getElementById("myCanvas");
  let ctx = myCanvas.getContext("2d");
  

  
  // Change la taille du canevas en rapport à la taille de fenêtre
  myCanvas.width = innerWidth;
  myCanvas.height = innerHeight;
  
  // Si on détecte un changement de taille on réajuste la taille du canevas
  window.onresize = function(){
    myCanvas.width = innerWidth;
    myCanvas.height = innerHeight;
  };
  
  class Star {
    constructor() {
      // Génère un emplacement aléatoire pour les étoiles
      this.myX = Math.random() * innerWidth;
      this.myY = Math.random() * innerHeight;
      this.myColor = 0;
    }
    
    updatePos() {
      this.myX += xTrajecMod + (this.myX - (innerWidth / 2)) * (speedMult);
      this.myY += yTrajecMod + (this.myY - (innerHeight / 2)) * (speedMult);
      this.updateColor();

      if (this.myX > innerWidth || this.myX < 0) {
        this.myX = Math.random() * innerWidth;
        this.myColor = 0;
      }
      if (this.myY > innerHeight || this.myY < 0) {
        this.myY = Math.random() * innerHeight;
        this.myColor = 0;
      }

    }
    updateColor() {
      if (this.myColor < 255) {
        this.myColor += 5;
      }
      else {
        this.myColor = 255;
      }
    }
  }
  
  
  while (starCounter < maxStars) {
    let newStar = new Star;
    starField.push(newStar);
    starCounter++;
  }
  
  function init() {
    myCanvas.focus();
    window.requestAnimationFrame(draw);
  }
  
  function draw() {
    // Apparence du fond
    ctx.fillStyle = "rgba(0,0,0,0.2)";
     // Pour modifier le fond en gradient
    // ctx.fillStyle = ctx.createRadialGradient(238, 50, 10, 238, 50, 300);
    
    //Apparence des étoiles
    ctx.fillRect(0,0,innerWidth,innerHeight);
   
    for (let i = 0; i < starField.length; i++) {
      ctx.fillStyle = "rgb(" + starField[i].myColor + "," + starField[i].myColor + "," + starField[i].myColor + ")";
      ctx.fillRect(starField[i].myX,starField[i].myY,starField[i].myColor / 128,starField[i].myColor / 128);
      starField[i].updatePos();
    }
    window.requestAnimationFrame(draw);
  }

  init();
}

