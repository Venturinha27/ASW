//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 

window.addEventListener("load", principal);

function principal(){ 
    
    addAcao();
    closeAcao();

}

function addAcao(){
    let botao = document.getElementById("addacao")
    let acaoform = document.getElementById("acaoform")

    botao.addEventListener("click", function(){
        acaoform.setAttribute("class", "w3-container w3-border w3-border-black w3-round visible")
    })
}

function closeAcao(){
    let botao = document.getElementById("closeActionForm")
    let acaoform = document.getElementById("acaoform")

    botao.addEventListener("click", function(){
        acaoform.setAttribute("class", "w3-container hidden")
    })
}