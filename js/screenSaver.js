
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

function exitScreenSaver() {
    //Lorsqu'on sort du screensaver tente d'accéder à home et 
    //on laisse php s'occuper de vérifier si on est authentifié ou pas.
    destination = "home.php"; 
    document.onkeyup = () =>{window.location = destination;}
    document.onclick = () =>{window.location = destination;}
  }
  
  function screenSaver() {
    // Modifiers
    let speedMult = 0.01; // Vitesse de défilement des étoiles
    let maxStars = 200;    // Nombre d'étoiles au maximum
    let starSize = 100;    // Taille des étoiles (plus le nombre est élevé plus l'étoile est petite)(default 128)
  
  
    // Variables
    let starField = [];
    let starCounter = 0;
    let xTrajecMod = 0;
    let yTrajecMod = 0;
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
      
      // TODO TODO TODO Changer le calcul de direction pour qu'il soit un pourcentage entre -10 <-> 0 <-> 10
      // tailleMax/2 *.10 = 10% de la moitié de la taille 
      // 
      // donc le cadran du haut-gauche max = -10x et -10y
      // plus on approche le centre
      mousePos() {
        // selon le cadran où se trouve le curseur on déplace les étoiles dans cette direction
        onmousemove = function(e){
          // dépendemment de la position du curseur on varie la vitesse 
          // Plus le curseur s'éloigne du centre plus l'angle de vue est intense.
          let low = 0;
          let hi = 1;
          let trajectIntensity = [5, 10];
          let posx = e.clientX;
          let posy = e.clientY;
          let midx = innerWidth/2;
          let midy = innerHeight/2;
          let midx_sub = [midx/8, midx/2];
          let midy_sub = [midy/8, midy/2];
          
          // quadran 1 (haut gauche)
          if (posx <= midx && posy <= midy){
            if(posx <= (midx - midx_sub[hi]) && posy <= (midy - midy_sub[hi])){
              xTrajecMod = -trajectIntensity[hi];
              yTrajecMod = -trajectIntensity[hi];
            }
            else if(posx <= (midx - midx_sub[low]) && posy <= (midy - midy_sub[low])){
              xTrajecMod = -trajectIntensity[low];
              yTrajecMod = -trajectIntensity[low];
            }
            else {//centre
              xTrajecMod = 0;
              yTrajecMod = 0;
            }
          }
          // quadran 2 (haut droite)
          else if(posx >= midx && posy <= midy){
            if(posx >= (midx + midx_sub[hi]) && posy <= (midy - midy_sub[hi])){
              xTrajecMod = trajectIntensity[hi];
              yTrajecMod = -trajectIntensity[hi];
            }
            else if(posx >= (midx + midx_sub[low]) && posy <= (midy - midy_sub[low])){
              xTrajecMod = trajectIntensity[low];
              yTrajecMod = -trajectIntensity[low];
            }
            else {//centre
              xTrajecMod = 0;
              yTrajecMod = 0;
            }          
          }
          // quadran 3 (bas gauche)
          else if (posx <= midx && posy >= midy){
            if (posx <= (midx - midx_sub[hi]) && posy >= (midy + midy_sub[hi])){
              xTrajecMod = -trajectIntensity[hi];
              yTrajecMod = trajectIntensity[hi];
            }
            else if (posx <= (midx - midx_sub[low]) && posy >= (midy + midy_sub[low])){
              xTrajecMod = -trajectIntensity[low];
              yTrajecMod = trajectIntensity[low];
            }
            else {//centre
              xTrajecMod = 0;
              yTrajecMod = 0;
            }
          }
          // quadran 4 (bas droite)
          else if (posx >= midx && posy >= midy){
            if (posx >= (midx + midx_sub[hi]) && posy >= (midy + midy_sub[hi])){
              xTrajecMod = trajectIntensity[hi];
              yTrajecMod = trajectIntensity[hi];
            }
            else if (posx >= (midx + midx_sub[low]) && posy >= (midy + midy_sub[low])){
              xTrajecMod = trajectIntensity[low];
              yTrajecMod = trajectIntensity[low];
            }
            else { //centre
              xTrajecMod = 0;
              yTrajecMod = 0;
            }
          }
        }
        onmouseout = () =>{
          //centre
          xTrajecMod = 0;
          yTrajecMod = 0;
        }
      }
      
      updatePos() {
  
        this.mousePos();
        
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
      
      //Apparence des étoiles
      ctx.fillRect(0,0,innerWidth,innerHeight);
     
      for (let i = 0; i < starField.length; i++) {
        ctx.fillStyle = "rgb(" + starField[i].myColor + "," + starField[i].myColor + "," + starField[i].myColor + ")";
        ctx.fillRect(starField[i].myX,starField[i].myY,starField[i].myColor / starSize,starField[i].myColor / starSize);
        starField[i].updatePos();
      }
      window.requestAnimationFrame(draw);
    }
  
    init();
    // Source: https://codepen.io/acarva1/pen/GgbgLe
  }