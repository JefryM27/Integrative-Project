-- Creación de la base de datos
CREATE DATABASE CajaChicaDB;
-- Seleccionar la base de datos
USE CajaChicaDB;
-- Tabla para almacenar los registros de Usuarios
CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL
);
-- Tabla para almacenar los registros de CajaChica
CREATE TABLE CajaChica (
    id INT AUTO_INCREMENT PRIMARY KEY,
    saldoActual FLOAT NOT NULL,
    fecha DATE NOT NULL,
    monto FLOAT NOT NULL,
    descripcion VARCHAR(255),
    departamento VARCHAR(100),
    usuario VARCHAR(100) NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES Usuarios(id)
);
-- Tabla para almacenar los registros de VerGastos
CREATE TABLE VerGastos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    fecha DATE,
    cajaChica_id INT,
    FOREIGN KEY (cajaChica_id) REFERENCES CajaChica(id)
);
-- Tabla para almacenar los registros de AgregarDinero
CREATE TABLE AgregarDinero (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    monto FLOAT NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    cajaChica_id INT,
    FOREIGN KEY (cajaChica_id) REFERENCES CajaChica(id)
);
-- Tabla para almacenar los registros de RegistroFactura
CREATE TABLE RegistroFactura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numeroFactura VARCHAR(50) NOT NULL,
    encargado VARCHAR(100) NOT NULL,
    departamento VARCHAR(100),
    monto FLOAT NOT NULL,
    fecha DATE NOT NULL,
    cajaChica_id INT,
    FOREIGN KEY (cajaChica_id) REFERENCES CajaChica(id)
);
-- Tabla para almacenar los registros de LiquidarVale
CREATE TABLE LiquidarVale (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numeroVale VARCHAR(50) NOT NULL,
    montoGastado FLOAT NOT NULL,
    detalleGastos VARCHAR(255),
    fechaLiquidacion DATE NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    cajaChica_id INT,
    FOREIGN KEY (cajaChica_id) REFERENCES CajaChica(id)
);
CREATE TABLE LiquidarCajaChica (
    id INT AUTO_INCREMENT PRIMARY KEY,
    saldoActual FLOAT NOT NULL,
    totalGastos FLOAT NOT NULL,
    fechaLiquidacion DATE NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES Usuarios(id)
);
-- Tabla para almacenar los registros de Reporte
CREATE TABLE Reporte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numeroFactura VARCHAR(50) NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    departamento VARCHAR(100),
    monto FLOAT NOT NULL,
    fecha DATE NOT NULL,
    registroFactura_id INT,
    FOREIGN KEY (registroFactura_id) REFERENCES RegistroFactura(id)
);
-- Tabla para almacenar los registros de AsientosContables
CREATE TABLE AsientosContables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    cuenta VARCHAR(50) NOT NULL,
    denominacion VARCHAR(100),
    debe FLOAT,
    haber FLOAT,
    cajaChica_id INT,
    FOREIGN KEY (cajaChica_id) REFERENCES CajaChica(id)
);