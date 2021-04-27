//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 

window.addEventListener("load", principal);

function principal(){ 
    
    searchAcoesIns()

}

function searchAcoesIns() {
    let sub = document.getElementById("submitins")

    sub.addEventListener("click", function() {
        let id = document.getElementById("inputins").value
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("tabela").innerHTML = this.responseText
            }
        };
        xmlhttp.open("POST", "../NuSOAP/cli_infoAcaoVol_controller.php?idins="+id, true);
        xmlhttp.send();  
    })
}

