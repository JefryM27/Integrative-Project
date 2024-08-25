<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Banco Movimiento</title>
    <link rel="stylesheet" href="../bancos/css/styles_generacion_reportes.css">
    
</head>
<body>

<header>
    <div class="top-buttons">
        <button onclick="window.location.href = 'index.php'">
            <img src="../bancos/imagen/atras.png" alt="Atrás">
         
        </button>
        <h1>Banco de Ahorro y Créditos</h1>
        <button onclick="window.location.href = 'index.php'">
            <img src="../bancos/imagen/cerrar seccion.png" alt="Cerrar Sesión">
            
        </button>
    </div>
</header>

<main>
    <div class="container">
        <section id="reportes" class="content-section">
            <h2>Generación de Reportes</h2>
            <p>Genera reportes detallados de movimientos y transacciones para análisis financiero, cumplimiento normativo y toma de decisiones estratégicas.</p>

            <div class="report-panel">
                <div class="report-options">
                    <label for="report-type">Tipo de Reporte:</label>
                    <select id="report-type">
                        <option value="movimientos">Movimientos</option>
                        <option value="transacciones">Transacciones</option>
                    </select>
                </div>

                <div class="report-options">
                    <label for="date-from">Desde:</label>
                    <input type="date" id="date-from">
                </div>

                <div class="report-options">
                    <label for="date-to">Hasta:</label>
                    <input type="date" id="date-to">
                </div>

                <button id="generate-report">Generar Reporte</button>

                <div id="report-output" class="report-output">
                    <!-- Aquí se mostrarán los reportes generados -->
                </div>
            </div>
        </section>
    </div>
</main>

<footer>
    <p>&copy; 2024 Sistema de Gestión Bancaria. Todos los derechos reservados.</p>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Custom Script -->
<script src="../bancos/JS/script_generacion_reportes.js"></script>

</body>
</html>
