

// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const filteredLoans = loanRequests.filter(loan => 
        loan.cedula.includes(searchTerm) ||
        loan.nombre.toLowerCase().includes(searchTerm) ||
        loan.tipoPrestamo.toLowerCase().includes(searchTerm)
    );
    populateTable(filteredLoans);
});
