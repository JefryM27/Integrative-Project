CREATE TABLE tipo_producto (
  tipo_producto_id INTEGER PRIMARY KEY,
  nombre VARCHAR(255),
  descripcion TEXT
);

CREATE TABLE producto (
  producto_id INTEGER PRIMARY KEY,
  nombre VARCHAR(255),
  tipo_producto_id INTEGER,
  tasa_interes DOUBLE,
  saldo_inicial DOUBLE,
  requisitos TEXT,
  beneficios TEXT,
  FOREIGN KEY (tipo_producto_id) REFERENCES tipo_producto(tipo_producto_id)
);

CREATE TABLE intereses_cliente (
  interes_cliente_id INTEGER PRIMARY KEY,
  cliente_id INTEGER,
  producto_id INTEGER,
  fecha_interes TIMESTAMP,
  comentario TEXT,
  FOREIGN KEY (producto_id) REFERENCES producto(producto_id)
);

CREATE TABLE producto_cliente (
  producto_cliente_id INTEGER PRIMARY KEY,
  cliente_id INTEGER,
  producto_id INTEGER,
  caso_id INTEGER,
  fecha_adquisicion TIMESTAMP,
  monto DOUBLE,
  plazo INTEGER,
  intereses_cliente_id INTEGER,
  estado VARCHAR(255),
  FOREIGN KEY (producto_id) REFERENCES producto(producto_id),
  FOREIGN KEY (intereses_cliente_id) REFERENCES intereses_cliente(interes_cliente_id)
);

CREATE TABLE Movimientos (
  movimiento_id INTEGER PRIMARY KEY,
  interes_cliente_id INTEGER,
  cliente_id INTEGER,
  producto_id INTEGER,
  monto DOUBLE,
  dia TIMESTAMP,
  comentario TEXT,
  FOREIGN KEY (interes_cliente_id) REFERENCES intereses_cliente(interes_cliente_id),
  FOREIGN KEY (producto_id) REFERENCES producto(producto_id)
);
