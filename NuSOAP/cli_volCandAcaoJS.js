//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 

window.addEventListener("load", principal);

function principal(){ 
    
    submitCand()

}

function submitCand() {
    let sub = document.getElementById("submitcand")

    sub.addEventListener("click", function() {
        
        let idvol = document.getElementById("inputidvol").value
        let utilizador = document.getElementById("inpututilizador").value
        let password = document.getElementById("inputpassword").value
        let idacao = document.getElementById("inputidacao").value

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("resposta").innerHTML = this.responseText
            }
        };
        xmlhttp.open("POST", "../NuSOAP/cli_volCandAcao_controller.php?idvol="+idvol+"&utilizador="+utilizador+"&password="+password+"&idacao="+idacao, true);
        xmlhttp.send();  
    })
}