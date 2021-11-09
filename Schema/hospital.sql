DROP DATABASE Hospital;

-- GUIA PRACTICA SUBCONSULTAS Y STORE PROCEDURES. Toloza Leandro // Julieta Wilson // UTN - Mar Del Plata - 2021

CREATE DATABASE Hospital;

USE Hospital;

create table departamento(
	id_departamento int not null auto_increment,
    nombre varchar(100) not null,
    localidad varchar(100) not null,
    constraint pk_id_departamento primary key (id_departamento)
);

create table empleado(
	id_empleado int not null auto_increment,
    id_departamento int null,
    apellido varchar(100) not null,
    oficio varchar(100) not null,
    salario double not null,
    dir int null,
    comision varchar(100) not null,
    fecha_alta datetime not null,
    CONSTRAINT pk_id_empleado PRIMARY KEY (id_empleado),
	CONSTRAINT FK_empleado_departamento FOREIGN KEY (id_departamento) REFERENCES departamento(id_departamento)
);

create table hospital(
	id_hospital int not null auto_increment,
	nombre varchar(100) not null,
    direccion varchar(100) not null,
    telefono varchar(100) not null,
    cantidad_camas int not null,
	CONSTRAINT PK_hospital PRIMARY KEY(id_hospital)
);

CREATE TABLE doctor(
	id_doctor int not null auto_increment,
	id_hospital int,
    apellido varchar(100) not null,
    especialidad varchar(100) not null,
	CONSTRAINT PK_Doctor PRIMARY KEY(id_doctor),
	CONSTRAINT FK_Doctor_Hospital FOREIGN KEY (id_hospital) REFERENCES hospital(id_hospital)
);

CREATE TABLE sala(
    id_sala int not null,
    id_hospital int,
	nombre varchar(100) not null,
	num_cama int not null,
	CONSTRAINT PK_sala PRIMARY KEY(id_sala,num_cama),
	CONSTRAINT FK_Sala_Hospital FOREIGN KEY (id_hospital) REFERENCES hospital(id_hospital)
);

CREATE TABLE enfermo(
	id_enfermo int not null auto_increment,
    apellido varchar(100) not null,
    direccion varchar(100) not null,
    fecha_nac date,
    genero char,
    dni varchar(8) not null unique,
	CONSTRAINT PK_enfermo PRIMARY KEY(id_enfermo)
);

CREATE TABLE plantilla
(
	id_plantilla int not null auto_increment,
	id_empleado int not null,
    id_sala int not null,
    id_hospital int not null,
    id_enfermo int not null,
    diagnostico varchar(100) not null,
	CONSTRAINT PK_Plantilla PRIMARY KEY(id_plantilla),
	CONSTRAINT FK_Plantilla_Sala FOREIGN KEY (id_sala) REFERENCES sala(id_sala),
    CONSTRAINT FK_Plantilla_hospital FOREIGN KEY (id_hospital) REFERENCES sala(id_hospital),
	CONSTRAINT FK_empleado FOREIGN KEY (id_empleado) REFERENCES empleado(id_empleado),
	CONSTRAINT FK_enfermo FOREIGN KEY (id_enfermo) REFERENCES enfermo(id_enfermo)
);

INSERT INTO departamento(nombre,localidad) VALUES('CONTABILIDAD','Las Toninas');
INSERT INTO departamento(nombre,localidad) VALUES('INFORMATICA','Mar Del Plata');
INSERT INTO departamento(nombre,localidad) VALUES('VENTAS','Santa Teresita');
INSERT INTO departamento(nombre,localidad) VALUES('INVESTIGACION','Costa del Este');
INSERT INTO departamento(nombre,localidad) VALUES('PRODUCCION','Aguas Verdes');

INSERT INTO empleado(apellido, oficio, dir, fecha_alta, salario, comision, id_departamento)
VALUES
('SANCHEZ','EMPLEADO',7902,'1980-12-17 00:00:00',10400,0,1),
('ARROYO','VENDEDOR',7698,'1981-03-01 00:00:00',208000,39000,1),
('SALA','VENDEDOR',689,'1981-04-01 00:00:00',162500,65000,2),
('JIMENEZ','DIRECTOR',7839,'1981-05-01 00:00:00',386750,0,2),
('MARTIN','VENDEDOR',7698,'2003-06-11 00:00:00',182000,182000,3),
('NEGRO','DIRECTOR',7839,'2004-07-01 00:00:00',370500,0,3),
('CEREZO','DIRECTOR',7839,'2004-08-01 00:00:00',318500,0,4),
('NINO','ANALISTA',7566,'2004-02-09 00:00:00',390000,0,4),
('REY','PRESIDENTE',0,'1987-10-03 00:00:00',650000,0,4),
('TOVAR','VENDEDOR',7698,'1989-12-04 00:00:00',195000,0,4),
('ALONSO','EMPLEADO',7788,'1991-12-05 00:00:00',143000,0,5),
('JIMENO','EMPLEADO',7698,'1999-12-05 00:00:00',123500,0,5),
('FERNANDEZ','ANALISTA',7566,'1981-02-21 00:00:00',390000,0,2),
('MUÑOZ','EMPLEADO',7782,'2021-02-11 00:00:00',169000,0,1),
('SERRA','DIRECTOR',7839,'2021-02-11 00:00:00',225000,39000,2),
('GARCIA','EMPLEADO',7119,'2020-02-01 00:00:00',129000,0,5);

