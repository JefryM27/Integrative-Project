DROP database Tesoreria;
CREATE DATABASE Tesoreria;
USE Tesoreria;

CREATE TABLE `organizacionesFK` (
  `organizacion_id` int PRIMARY KEY,
  `nombre_organización` varchar(255),
  `direccion` varchar(255),
  `telefono` varchar(255),
  `email` varchar(255),
  `cedula_juridica` varchar(255)
);

CREATE TABLE `Boveda` (
  `id` INT PRIMARY KEY,
  `responsable` varchar(100),
  `ubicacion` varchar(100),
  `moneda` varchar(20),
  `monto` decimal(15,2),
  `detalle` varchar(50),
  `tipo_accion` varchar(50),
  `id_organizacion` int
);

CREATE TABLE `TipoCambio` (
  `id` int PRIMARY KEY,
  `fecha` datetime,
  `moneda_origen` varchar(50),
  `moneda_destino` varchar(50),
  `tasa` decimal(15,4),
  `id_organizacion` int
);

CREATE TABLE `TransferenciasInternas` (
  `id` int PRIMARY KEY,
  `cuenta_origen` varchar(50),
  `cuenta_destino` varchar(50),
  `moneda` varchar(50),
  `monto` decimal(15,2),
  `fecha_hora` datetime,
  `descripcion` varchar(50),
  `estado` varchar(50),
  `id_cuenta` int,
  `id_organizacion` int
);

CREATE TABLE `TransferenciasCaja` (
  `id` int PRIMARY KEY,
  `moneda` varchar(50),
  `monto` decimal(15,2),
  `fecha_hora` datetime,
  `detalle` varchar(50),
  `id_boveda` int,
  `id_solicitudCaja` int,
  `id_organizacion` int
);

CREATE TABLE `Desembolsos` (
  `id` int PRIMARY KEY,
  `id_tipo_desembolso` int COMMENT 'ID del tipo de desembolso, puede ser préstamo, contrato, factura',
  `tipo_desembolso` varchar(50),
  `moneda` varchar(50),
  `monto` decimal(15,2),
  `fecha_pago` datetime,
  `id_transferencia` int COMMENT 'ID de la transferencia interna relacionada',
  `id_organizacion` int
);

CREATE TABLE `Inversiones` (
  `id` int PRIMARY KEY,
  `tipo` varchar(50) COMMENT 'Tipo de inversión, puede ser ''certificado'' o ''proveedor''',
  `moneda` varchar(50),
  `monto` decimal(15,2),
  `fecha_inicio` datetime,
  `fecha_fin` datetime,
  `finalizada` boolean DEFAULT false COMMENT 'Indica si la inversión ha sido liquidada o vendida, lo intereses de la inversion pasan a la tabla liquidez',
  `id_cuenta` int,
  `id_organizacion` int
);

CREATE TABLE `ProveedoresTesoreria` (
  `id` int PRIMARY KEY,
  `nombre` varchar(100),
  `cuenta_iban` varchar(34),
  `tasa_interes` decimal(5,2),
  `fecha_vencimiento` date,
  `liquidado` boolean DEFAULT false COMMENT 'Indica si la inversión ha sido liquidada',
  `id_inversion` int,
  `id_organizacion` int
);

CREATE TABLE `Liquidez` (
  `id` int PRIMARY KEY,
  `interes_ganados` decimal(15,2),
  `fecha_pago` datetime COMMENT 'Fecha en que se pagaron los intereses',
  `id_inversion` int,
  `id_organizacion` int
);

CREATE TABLE `Certificados` (
  `id` int PRIMARY KEY,
  `tipo` varchar(20),
  `valor_nominal` decimal(15,2),
  `tasa_interes` decimal(5,2),
  `fecha_vencimiento` date,
  `vendible` boolean COMMENT 'Indica si el certificado puede ser vendido antes de la fecha de vencimiento',
  `fecha_venta` datetime COMMENT 'Fecha en la que se vendió el certificado, si aplicable',
  `id_inversion` int,
  `id_organizacion` int
);

CREATE TABLE `facturas_por_pagarFK` (
  `id` int PRIMARY KEY,
  `proveedor_id` INT,
  `moneda` varchar(50),
  `monto` DECIMAL(10,2),
  `fecha_factura` DATE,
  `descripcion` TEXT,
  `estado` varchar(50),
  `usuario_id` INT
);

CREATE TABLE `contratosFK` (
  `id` int PRIMARY KEY,
  `fecha` timestamp,
  `numero_contrato` int,
  `proveedor` int,
  `descripcion` varchar(255),
  `monto_total` double,
  `periodo` int
);

CREATE TABLE `CuentasBancoFK` (
  `id` int PRIMARY KEY,
  `numero_cuenta` varchar(20),
  `saldo` decimal(10,2)
);

CREATE TABLE `crearAsientos` (
  `id` int PRIMARY KEY,
  `descripcion` varchar(100),
  `fecha_creacion` datetime,
  `id_asiento` int,
  `id_organizacion` int
);

