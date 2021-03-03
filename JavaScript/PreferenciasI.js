window.addEventListener("load", principal);

function principal(){ 
    
    addAcao();

}

function addAcao(){
    let botao = document.getElementById("addacao")
    let acaoform = document.getElementById("acaoform")

    botao.addEventListener("click", function(){
        acaoform.setAttribute("class", "w3-container w3-border w3-border-black w3-round visible")
    })
}
