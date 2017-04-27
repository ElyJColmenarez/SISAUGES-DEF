-- Database: "SISAUGES-MEB"

-- DROP DATABASE "SISAUGES-MEB";

--CREATE DATABASE "SISAUGES-MEB"
  --WITH ENCODING='UTF8'
    --   OWNER=postgres
    --   LC_COLLATE='es_VE.UTF-8'
    --   LC_CTYPE='es_VE.UTF-8'
    --   CONNECTION LIMIT=-1
    --   TABLESPACE=pg_default;

CREATE TABLE IF NOT EXISTS PERSONA
(
	id_persona serial not null,
	cedula varchar not null,
	nombre varchar(30),
	apellido varchar(30),
	email varchar(30) not null,
	telefono varchar(11),
	estatus boolean,
	constraint pk_persona 
		primary key (id_persona),
	constraint cedula_unica
		unique (cedula)
);

--drop table persona;


CREATE TYPE estatus AS ENUM
(
	'No iniciado',
	'En progreso',
	'Culminado'
);

--DROP TYPE estatus;

CREATE TYPE PERMISOS AS ENUM
(		
	'Publico',
	'Privado'
);

--DROP TYPE PERMISOS;


CREATE TABLE IF NOT EXISTS SECTOR_PROYECTO
(
	id_sector_pr serial,
	descripcion_sector varchar(20),
	estatus boolean,
	constraint pk_setor_proyecto
		primary key (id_sector_pr)
);

--drop table sector_proyecto;


CREATE TABLE IF NOT EXISTS PROYECTO
(
	id_proyecto serial,
	nombre_proyecto varchar(30) not null,
	status_proyecto estatus not null,
	permiso_proyecto PERMISOS not null,
	id_sector_pr integer,
	fecha_inicio date,
	fecha_final date,
	constraint pk_proyecto
		primary key (id_proyecto),
	constraint fk_sector_proyecto
		foreign key (id_sector_pr) references sector_proyecto(id_sector_pr)
);

--drop table proyecto;



CREATE TABLE IF NOT EXISTS ESTUDIANTE
(
	id_estudiante serial,
	carrera_estudiante varchar(25),
	semestre_estudiante varchar (5),
	id_proyecto integer,
	cedula_persona varchar(12),
	estatus boolean,
	constraint pk_estudiante
		primary key (id_estudiante),
	constraint fk_proyecto_estudiante
		foreign key (id_proyecto) references proyecto(id_proyecto),
	constraint fk_persona_estudiante
		foreign key (cedula_persona) references persona(cedula)
);

--drop table estudiante

CREATE TABLE IF NOT EXISTS INSTITUCION
(
	id_institucion serial,
	nombre_institucion varchar(100) not null,
	direccion_institucion varchar(100),
	correo_institucional varchar(30) not null,
	telefono_institucion varchar(12),
	estatus boolean,
	constraint pk_institucion
		primary key (id_institucion)
);

--drop table institucion;

CREATE TABLE IF NOT EXISTS DEPARTAMENTO
(
	id_departamento serial,
	descripcion_departamento varchar(30),
	id_institucion int,
	estatus boolean,
	constraint pk_departamento
		primary key (id_departamento),
	constraint fk_institucion
		foreign key (id_institucion) references institucion (id_institucion)
);

--DROP TABLE DEPARTAMENTO;

CREATE TABLE IF NOT EXISTS INSTITUCION_PROYECTO
(
	id_institucion integer,
	id_proyecto integer,
	constraint pk_IP
		primary key (id_institucion, id_proyecto),
	constraint fk_institucion
		foreign key (id_institucion) references institucion (id_institucion),
	constraint fk_proyecto
		foreign key (id_proyecto) references proyecto (id_proyecto)
);

--drop table institucion_proyecto;

CREATE TABLE IF NOT EXISTS STATUS_TUTOR
(
    id_status serial,
    fecha_ingreso date,
    fecha_egreso date,
    observaciones varchar(300),
    constraint pk_status_tutor
		primary key (id_status)
);

--drop table status_TUTOR
    

CREATE TABLE IF NOT EXISTS TUTOR
(
	id_tutor serial,
	id_departamento int,
	cedula_persona varchar(12),
	id_status int,
	estatus boolean,
	constraint pk_tutor 
		primary key (id_tutor),
	constraint fk_departamento
		foreign key (id_departamento) references departamento (id_departamento),
	constraint fk_persona_tutor
		foreign key (cedula_persona) references persona(cedula),
	constraint fk_tutor_status
		foreign key (id_status) references status_tutor(id_status)

);
	
