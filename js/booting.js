const isBooted = () => {
    if (localStorage["booted"] == null || localStorage["booted"] == "false" ){
        //booting sequence
    }
    else{
        window.location.href = "login.php";
    }
}

const bootingAnimation = () => {

    let boot =  document.createElement("div");
    document.main.append(boot);
}