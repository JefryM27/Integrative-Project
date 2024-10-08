<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Página Principal de la Cooperativa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
  <link href="../public/css/stylemain.css" rel="stylesheet" />
  <style>
    .module {
      margin: 15px 0;
      text-align: center;
    }

    .module i {
      font-size: 3rem;
      color: black;
    }

    .module-title {
      background-color: white;
      color: black;
      border: 3px solid black;
      padding: 5px;
      display: block;
      margin: 10px auto;
      text-decoration: none;
      width: 200px;
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }

    .module-title:hover {
      background-color: #f8f9fa;
      color: black;
    }

    .header,
    footer {
      background-color: #3b5998;
      /* Color similar al mostrado en la imagen */
      color: white;
    }
  </style>
</head>

<body>
  <div class="header d-flex justify-content-between align-items-center px-3 py-2">
    <div>Nombre del Usuario</div>
    <img src="logo.png" alt="Logo de la cooperativa" height="50" />
  </div>

  <main class="container mt-5">
    <div class="row">
      <div class="col-12 mb-4">
        <form class="search-bar d-flex justify-content-center">
          <input type="text" class="form-control" placeholder="Ingrese el departamento..." />
          <button type="submit" class="btn btn-primary btn-lg mx-4">Buscar</button>
        </form>
      </div>
    </div>
    <div class="row">
      <!-- Botón 1 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-shield-fill-check"></i>
        <a href="/pages/vista1.2.php" class="module-title">Activos y Custodia</a>
      </div>
      <!-- Botón 2 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-bank"></i>
        <a href="banco.html" class="module-title">Banco</a>
      </div>
      <!-- Botón 3 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-cash-coin"></i>
        <a href="caja.html" class="module-title">Caja</a>
      </div>
      <!-- Botón 4 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-wallet2"></i>
        <a href="caja_chica.html" class="module-title">Caja Chica</a>
      </div>
      <!-- Botón 5 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-people-fill"></i>
        <a href="clientes_liquidacion.html" class="module-title">Clientes y Liquidación</a>
      </div>
      <!-- Botón 6 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-handbag-fill"></i>
        <a href="/Cobros/cobros.php" class="module-title">Cobros</a>
      </div>
      <!-- Botón 7 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-book"></i>
        <a href="menu.html" class="module-title">Contabilidad y Asientos</a>
      </div>
      <!-- Botón 8 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-receipt-cutoff"></i>
        <a href="/CCP/index.php" class="module-title">Cuentas por Pagar y Cobrar</a>
      </div>
      <!-- Botón 9 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-file-earmark-medical"></i>
        <a href="gastos_diferentes_cierres.html" class="module-title">Gastos Diferentes y Cierres</a>
      </div>
      <!-- Botón 10 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-bar-chart-line"></i>
        <a href="presupuesto_transferencia.html" class="module-title">Presupuesto y Transferencia por Partida</a>
      </div>
      <!-- Botón 11 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-box-seam"></i>
        <a href="productos_financieros.html" class="module-title">Productos Financieros</a>
      </div>
      <!-- Botón 12 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-credit-card"></i>
        <a href="/Tesoreria/index.html" class="module-title">Tesorería y Transferencias</a>
      </div>
      <!-- Botón 13 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-credit-card-2-back-fill"></i>
        <a href="tarjetas.html" class="module-title">Tarjetas</a>
      </div>
      <!-- Botón 14 -->
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 module">
        <i class="bi bi-person-gear"></i>
        <a href="usuarios_organizacion.html" class="module-title">Usuarios y Organización</a>
      </div>
    </div>
  </main>
  <footer class="footer text-white text-center py-3" style="background-color: #3b5998;">
    © 2024 Cooperativa de Ahorro y Crédito
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>