--drop table tutor;


CREATE TABLE IF NOT EXISTS ROL_USUARIO
(
	id_rol serial,
	descripcion_rol varchar(30),
    	estatus boolean,
	constraint pk_rol_de_usuario 
		primary key (id_rol)
);

--drop table nivel_de_usuario;

CREATE TABLE IF NOT EXISTS USUARIO
(
	id_usuario serial,
	username varchar(20),
	password varchar(60),
	id_rol int,
	cedula_persona varchar(12),
	estatus boolean,
	remember_token varchar(100),
	constraint pk_usuario
		primary key (id_usuario),
	constraint fk_rol_usuario
		foreign key (id_rol) references ROL_USUARIO (id_rol),
	constraint fk_persona_
		foreign key (cedula_persona) references persona(cedula)
);

--drop table usuario;


CREATE TABLE IF NOT EXISTS MUESTRA
(
  id_muestra serial NOT NULL,
  codigo_muestra varchar(200),
  nombre_original_muestra character varying(200),
  tipo_muestra character varying(200),
  descripcion_muestra character varying(200),
  fecha_recepcion date,
  fecha_analisis date,
  estatus boolean,
  CONSTRAINT pk_muestra PRIMARY KEY (id_muestra)
);

--drop table muestra

CREATE TABLE IF NOT EXISTS TECNICA_ESTUDIO
(
	id_tecnica_estudio serial,
	descripcion_tecnica_estudio varchar(30),
    estatus boolean,
	constraint pk_tecnica_estudio 
		primary key (id_tecnica_estudio)
);

--drop table tecnica_estudio

CREATE TABLE IF NOT EXISTS MUESTRA_TECNICA_ESTUDIO
(
	id_tecnica_estudio integer,
	id_muestra integer,
	constraint pk_tecnica_estudio_muestra 
		primary key (id_tecnica_estudio,id_muestra),
	constraint fk_tecnica_estudio_MTE
		foreign key (id_tecnica_estudio) references tecnica_estudio(id_tecnica_estudio),
	constraint fk_muestra_MTE
		foreign key (id_muestra) references muestra (id_muestra)
);

--drop table muestra_tecnica_estudio

CREATE TABLE IF NOT EXISTS MUESTRA_PROYECTO
(

	id_proyecto integer not null,
	id_muestra integer not null,
	ruta_img_muestra varchar(200),
	fecha_analisis date,
	constraint fk_proyecto
		foreign key (id_proyecto) references proyecto(id_proyecto),
	constraint fk_muestra
		foreign key (id_muestra) references muestra (id_muestra)
);

--drop table muestra_proyecto;

CREATE TABLE IF NOT EXISTS LABORATORIO
(
	id_laboratorio serial,
	nombre_laboratorio varchar(20),
	ubicacion_laboratorio varchar(50),
	telefono_laboratorio varchar(13),
    estatus boolean,
	constraint pk_laboratorio
		primary key (id_laboratorio)
);

--drop table laboratorio

CREATE TABLE IF NOT EXISTS MUESTRA_LABORATORIO
(
	id_muestra integer,
	id_laboratorio integer,
	constraint pk_laboratorio_muestra 
		primary key (id_muestra,id_laboratorio),
	constraint fk_muestra
		foreign key (id_muestra) references muestra(id_muestra),
	constraint fk_laboratorio
		foreign key (id_laboratorio) references laboratorio (id_laboratorio)
);

--DROP TABLE MUESTRA_LABORATORIO




--insert into tutor(cedula, nombre, apellido, correo_electronico, telefono) values(18491779,'ely','colmenarez','elyjcolmenarez@gmail.com','02124430191');
--select * from persona


CREATE TABLE IF NOT EXISTS AUXIMG
(

	auxid serial,
	description_img varchar(200),
	orgpage_img varchar(200),
	idmues int
	

);


CREATE TABLE IF NOT EXISTS auditoria
(
  id_auditoria serial NOT NULL,
  modulo character varying(100),
  operacion character varying(60),
  descripcion character varying(2000),
  usuario character varying(200),
  fecha date,
  CONSTRAINT pk_auditoria PRIMARY KEY (id_auditoria)
);
