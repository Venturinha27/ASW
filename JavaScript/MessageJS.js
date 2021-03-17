//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal() {
    let men = document.getElementById("openMensagens")
    let mdiv = document.getElementById("MessageDiv")
    let head = document.getElementById("AzulDiv")
    let bod = document.getElementById("BodyDiv")
    if (sessionStorage.getItem("MessageBar") != "Open"){
        mdiv.setAttribute("class", "w3-sidebar hidden")
        men.setAttribute("class", "divClosed")
        head.style.left = "15%"
        bod.style.left = "15%"
        sessionStorage.setItem("MessageBar", "Closed")

    } else {
        mdiv.setAttribute("class", "w3-sidebar visible")
        men.setAttribute("class", "divOpen")
        head.style.left = "0%"
        bod.style.left = "0%"
        sessionStorage.setItem("MessageBar", "Open")
    }
    clickM();
}

function clickM() {
    let men = document.getElementById("openMensagens")
    let mdiv = document.getElementById("MessageDiv")
    let head = document.getElementById("AzulDiv")
    let bod = document.getElementById("BodyDiv")
    men.addEventListener("click", function() {
        //if (mdiv.getAttribute("class") == "w3-sidebar hidden"){
        if (sessionStorage.getItem("MessageBar") != "Open"){
            mdiv.setAttribute("class", "w3-sidebar visible")
            men.setAttribute("class", "divOpen")
            head.style.left = "0%"
            bod.style.left = "0%"
            sessionStorage.setItem("MessageBar", "Open")
        } else {
            mdiv.setAttribute("class", "w3-sidebar hidden")
            men.setAttribute("class", "divClosed")
            head.style.left = "15%"
            bod.style.left = "15%"
            sessionStorage.setItem("MessageBar", "Closed")
        }
    });
}