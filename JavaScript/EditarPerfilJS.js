//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 

window.addEventListener("load", principal);

function principal(){ 
    
    addAcao();
    closeAcao();
    showEditarPerfilVoluntario();
    showEditarPreferenciasVoluntario();
    showEditarPerfilInstituicao();
    showEditarPreferenciasInstituicao()

}

function addAcao(){
    let botao = document.getElementById("addacao")
    let acaoform = document.getElementById("acaoform")

    if (botao != null) {
        botao.addEventListener("click", function(){
            acaoform.setAttribute("class", "w3-container w3-border w3-border-black w3-round visible")
        })
    }
    
}

function closeAcao(){
    let botao = document.getElementById("closeActionForm")
    let acaoform = document.getElementById("acaoform")

    if (botao != null) {
        botao.addEventListener("click", function(){
            acaoform.setAttribute("class", "w3-container hidden")
        })
    }
    
}

function showEditarPerfilVoluntario() {
    let epevol = document.getElementById("editarPerfilVoluntario")

    if (epevol != null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                epevol.innerHTML = this.responseText
                updatePerfilVol()
            }
        }
        xmlhttp.open("GET", "../Controller/EditarPerfilController.php?show_editar_perfil_voluntario=yes", true);
        xmlhttp.send();
    }
}

function showEditarPreferenciasVoluntario() {
    let eprvol = document.getElementById("editarPreferenciasVoluntario")

    if (eprvol != null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                eprvol.innerHTML = this.responseText
            }
        }
        xmlhttp.open("GET", "../Controller/EditarPerfilController.php?show_editar_preferencias_voluntario=yes", true);
        xmlhttp.send();
    }
}

function updatePerfilVol() {
    
    $("form#registertext").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
    
        $.ajax({
            url: "../Controller/EditarPerfilController.php",
            type: 'POST',
            data: formData,
            success: function (data) {
                console.log(data)
                if (data.trim() == "Updated.") {
                    showEditarPerfilVoluntario()
                    document.getElementById("erroEditarPerfilVol").innerHTML = ""
                } else {
                    document.getElementById("erroEditarPerfilVol").innerHTML = data
                }
                
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    
}

function addArea(){
    let selecta = document.getElementById("sel-area-interesse");

    if (selecta.value != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                showEditarPreferenciasVoluntario()
            }
        }
        xmlhttp.open("GET", "../Controller/EditarPerfilController.php?add_area_interesse="+String(selecta.value), true);
        xmlhttp.send();
    }
}

function addPopulacao(){
    let selectp = document.getElementById("sel-populacao");

    if (selectp.value != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                showEditarPreferenciasVoluntario()
            }
        }
        xmlhttp.open("GET", "../Controller/EditarPerfilController.php?add_populacao_alvo="+String(selectp.value), true);
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
                showEditarPreferenciasVoluntario()
            }
        }
        xmlhttp.open("GET", "../Controller/EditarPerfilController.php?add_dia="+String(selectd.value)+"&add_hora="+String(selecth.value)+"&add_duracao="+String(selectdu.value), true);
        xmlhttp.send();
    }
}

function removeArea(area){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showEditarPreferenciasVoluntario()
        }
    }
    xmlhttp.open("GET", "../Controller/EditarPerfilController.php?remove_area_interesse="+String(area), true);
    xmlhttp.send();
}

function removePopulacao(populacao){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showEditarPreferenciasVoluntario()
        }
    }
    xmlhttp.open("GET", "../Controller/EditarPerfilController.php?remove_populacao_alvo="+String(populacao), true);
    xmlhttp.send();
}

function removeDisponibilidade(dia, hora, duracao){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showEditarPreferenciasVoluntario()
        }
    }
    xmlhttp.open("GET", "../Controller/EditarPerfilController.php?remove_dia="+String(dia)+"&remove_hora="+String(hora)+"&remove_duracao="+String(duracao), true);
    xmlhttp.send();
}

function showEditarPerfilInstituicao() {
    let epeins = document.getElementById("editarPerfilInstituicao")

    if (epeins != null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                epeins.innerHTML = this.responseText
                updatePerfilIns()
            }
        }
        xmlhttp.open("GET", "../Controller/EditarPerfilController.php?show_editar_perfil_instituicao=yes", true);
        xmlhttp.send();
    }
}

function showEditarPreferenciasInstituicao() {
    let eprins = document.getElementById("editarPreferenciasInstituicao")

    if (eprins != null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                eprins.innerHTML = this.responseText
            }
        }
        xmlhttp.open("GET", "../Controller/EditarPerfilController.php?show_editar_preferencias_instituicao=yes", true);
        xmlhttp.send();
    }
}

function updatePerfilIns() {
    
    $("form#registertext").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
    
        $.ajax({
            url: "../Controller/EditarPerfilController.php",
            type: 'POST',
            data: formData,
            success: function (data) {
                console.log(data)
                if (data.trim() == "Updated.") {
                    showEditarPerfilVoluntario()
                    document.getElementById("erroEditarPerfilIns").innerHTML = ""
                } else {
                    document.getElementById("erroEditarPerfilIns").innerHTML = data
                }
                
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    
}