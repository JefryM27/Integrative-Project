document.addEventListener('DOMContentLoaded', function() {
    const createChargeBtn = document.getElementById('createChargeBtn');
    const chargeModal = document.getElementById('chargeModal');
    const closeModal = document.getElementById('closeModal');
    const modalTitle = document.getElementById('modalTitle');
    const chargeForm = document.getElementById('addAssetForm');
    const chargeIdInput = document.getElementById('chargeId');
    const chargeDateInput = document.getElementById('fecha');
    const chargeAssetInput = document.getElementById('chargeAsset');
    const chargeAmountInput = document.getElementById('chargeAmount');
    const chargeClientInput = document.getElementById('chargeClient');

    createChargeBtn.addEventListener('click', () => {
        modalTitle.textContent = 'Nuevo Cobro';
        chargeForm.reset();
        chargeIdInput.value = '';
        chargeModal.style.display = 'block';
    });

    closeModal.addEventListener('click', () => {
        chargeModal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === chargeModal) {
            chargeModal.style.display = 'none';
        }
    });

    chargeForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const chargeId = chargeIdInput.value;
        const chargeDate = chargeDateInput.value;
        const chargeAsset = chargeAssetInput.options[chargeAssetInput.selectedIndex].text; // Obtener el texto del activo
        const chargeAmount = chargeAmountInput.options[chargeAmountInput.selectedIndex].text; // Obtener el texto del monto
        const chargeClient = chargeClientInput.options[chargeClientInput.selectedIndex].text; // Obtener el texto del cliente

        if (chargeId) {
            // Lógica para actualizar un cobro existente
            document.querySelector(`#charge-${chargeId} td:nth-child(2)`).textContent = chargeDate;
            document.querySelector(`#charge-${chargeId} td:nth-child(3)`).textContent = chargeAsset;
            document.querySelector(`#charge-${chargeId} td:nth-child(4)`).textContent = chargeAmount;
            document.querySelector(`#charge-${chargeId} td:nth-child(5)`).textContent = chargeClient;
        } else {
            // Lógica para agregar un nuevo cobro
            const newId = document.querySelectorAll('#chargeTableBody tr').length + 1;
            const newRow = `
                <tr id="charge-${newId}">
                    <td>${newId}</td>
                    <td>${chargeDate}</td>
                    <td>${chargeAsset}</td>
                    <td>${chargeAmount}</td>
                    <td>${chargeClient}</td>
                    <td>
                        <button class="btn edit-btn" onclick="openEditModal(${newId}, '${chargeDate}', '${chargeAsset}', '${chargeAmount}', '${chargeClient}')">Editar</button>
                        <form method='post' action='/actions/cobroActivo/eliminar.php'>
                            <input type='hidden' name='id' value='${newId}'>
                            <button type='submit' class='btn btn-danger delete-btn'>Eliminar</button>
                        </form>
                    </td>
                </tr>
            `;
            document.querySelector('#chargeTableBody').insertAdjacentHTML('beforeend', newRow);
        }

        chargeModal.style.display = 'none';
    });
});

function openEditModal(id, date, asset, amount, client) {
    const chargeModal = document.getElementById('chargeModal');
    const modalTitle = document.getElementById('modalTitle');
    const chargeIdInput = document.getElementById('chargeId');
    const chargeDateInput = document.getElementById('fecha');
    const chargeAssetInput = document.getElementById('chargeAsset');
    const chargeAmountInput = document.getElementById('chargeAmount');
    const chargeClientInput = document.getElementById('chargeClient');

    modalTitle.textContent = 'Editar Cobro';
    chargeIdInput.value = id;
    chargeDateInput.value = date;
    chargeAssetInput.value = asset;
    chargeAmountInput.value = amount;
    chargeClientInput.value = client;
    chargeModal.style.display = 'block';
}

document.getElementById('cerrar').addEventListener('click', function() {
    window.location.href = this.getAttribute('data-href');
});
