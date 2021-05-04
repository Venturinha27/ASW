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
    xhttp.open("POST", "../Controller/ProcuraController.php?q="+str, true);
    xhttp.send(); 
}