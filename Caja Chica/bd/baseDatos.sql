-- Tabla para almacenar los registros de CajaChica
CREATE TABLE CajaChica (
    idCajaChica INT AUTO_INCREMENT PRIMARY KEY,
    saldoActual FLOAT NOT NULL,
    descripcion VARCHAR(255),
    monto FLOAT NOT NULL,
    departamento VARCHAR(100),
    usuario VARCHAR(100) NOT NULL
);

-- Tabla para almacenar los registros de VerGastos
CREATE TABLE VerGastos (
    idVerGastos INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    fecha DATE,
    idCajaChica INT,
    FOREIGN KEY (idCajaChica) REFERENCES CajaChica(idCajaChica)
);

-- Tabla para almacenar los registros de AgregarDinero
CREATE TABLE AgregarDinero (
    idAgregarDinero INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    monto FLOAT NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    idCajaChica INT,
    FOREIGN KEY (idCajaChica) REFERENCES CajaChica(idCajaChica)
);

-- Tabla para almacenar los registros de RegistroFactura
CREATE TABLE RegistroFactura (
    idRegistroFactura INT AUTO_INCREMENT PRIMARY KEY,
    numeroFactura VARCHAR(50) NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    departamento VARCHAR(100),
    monto FLOAT NOT NULL,
    fecha DATE NOT NULL,
    idCajaChica INT,
    FOREIGN KEY (idCajaChica) REFERENCES CajaChica(idCajaChica)
);

-- Tabla para almacenar los registros de LiquidarVale
CREATE TABLE LiquidarVale (
    idLiquidarVale INT AUTO_INCREMENT PRIMARY KEY,
    numeroVale VARCHAR(50) NOT NULL,
    montoGastado FLOAT NOT NULL,
    detalleGastos VARCHAR(255),
    fechaLiquidacion DATE NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    idCajaChica INT,
    FOREIGN KEY (idCajaChica) REFERENCES CajaChica(idCajaChica)
);

-- Tabla para almacenar los registros de Reporte
CREATE TABLE Reporte (
    idReporte INT AUTO_INCREMENT PRIMARY KEY,
    numeroFactura VARCHAR(50) NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    departamento VARCHAR(100),
    monto FLOAT NOT NULL,
    fecha DATE NOT NULL,
    idRegistroFactura INT,
    FOREIGN KEY (idRegistroFactura) REFERENCES RegistroFactura(idRegistroFactura)
);

-- Tabla para almacenar los registros de AsientosContables
CREATE TABLE AsientosContables (
    idAsientoContable INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    cuenta VARCHAR(50) NOT NULL,
    denominacion VARCHAR(100),
    debe FLOAT,
    haber FLOAT,
    idCajaChica INT,
    FOREIGN KEY (idCajaChica) REFERENCES CajaChica(idCajaChica)
);
