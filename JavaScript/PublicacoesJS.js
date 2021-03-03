window.addEventListener("load", principal);

function principal() {
    opencard();
    closecard();
}

function closecard() {
    document.getElementById("submit").addEventListener("click", function() {
        document.getElementById("addCard").setAttribute("class", "w3-card-4 hidden")
    });

    document.getElementById("closeButton").addEventListener("click", function() {
        document.getElementById("addCard").setAttribute("class", "w3-card-4 hidden")
    });
  }

function opencard() {
    document.getElementById("addButton").addEventListener("click", function() {
        document.getElementById("addCard").setAttribute("class", "w3-card-4 visible")
    });
  }