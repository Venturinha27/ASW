//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal() {
    opencard();
    closecard();
    showPublicacoes();
    createPublicacao()
}

function closecard() {
    /* document.getElementById("submit").addEventListener("click", function() {
        document.getElementById("addCard").setAttribute("class", "w3-card-4 hidden")
    }); */

    document.getElementById("closeButton").addEventListener("click", function() {
        document.getElementById("addCard").setAttribute("class", "w3-card-4 hidden")
        document.getElementById("avatar").value = ""
        document.getElementById("descricao").value = ""
        document.getElementById("com").value = ""
        document.getElementById("erroCreatePub").innerHTML = ""
    });
  }

  function closecreate() {
    document.getElementById("addCard").setAttribute("class", "w3-card-4 hidden")
    document.getElementById("avatar").value = ""
    document.getElementById("descricao").value = ""
    document.getElementById("com").value = ""
    document.getElementById("erroCreatePub").innerHTML = ""
  }

function opencard() {
    document.getElementById("addButton").addEventListener("click", function() {
        document.getElementById("addCard").setAttribute("class", "w3-card-4 visible")
    });
  }

function showPublicacoes() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("BodyDiv").innerHTML = this.responseText
        }
    }
    xmlhttp.open("POST", "../Controller/PublicacoesController.php?show_publicacoes=yes", true);
    xmlhttp.send(); 
}

function createPublicacao() {

    $("form#containIn").submit(function(e) {
        if (document.getElementById("descricao").value == "") {
            e.preventDefault();  
            document.getElementById("erroCreatePub").innerHTML = "Insira uma descrição."
        } else {
            e.preventDefault();    
            var formData = new FormData(this);
        
            $.ajax({
                url: "../Controller/PublicacoesController.php",
                type: 'POST',
                data: formData,
                success: function (data) {
                    if (data.trim() == "Inseriu.") {
                        showPublicacoes()
                        closecreate()
                    } else {
                        document.getElementById("erroCreatePub").innerHTML = data
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });

    /* let com = document.getElementById("com").value
    let descricao = document.getElementById("descricao").value

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "Inseriu.") {
                showPublicacoes()
            } else {
                document.getElementById("erroCreatePub").innerHTML = this.responseText
            }
        }
    }
    xmlhttp.open("POST", "../Controller/PublicacoesController.php?create_publicacao=yes&com="+String(com)+"&descricao="
    +String(descricao), true);
    xmlhttp.send();  */


}