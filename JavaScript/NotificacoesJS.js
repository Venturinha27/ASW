//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 

window.addEventListener("load", principal);

function principal(){ 
    
    

}

function showNotificacoes() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("notificacoesdiv").setAttribute("class", "visible")
            document.getElementById("notificacoesdiv").innerHTML = this.responseText
        }
    }
    xmlhttp.open("POST", "../Controller/NotificacoesController.php?notificacoes=yes", true);
    xmlhttp.send();
}

function hideNotificacoes() {
    document.getElementById("notificacoesdiv").setAttribute("class", "hidden")
            
}