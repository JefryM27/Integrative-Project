
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase().trim();
    const filteredLoans = loanRequests.filter(loan => 
        loan.estado === "Aprobado" && 
        (loan.cedula.includes(searchTerm) ||
        loan.nombre.toLowerCase().includes(searchTerm) ||
        loan.tipoPrestamo.toLowerCase().includes(searchTerm))
    );
    populateApprovedLoans(filteredLoans);
});

// Inicializar la tabla con los préstamos aprobados
populateApprovedLoans(loanRequests);