INSERT INTO hospital(nombre,direccion,telefono, cantidad_camas) VALUES('Provincial','O Donell 50','964-4256',502);
INSERT INTO hospital(nombre,direccion,telefono, cantidad_camas) VALUES('General','Atocha s/n','595-3111',987);
INSERT INTO hospital(nombre,direccion,telefono, cantidad_camas) VALUES('La Paz','Castellana 1000','923-5411',412);
INSERT INTO hospital(nombre,direccion,telefono, cantidad_camas) VALUES('San Carlos','Ciudad Universitaria','597-1500',845);

INSERT INTO doctor(id_hospital,apellido,especialidad) VALUES(1,'Cabeza D.','Psiquiatría');
INSERT INTO doctor(id_hospital,apellido,especialidad) VALUES(2,'Best D.','Urología');
INSERT INTO doctor(id_hospital,apellido,especialidad) VALUES(1,'López A.','Cardiología');
INSERT INTO doctor(id_hospital,apellido,especialidad) VALUES(2,'Galo D.','Pediatría');
INSERT INTO doctor(id_hospital,apellido,especialidad) VALUES(4,'Adams C.','Neurología');
INSERT INTO doctor(id_hospital,apellido,especialidad) VALUES(3,'Miller G.','Ginecología');
INSERT INTO doctor(id_hospital,apellido,especialidad) VALUES(4,'Chuki P.','Pediatría');
INSERT INTO doctor(id_hospital,apellido,especialidad) VALUES(3,'Cajal R.','Cardiología');

INSERT INTO sala(id_sala,id_hospital,nombre,num_cama) VALUES(1,1,'Recuperación',10);
INSERT INTO sala(id_sala,id_hospital,nombre,num_cama) VALUES(1,1,'Recuperación',15);
INSERT INTO sala(id_sala,id_hospital,nombre,num_cama) VALUES(2,2,'Maternidad',34);
INSERT INTO sala(id_sala,id_hospital,nombre,num_cama) VALUES(2,4,'Maternidad',24);
INSERT INTO sala(id_sala,id_hospital,nombre,num_cama) VALUES(3,1,'Cuidados Intensivos',21);
INSERT INTO sala(id_sala,id_hospital,nombre,num_cama) VALUES(3,3,'Cuidados Intensivos',10);
INSERT INTO sala(id_sala,id_hospital,nombre,num_cama) VALUES(4,3,'Cardiología',53);
INSERT INTO sala(id_sala,id_hospital,nombre,num_cama) VALUES(4,4,'Cardiología',55);
INSERT INTO sala(id_sala,id_hospital,nombre,num_cama) VALUES(6,2,'Psiquiátricos',67);
INSERT INTO sala(id_sala,id_hospital,nombre,num_cama) VALUES(6,3,'Psiquiátricos',118); 

INSERT INTO enfermo(apellido,direccion,fecha_nac,genero,dni)
VALUES
('Laguía M.','Goya 20','1998-12-12','M',28086242),
('Fernández M.','Recoletos 50','1980-04-17','F',28499142),
('Serrano V.','Alcalá 12','1992-09-25','F',32190059),
('Domin S.','Mayor 71','1977-09-23','M',16065471),
('Neal R.','Orense 11','1960-02-22','F',38001217),
('Cervantes M.','Perón 38','1978-05-08','M',44029390),
('Miller B.','López de Hoyos 2','1982-11-07','F',31969044),
('Ruiz P.','Ezquerdo 103','1994-07-15','M',10097253),
('Fraiser A.','Soto 3','1991-05-09','F',28521776),
('Benítez E.','Argentina','1988-08-05','M',15411767);

INSERT INTO plantilla(id_hospital,id_sala,id_empleado,id_enfermo,diagnostico)
VALUES
(1,1,1,1,'Esta Enfermo'),
(1,1,1,2,'Gripe'),
(2,2,2,3,'Tuberculosis'),
(1,1,1,4,'Renitis Aguda'),
(1,1,1,5,'Hepatitis B'),
(1,1,1,6,'Hepatitis A'),
(1,1,1,7,'Varicela'),
(1,1,1,8,'Covid'),
(1,1,1,9,'Conjuntivitis'),
(1,1,1,10,'Excoleosis');

