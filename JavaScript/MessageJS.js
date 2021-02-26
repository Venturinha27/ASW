window.addEventListener("load", principal);

function principal() {
    clickM();
}

function clickM() {
    let men = document.getElementById("openMensagens")
    let mdiv = document.getElementById("MessageDiv")
    let head = document.getElementById("AzulDiv")
    let bod = document.getElementById("BodyDiv")
    men.addEventListener("click", function() {
        if (mdiv.getAttribute("class") == "w3-sidebar hidden"){
            mdiv.setAttribute("class", "w3-sidebar visible")
            men.setAttribute("class", "divOpen")
            head.style.left = "0%"
            bod.style.left = "0%"
        } else {
            mdiv.setAttribute("class", "w3-sidebar hidden")
            men.setAttribute("class", "divClosed")
            head.style.left = "15%"
            bod.style.left = "15%"
        }
    });
}