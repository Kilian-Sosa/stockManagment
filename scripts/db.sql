-- tienda Table
create table if not exists tiendas(
 id int auto_increment primary key,
 nombre varchar(100) not null,
 tlf varchar(13) null
);
-- familia Table
create table if not exists familias(
 cod varchar(6) primary key,
 nombre varchar(200) not null
);
-- producto Table
create table if not exists productos(
 id int auto_increment primary key,
 nombre varchar(200) not null,
 nombre_corto varchar(50) unique not null,
 descripcion text null,
 pvp decimal(10, 2) not null,
 familia varchar(6) not null,
 constraint fk_prod_fam foreign key(familia) references familias(cod) on update
cascade on delete cascade
);
-- stocks Table
create table if not exists stocks(
 producto int,
 tienda int,
 unidades int unsigned not null,
 constraint pk_stock primary key(producto, tienda),
 constraint fk_stock_prod foreign key(producto) references productos(id) on update
cascade on delete cascade,
 constraint fk_stock_tienda foreign key(tienda) references tiendas(id) on update
cascade on delete cascade
);
-- usuarios Table
create table usuarios(
usuario varchar(20) primary key,
clave varchar(64) not null,
nombrecompleto varchar(200) not null,
correo varchar(50) not null,
colorfondo varchar(7) not null default 'EFF5F5',
tipoletra varchar(30) not null default 'Arial'
);
