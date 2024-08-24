document.addEventListener('DOMContentLoaded', function () {
    // Mostrar el modal de creación
    const createBtn = document.getElementById('createBtn');
    const modal = document.getElementById('createModal');
    const close = document.querySelector('.modal .close');
    
    createBtn.onclick = function () {
        modal.style.display = 'flex';
    };
    
    close.onclick = function () {
        modal.style.display = 'none';
    };
    
    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    // Manejo del formulario
    const form = modal.querySelector('form');
    form.onsubmit = function (event) {
        event.preventDefault(); // Prevenir la recarga de página

        const formData = new FormData(form);

        fetch('../actions/crearAsiento.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            alert(result); 
            if (result.includes('Asiento creado con éxito')) {
                form.reset(); 
            }
        })
        .catch(error => console.error('Error:', error));
    };
});