CREATE TABLE `prestamosFK` (
  `id` int PRIMARY KEY,
  `solicitud_id` int,
  `monto_aprovado` decimal(10,2),
  `decision` varchar(50),
  `created_at` timestamp
);

CREATE TABLE `FlujoCaja` (
  `id` int PRIMARY KEY,
  `tipo_desembolso` varchar(50),
  `moneda` varchar(50),
  `monto_total` double,
  `prioridad` int COMMENT 'Nivel de prioridad basado en criterios como rentabilidad, vencimiento, etc.',
  `id_desembolsos` int,
  `id_organizacion` int
);

CREATE TABLE `solicitudesdineroFK` (
  `id` int PRIMARY KEY,
  `fecha_hora` datetime,
  `caja_id` int,
  `moneda` varchar(50)
);

CREATE TABLE `asientos_contablesFK` (
  `id_asiento` int PRIMARY KEY,
  `fecha_asiento` timestamp,
  `descripcion` varchar(50),
  `total_debe` decimal(15,2),
  `total_haber` decimal(15,2),
  `estado_asiento` varchar(50)
);

ALTER TABLE `Boveda` ADD FOREIGN KEY (`id_organizacion`) REFERENCES `organizacionesFK` (`organizacion_id`);

ALTER TABLE `TipoCambio` ADD FOREIGN KEY (`id_organizacion`) REFERENCES `organizacionesFK` (`organizacion_id`);

ALTER TABLE `TransferenciasInternas` ADD FOREIGN KEY (`id_organizacion`) REFERENCES `organizacionesFK` (`organizacion_id`);

ALTER TABLE `TransferenciasInternas` ADD FOREIGN KEY (`id_cuenta`) REFERENCES `CuentasBancoFK` (`id`);

ALTER TABLE `TransferenciasCaja` ADD FOREIGN KEY (`id_boveda`) REFERENCES `boveda` (`id`);

ALTER TABLE `TransferenciasCaja` ADD FOREIGN KEY (`id_organizacion`) REFERENCES `organizacionesFK` (`organizacion_id`);

ALTER TABLE `Inversiones` ADD FOREIGN KEY (`id_cuenta`) REFERENCES `CuentasBancoFK` (`id`);

ALTER TABLE `Inversiones` ADD FOREIGN KEY (`id_organizacion`) REFERENCES `organizacionesFK` (`organizacion_id`);

ALTER TABLE `ProveedoresTesoreria` ADD FOREIGN KEY (`id_organizacion`) REFERENCES `organizacionesFK` (`organizacion_id`);

ALTER TABLE `crearAsientos` ADD FOREIGN KEY (`id_organizacion`) REFERENCES `organizacionesFK` (`organizacion_id`);

ALTER TABLE `TransferenciasCaja` ADD FOREIGN KEY (`id_solicitudCaja`) REFERENCES `solicitudesdineroFK` (`id`);

ALTER TABLE `crearAsientos` ADD FOREIGN KEY (`id_asiento`) REFERENCES `asientos_contablesFK` (`id_asiento`);

ALTER TABLE `Certificados` ADD FOREIGN KEY (`id_organizacion`) REFERENCES `organizacionesFK` (`organizacion_id`);

ALTER TABLE `Liquidez` ADD FOREIGN KEY (`id_organizacion`) REFERENCES `organizacionesFK` (`organizacion_id`);

ALTER TABLE `Certificados` ADD FOREIGN KEY (`id_inversion`) REFERENCES `Inversiones` (`id`);

ALTER TABLE `Liquidez` ADD FOREIGN KEY (`id_inversion`) REFERENCES `Inversiones` (`id`);

ALTER TABLE `ProveedoresTesoreria` ADD FOREIGN KEY (`id_inversion`) REFERENCES `Inversiones` (`id`);

ALTER TABLE `Desembolsos` ADD FOREIGN KEY (`id_organizacion`) REFERENCES `organizacionesFK` (`organizacion_id`);

ALTER TABLE `Desembolsos` ADD FOREIGN KEY (`id_tipo_desembolso`) REFERENCES `prestamosFK` (`id`);

ALTER TABLE `contratosFK` ADD FOREIGN KEY (`id`) REFERENCES `Desembolsos` (`id_tipo_desembolso`);

ALTER TABLE `facturas_por_pagarFK` ADD FOREIGN KEY (`id`) REFERENCES `Desembolsos` (`id_tipo_desembolso`);

ALTER TABLE `Desembolsos` ADD FOREIGN KEY (`id_transferencia`) REFERENCES `TransferenciasInternas` (`id`);

ALTER TABLE `FlujoCaja` ADD FOREIGN KEY (`id_desembolsos`) REFERENCES `Desembolsos` (`id`);

ALTER TABLE `FlujoCaja` ADD FOREIGN KEY (`id_organizacion`) REFERENCES `organizacionesFK` (`organizacion_id`);