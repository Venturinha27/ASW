//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal() {
    openfilter();
}

function openfilter(){
    document.getElementById('filterb').addEventListener("click", function(){
        let divf = document.getElementById('divFiltrar')
        let voldiv = document.getElementById('VolDiv')
        let filterb = document.getElementById('filterb')
        if (divf.getAttribute("class") == "w3-container w3-small hidden"){
            divf.setAttribute("class", "w3-container w3-small visible")
            voldiv.style.marginTop = "82%";
            filterb.innerHTML = "<i class='fas fa-filter'></i> &nbsp Filtrar &nbsp <i class='fas fa-angle-up'></i>";
        } else {
            divf.setAttribute("class", "w3-container w3-small hidden")
            voldiv.style.marginTop = "46%";
            filterb.innerHTML = "<i class='fas fa-filter'></i> &nbsp Filtrar &nbsp <i class='fas fa-angle-down'></i>";
        }
        
    })
}
