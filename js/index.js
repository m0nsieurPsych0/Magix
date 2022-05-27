
window.addEventListener("load", () => {
  if(localStorage["booted"] != "true"){
    localStorage["booted"] = "false";
    window.location.href = "booting.php";
  }
  screenSaver();
  exitScreenSaver();
})

