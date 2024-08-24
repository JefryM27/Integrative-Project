
CREATE DATABASE cobros;


USE cobros;


CREATE TABLE cobro_administrativo (
    cobro_administrativo_id INTEGER PRIMARY KEY,
    numero_caso_id INTEGER,
    fecha_cobro TIMESTAMP,
    monto_cobro DOUBLE,
    estado VARCHAR(255),
    descripcion TEXT
);


CREATE TABLE cobro_judicial (
    cobro_judicial_id INTEGER PRIMARY KEY,
    cobro_administrativo_id INTEGER,
    numero_caso_id INTEGER,
    fecha_cobro TIMESTAMP,
    monto_cobro DOUBLE,
    estado VARCHAR(255),
    descripcion TEXT,
    nombre_abogado VARCHAR(255),
    FOREIGN KEY (cobro_administrativo_id) REFERENCES cobro_administrativo(cobro_administrativo_id)
);
