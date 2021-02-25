window.addEventListener("load", principal);

function principal() {
    print("ta aqui")
    closecard();
    opencard();
}

function closecard() {
    document.getElementById("addCard").addEventListener("click", function() {
        document.getElementById("addCard").style.display = "none";
    });
  }

function opencard() {
    document.getElementById("addCard").addEventListener("click", function() {
        document.getElementById("addCard").style.display = "visible";
    });
  }