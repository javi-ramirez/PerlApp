create database perlapp;
use perlapp;

create table chofer
(
	idchofer int primary key auto_increment,
	nombre_chofer varchar (50),
    correo varchar (20)
);

create table ruta
(
	idruta int primary key auto_increment,
	nombre_ruta varchar (50)
);

create table camion
(
	idcamion int primary key auto_increment,
	numero int
);

create table detalle
(
	iddetalle int primary key auto_increment,
	hora_inicio datetime,
    hora_fin datetime,
    
    fk_idchofer int, constraint fk_chofer_detalle foreign key (fk_idchofer) references chofer (idchofer),
    fk_idruta int, constraint fk_ruta_detalle foreign key (fk_idruta) references ruta (idruta),
	fk_idcamion int, constraint fk_camion_detalle foreign key (fk_idcamion) references camion (idcamion)
 
	ON DELETE CASCADE
	ON UPDATE CASCADE
    
    
);



create table comentario
(
	idcomentario int primary key auto_increment,
	creador varchar (50),
    comentario varchar (255),
    fecha_hora datetime,
    fk_idcamion int, constraint fk_camion_comentario foreign key (fk_idcamion) references camion (idcamion)
 
	ON DELETE CASCADE
	ON UPDATE CASCADE
);
