document.getElementById("toggleButton").addEventListener("click", function() {
    var scrollContainer = document.getElementById("scrollContainer");
    if (scrollContainer.style.left === "0px") {
        scrollContainer.style.left = "-270px"; // Ocultar el menú
    } else {
        scrollContainer.style.left = "0px"; // Mostrar el menú
    }
});
