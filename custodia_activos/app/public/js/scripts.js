function navigateTo(module) {
    const content = {
        'cierre-caja': '<h2>Cierre Caja</h2><p>Contenido del módulo Cierre Caja.</p>',
        'cajas': '<h2>Cajas</h2><p>Contenido del módulo Cajas.</p>',
        'transferencia': '<h2>Transferencia</h2><p>Contenido del módulo Transferencia.</p>',
        'tesoreria': '<h2>Tesorería</h2><p>Contenido del módulo Tesorería.</p>',
        'presupuesto': '<h2>Presupuesto y Transferencia Partid</h2><p>Contenido del módulo Presupuesto y Transferencia Partid.</p>',
        'custodia': '<h2>Custodia</h2><p>Contenido del módulo Custodia.</p>',
        'cobros': '<h2>Cobros</h2><p>Contenido del módulo Cobros.</p>',
        'captacion': '<h2>Captación</h2><p>Contenido del módulo Captación.</p>',
        'clientes': '<h2>Clientes</h2><p>Contenido del módulo Clientes.</p>',
        'liquidacion': '<h2>Liquidación</h2><p>Contenido del módulo Liquidación.</p>',
        'tarjetas': '<h2>Tarjetas</h2><p>Contenido del módulo Tarjetas.</p>',
        'colocacion': '<h2>Colocación</h2><p>Contenido del módulo Colocación.</p>',
        'contabilidad': '<h2>Contabilidad</h2><p>Contenido del módulo Contabilidad.</p>',
        'asientos-contables': '<h2>Asientos contables</h2><p>Contenido del módulo Asientos contables.</p>',
        'cuentas-pagar': '<h2>Cuentas por Pagar</h2><p>Contenido del módulo Cuentas por Pagar.</p>',
        'cuentas-cobrar': '<h2>Cuentas por Cobrar</h2><p>Contenido del módulo Cuentas por Cobrar.</p>',
        'activos': '<h2>Activos</h2><p>Contenido del módulo Activos.</p>',
        'bancos': '<h2>Bancos</h2><p>Contenido del módulo Bancos.</p>',
        'caja-chica': '<h2>Caja Chica</h2><p>Contenido del módulo Caja Chica.</p>',
        'gastos-diferidos': '<h2>Gastos Diferidos</h2><p>Contenido del módulo Gastos Diferidos.</p>',
        'cierres': '<h2>Cierres</h2><p>Contenido del módulo Cierres.</p>',
        'reportes': '<h2>Reportes</h2><p>Contenido del módulo Reportes.</p>',
        'proveedores': '<h2>Proveedores</h2><p>Contenido del módulo Proveedores.</p>',
        'usuarios': '<h2>Usuarios</h2><p>Contenido del módulo Usuarios.</p>'
    };

    document.getElementById('module-content').innerHTML = content[module] || '<h2>Bienvenido</h2><p>Seleccione un módulo del menú para empezar.</p>';
}