Select * from departamento;
Select * from doctor;
Select * from empleado;
Select * from enfermo;
Select * from hospital;
Select * from sala;
Select * from plantilla;

-- SUBCONSULTAS

-- 1. Mostrar el numero de empleado, el apellido y la fecha de alta del empleado mas antiguo de la empresa

select id_empleado, apellido, fecha_alta 
from empleado 
where (select min(fecha_alta) from empleado) = fecha_alta;

select * from empleado where apellido like 'S%';


-- 2. Mostrar el numero de empleado, el apellido y la fecha de alta del empleado mas modernos de la empresa

select id_empleado, apellido, fecha_alta 
from empleado 
where (select max(fecha_alta) from empleado)= fecha_alta;


-- 3. Mostrar el apellido y el oficio de los empleados con el mismo oficio que Arroyo.

select id_empleado, apellido, oficio 
from empleado 
where (select oficio from empleado where apellido = 'ARROYO') = oficio;

-- 4. Mostrar apellidos y oficio de los empleados del departamento 2 cuyo trabajo sea el mismo que el de cualquier empleado de ventas.

select apellido, oficio 
from empleado 
where  id_departamento = 2 
and oficio in (select oficio from empleado where id_departamento = (select id_departamento from departamento where nombre='VENTAS')) ;

-- 5. Mostrar los empleados que tienen mejor salario que la media de los vendedores, no incluyendo al presidente.

select * from empleado
where salario > (select avg(salario) from empleado)  and oficio <> 'PRESIDENTE';

-- 6. Mostrar los hospitales que tienen personal (Doctores) de cardiología.

select id_hospital, nombre from hospital
where id_hospital in (select id_hospital from doctor where especialidad  ='cardiología');

-- 7. Visualizar el salario anual de los empleados de la plantilla del Hospital Provincial y General. (Realizar con subconsulta)

select id_departamento, salario * 12 + comision as salario_anual 
from empleado where id_empleado in 
(select id_empleado from plantilla where id_hospital in
(select id_hospital from hospital where nombre in ('Provincial', 'General')));

-- 8. Realizar el ejercicio anterior pero sin subconsultas

select salario * 12 + comision as salario_anual
from hospital h
inner join plantilla p on h.id_hospital = p.id_hospital
inner join empleado e on p.id_empleado = e.id_empleado
where nombre in ('Provincial', 'General')
group by e.id_empleado;

SELECT E.apellido, E.salario * 12 + E.comision Anual 
FROM empleado E
INNER JOIN plantilla P ON E.id_empleado = P.id_empleado
INNER JOIN hospital H ON P.id_hospital = H.id_hospital
WHERE h.nombre = "Provincial" OR h.nombre = "General" 
GROUP BY E.id_empleado;

-- 9. Mostrar el apellido de los pacientes que nacieron antes que el Señor Miller.

select apellido
from enfermo
where  fecha_nac < (select fecha_nac from enfermo where apellido like '%MILLER%');

-- STORE PROCEDURES

-- 1 - Sacar todos los empleados que se dieron de alta entre una determinada fecha inicial y fecha final y que pertenecen a un determinado departamento.

DELIMITER $$
create procedure Drop_empleador_alta(fecha_inicial datetime, fecha_final datetime, nombre_dpto varchar(100))
BEGIN

DROP from empleado e where e.fecha_alta > fecha_inicial and e.fecha_alta < fecha_final
and nombre_dpto in (select nombre from departamento);

END;
$$

DELIMITER ;

call sacarEmpleXFechaAlta(NOW(), NOW(), 'INFORMATICA');

-- 2 - Crear procedimiento que nos devuelva salario, oficio y comisión, pasándole el apellido.

DELIMITER $$
drop procedure if exists datoEmpleado;

create procedure  datoEmpleado(apellido varchar(50))
BEGIN

	select e.apellido, e.salario, e.oficio, e.comision
    from empleado  e
    where e.apellido = apellido;

END;
$$
DELIMITER ;

call datoEmpleado("arroyo");

-- 3 - Crear un procedimiento para mostrar el salario, oficio, apellido y nombre del departamento de todos los empleados que contengan en su apellido el valor que le pasemos como parámetro.

DELIMITER $$
drop procedure if exists datoXEmpleado;
create procedure datoXEmpleado(IN letra varchar(50))
BEGIN

	select e.apellido, e.salario, e.oficio, e.comision
    from empleado e
    left join departamento d on d.id_departamento = e.id_departamento
     where e.apellido like %letra%;
    /*where e.apellido like 'A%';*/
   
    
END;
$$
DELIMITER ;

call datoXEmpleado('ARR');
-- 4 - Crear un procedimiento que recupere el número departamento, el nombre y número de empleados, dándole como valor el nombre del departamento, 
--     si el nombre introducido no es válido, mostraremos un mensaje informativo comunicándolo.


