
window.addEventListener("load", () => {
  if(localStorage["booted"] != "true"){
    localStorage["booted"] = "true";
    window.location.href = "booting.php";
  }
  screenSaver();
  exitScreenSaver();
})

