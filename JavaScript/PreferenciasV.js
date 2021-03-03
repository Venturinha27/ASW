window.addEventListener("load", principal);

function principal(){ 
    
    //addArea();

}

function addArea(){
    numAreas = 1
    let listaButoes = document.getElementsByClassName("areab")
    let listaArea = document.getElementsByClassName("area")
    let listaSela = document.getElementsByClassName("w3-select sela")

    // Adicionar
    listaButoes[0].addEventListener("click", function(){
    
        numAreas++
        if (numAreas < 4) {

            //<div class="area">
            let diva = document.createElement("div")
            diva.setAttribute("class", "area")
            document.getElementById("areas").appendChild(diva)
        
            //<select class="w3-select sel" name="area-interesse">
            let sela = document.createElement("select")
            sela.setAttribute("class", "w3-select sela")
            sela.setAttribute("name", "area-interesse")
            listaArea[listaArea.length - 1].appendChild(sela)
        
            //<option value="" disabled selected>Selecione uma área de interesse</option>
            let optiona1 = document.createElement("option")
            optiona1.setAttribute("value", "")
            listaSela[listaSela.length - 1].appendChild(optiona1)
            optiona1.innerText = "Selecione uma área de interesse"
            optiona1.disabled = true;
            optiona1.selected = true;

            //<option value="acao-social">Ação social</option>
            let optiona2 = document.createElement("option")
            optiona2.setAttribute("value", "acao-social")
            listaSela[0].appendChild(optiona2)
            optiona2.innerText = "Ação social"

            //<option value="educacao">Educação</option>
            let optiona3 = document.createElement("option")
            optiona3.setAttribute("value", "educacao")
            listaSela[0].appendChild(optiona3)
            optiona3.innerText = "Educação"

            //<option value="saude">Saúde</option>
            let optiona4 = document.createElement("option")
            optiona4.setAttribute("value", "saude")
            listaSela[0].appendChild(optiona4)
            optiona4.innerText = "Saúde"

            //<button class="w3-button w3-circle w3-green w3-hover-black w3-tiny w3-padding-small areab">+</button>
            let buttona = document.createElement("button")
            buttona.setAttribute("class", "w3-button w3-circle w3-red w3-hover-black w3-tiny w3-padding-small areab")
            listaArea[listaArea.length - 1].appendChild(buttona)
            buttona.innerText = "-"
            buttona.style.marginLeft = "0.9%"
        }

    })

    // REMOVER
    for (let i = 1; i < listaButoes.length; i++){
        listaButoes[i].addEventListener("click", function(){
            console.log("ola");
            console.log(listaArea[i]);
        })
    }
}
