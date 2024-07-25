CREATE TABLE Boveda (
    id_boveda INT PRIMARY KEY AUTO_INCREMENT,
    moneda VARCHAR(10) NOT NULL,
    monto DECIMAL(15, 2) NOT NULL,
    ultima_actualizacion DATETIME NOT NULL
);

CREATE TABLE TipoCambio (
    id_tipo_cambio INT PRIMARY KEY AUTO_INCREMENT,
    moneda_origen VARCHAR(10) NOT NULL,
    moneda_destino VARCHAR(10) NOT NULL,
    tasa DECIMAL(15, 4) NOT NULL,
    fecha DATETIME NOT NULL
);

CREATE TABLE TransferenciasInternas (
    id_transferencia INT PRIMARY KEY AUTO_INCREMENT,
    cuenta_origen VARCHAR(50) NOT NULL,
    cuenta_destino VARCHAR(50) NOT NULL,
    divisa VARCHAR(10) NOT NULL,
    monto DECIMAL(15, 2) NOT NULL,
    fecha DATE NOT NULL,
    estado VARCHAR(50) NOT NULL,
    tipo VARCHAR(50) NOT NULL
);

CREATE TABLE TransferenciasCaja (
    id_transferencia INT PRIMARY KEY AUTO_INCREMENT,
    caja_destino VARCHAR(50) NOT NULL,
    efectivo_actual DECIMAL(15, 2) NOT NULL,
    monto_transferir DECIMAL(15, 2) NOT NULL,
    fecha DATE NOT NULL
);


CREATE TABLE FlujoEfectivo (
    id_flujo_efectivo INT PRIMARY KEY AUTO_INCREMENT,
    id_boveda INT,
    descripcion VARCHAR(255) NOT NULL,
    moneda VARCHAR(10) NOT NULL,
    monto DECIMAL(15, 2) NOT NULL,
    fecha DATETIME NOT NULL,
    FOREIGN KEY (id_boveda) REFERENCES Boveda(id_boveda)
);

CREATE TABLE Inversion (
    id_inversion INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    divisa VARCHAR(10) NOT NULL,
    monto DECIMAL(15, 2) NOT NULL,
    intereses DECIMAL(15, 2) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE,
    FOREIGN KEY (id_usuario) REFERENCES Cliente(id_usuario)
);

CREATE TABLE ArqueoCaja (
    id_arqueo INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATE NOT NULL,
    caja VARCHAR(50) NOT NULL,
    responsable VARCHAR(100) NOT NULL,
    saldo_inicial DECIMAL(15, 2) NOT NULL,
    entradas DECIMAL(15, 2) NOT NULL,
    salidas DECIMAL(15, 2) NOT NULL,
    saldo_final DECIMAL(15, 2) NOT NULL
);


CREATE TABLE PagoFactura (
    id_pago INT PRIMARY KEY AUTO_INCREMENT,
    id_factura INT NOT NULL,
    monto_pagado DECIMAL(15, 2) NOT NULL,
    fecha_pago DATE NOT NULL,
    FOREIGN KEY (id_factura) REFERENCES Factura(id_factura)
);

CREATE TABLE LiquidezReserva (
    id_liquidez INT PRIMARY KEY AUTO_INCREMENT,
    divisa VARCHAR(10) NOT NULL,
    monto DECIMAL(15, 2) NOT NULL,
    fecha_actualizacion DATE NOT NULL
);
