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