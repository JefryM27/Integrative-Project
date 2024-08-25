CREATE DATABASE custodia_activos;
USE custodia_activos;

CREATE TABLE usuarios (
    usuario_id INT PRIMARY KEY AUTO_INCREMENT,
    cedula INT NOT NULL,
    nombre_usuario VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE boveda (
    id INT PRIMARY KEY AUTO_INCREMENT,
    responsable VARCHAR(100),
    ubicacion VARCHAR(100),
    moneda VARCHAR(20),
    monto DECIMAL(15, 2),
    id_organizacion INT
);

CREATE TABLE localizacion (
    id INT PRIMARY KEY AUTO_INCREMENT,
    numero_expediente VARCHAR(50) NOT NULL,
    sucursal VARCHAR(50),
    archivo VARCHAR(50),
    id_boveda INT,
    CONSTRAINT FK_Boveda_Localizacion FOREIGN KEY (id_boveda) REFERENCES boveda(id)
);

CREATE TABLE tipoactivo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descripcion VARCHAR(100) NOT NULL,
    nombre_activo VARCHAR(50) NOT NULL,
    clasificacion ENUM('Fijo', 'Circulante') NOT NULL
);

CREATE TABLE tarifatipoactivo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_tipoactivo INT,
    monto DECIMAL(10, 2),
    moneda ENUM('colones', 'dolares', 'euros'),
    CONSTRAINT FK_TipoActivo_Tarifa FOREIGN KEY (id_tipoactivo) REFERENCES tipoactivo(id)
);

CREATE TABLE clientes (
    cliente_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    tipo_documento INT,
    numero_documento INT,
    fecha_caducidad DATE,
    edad INT,
    estado_civil VARCHAR(50),
    provincia VARCHAR(100),
    canton VARCHAR(100),
    distrito VARCHAR(100),
    direccion_exacta VARCHAR(255),
    tipo_cliente VARCHAR(50)
);

CREATE TABLE activo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_activo VARCHAR(100) NOT NULL,
    id_tipoactivo INT,
    numero_serie VARCHAR(50) NOT NULL,
    valor DECIMAL(15, 2),
    id_localizacion INT,
    fecha_adquisicion DATE,
    estado ENUM('activo', 'inactivo', 'mantenimiento', 'retirado') NOT NULL,
    id_cliente INT,
    CONSTRAINT FK_TipoActivo_Activo FOREIGN KEY (id_tipoactivo) REFERENCES tipoactivo(id),
    CONSTRAINT FK_Localizacion_Activo FOREIGN KEY (id_localizacion) REFERENCES localizacion(id),
    CONSTRAINT FK_Cliente_Activo FOREIGN KEY (id_cliente) REFERENCES clientes(cliente_id)
);

CREATE TABLE valoracionactivo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_activo INT,
    id_tipoactivo INT,
    valor DECIMAL(10, 2),
    fecha DATE,
    observaciones TEXT,
    id_usuario INT,
    CONSTRAINT FK_Activo_Valoracion FOREIGN KEY (id_activo) REFERENCES activo(id),
    CONSTRAINT FK_TipoActivo_Valoracion FOREIGN KEY (id_tipoactivo) REFERENCES tipoactivo(id),
    CONSTRAINT FK_Usuario_Valoracion FOREIGN KEY (id_usuario) REFERENCES usuarios(usuario_id)
);

CREATE TABLE cajaseguridad (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_caja VARCHAR(50),
    id_localizacion INT,
    numero_caja INT,
    capacidad INT,
    disponibilidad BOOLEAN,
    CONSTRAINT FK_Localizacion_Caja FOREIGN KEY (id_localizacion) REFERENCES localizacion(id)
);

CREATE TABLE cobroactivo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_tarifa INT,
    fecha DATE,
    id_activo INT,
    id_cliente INT,
    CONSTRAINT FK_Tarifa_Cobro FOREIGN KEY (id_tarifa) REFERENCES tarifatipoactivo(id),
    CONSTRAINT FK_Activo_Cobro FOREIGN KEY (id_activo) REFERENCES activo(id),
    CONSTRAINT FK_Cliente_Cobro FOREIGN KEY (id_cliente) REFERENCES clientes(cliente_id)
);

CREATE TABLE riesgo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descripcion TEXT,
    nivel ENUM('Muy bajo', 'Bajo', 'Medio', 'Alto', 'Crítico') NOT NULL,
    id_activo INT,
    tipo_riesgo VARCHAR(50) NOT NULL,
    CONSTRAINT FK_Activo_Riesgo FOREIGN KEY (id_activo) REFERENCES activo(id)
);

CREATE TABLE auditoria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATE,
    resultado TEXT,
    id_activo INT,
    CONSTRAINT FK_Activo_Auditoria FOREIGN KEY (id_activo) REFERENCES activo(id)
);

CREATE TABLE documento (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descripcion TEXT,
    fecha DATE,
    id_tipoactivo INT,
    id_localizacion INT,
    CONSTRAINT FK_TipoActivo_Documento FOREIGN KEY (id_tipoactivo) REFERENCES tipoactivo(id),
    CONSTRAINT FK_Localizacion_Documento FOREIGN KEY (id_localizacion) REFERENCES localizacion(id)
);
