window.addEventListener("load", principal);

let nareas;
let npopulacao;
let ndisponibilidade;

function principal(){ 
    
    showareas()
    showpopulacao()
    showdisponibilidade()

}

function showareas() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ularea").innerHTML = this.responseText
            nareas = document.getElementsByClassName("liarea").length
            showAvancar()
        }
    }
    xmlhttp.open("GET", "../Controller/PreferenciasVController.php?get_areas='yes'", true);
    xmlhttp.send();
}

function showpopulacao() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ulpopulacao").innerHTML = this.responseText
            npopulacao = document.getElementsByClassName("lipopulacao").length
            showAvancar()
        }
    }
    xmlhttp.open("GET", "../Controller/PreferenciasVController.php?get_populacao='yes'", true);
    xmlhttp.send();
}

function showdisponibilidade() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("uldisponibilidade").innerHTML = this.responseText
            ndisponibilidade = document.getElementsByClassName("lidisponibilidade").length
            showAvancar()
        }
    }
    xmlhttp.open("GET", "../Controller/PreferenciasVController.php?get_disponibilidade='yes'", true);
    xmlhttp.send();
}

function addArea(){
    let selecta = document.getElementById("sel-area-interesse");

    if (selecta.value != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                showareas()
            }
        }
        xmlhttp.open("GET", "../Controller/PreferenciasVController.php?add_area_interesse="+String(selecta.value), true);
        xmlhttp.send();
    }
}

function addPopulacao(){
    let selectp = document.getElementById("sel-populacao");

    if (selectp.value != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                showpopulacao()
            }
        }
        xmlhttp.open("GET", "../Controller/PreferenciasVController.php?add_populacao_alvo="+String(selectp.value), true);
        xmlhttp.send();
    }
}

function addDisponibilidade(){
    let selectd = document.getElementById("sel-dia");
    let selecth = document.getElementById("sel-hora");
    let selectdu = document.getElementById("sel-duracao");

    if (selectd.value != "" && selecth.value != "" && selectdu.value != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                showdisponibilidade()
            }
        }
        xmlhttp.open("GET", "../Controller/PreferenciasVController.php?add_dia="+String(selectd.value)+"&add_hora="+String(selecth.value)+"&add_duracao="+String(selectdu.value), true);
        xmlhttp.send();
    }
}

function removeArea(area){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showareas()
        }
    }
    xmlhttp.open("GET", "../Controller/PreferenciasVController.php?remove_area_interesse="+String(area), true);
    xmlhttp.send();
}

function removePopulacao(populacao){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showpopulacao()
        }
    }
    xmlhttp.open("GET", "../Controller/PreferenciasVController.php?remove_populacao_alvo="+String(populacao), true);
    xmlhttp.send();
}

function removeDisponibilidade(dia, hora, duracao){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showdisponibilidade()
        }
    }
    xmlhttp.open("GET", "../Controller/PreferenciasVController.php?remove_dia="+String(dia)+"&remove_hora="+String(hora)+"&remove_duracao="+String(duracao), true);
    xmlhttp.send();
}

function showAvancar() {
    let avancardiv = document.getElementById("avancardiv")

    if (nareas > 0 && npopulacao > 0 && ndisponibilidade > 0){
        avancardiv.innerHTML = "<a href='Perfil.php'><button class='w3-button w3-border w3-center' id='avancar'>Avançar</button></a>";
    } else {
        avancardiv.innerHTML = "<p>Escolha, pelo menos, uma área de interesse, uma população-alvo e uma disponibilidade.</p>";
    }
}
    