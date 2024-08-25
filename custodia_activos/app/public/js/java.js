document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("modal");
    const openModalButton = document.getElementById("openModalButton");
    const closeModalButton = document.getElementsByClassName("close")[0];

    openModalButton.addEventListener("click", function() {
        modal.style.display = "block";
    });

    closeModalButton.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

// Redirection for "Salir" button
const salirButton = document.getElementById("salir");
salirButton.addEventListener("click", function() {
    const url = this.getAttribute("data-href");
    window.location.href = url;
});
});