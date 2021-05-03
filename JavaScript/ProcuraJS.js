//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 

function showHint(str) {
    var xhttp;
    if (str.length == 0) { 
      document.getElementById("topSugestaoDiv").innerHTML = "";
      return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("topSugestaoDiv").innerHTML = "<form action='../Controller/VerPerfil.php' method='post'>"+this.responseText+"</form>";
        if (this.responseText == "") {
            document.getElementById("topSugestaoDiv").setAttribute("class", "w3-bar-item hidden")
        } else {
            document.getElementById("topSugestaoDiv").setAttribute("class", "w3-bar-item visible")
        }
      }
    };
    xhttp.open("GET", "../Controller/ProcuraController.php?q="+str, true);
    xhttp.send(); 
}