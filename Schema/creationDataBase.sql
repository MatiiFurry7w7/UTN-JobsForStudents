create database JobsForStudents;

use JobsForStudents;

create table companies
(
	companyId int auto_increment primary key, 
	name varchar(50), 
	cuit char(11),
	description varchar(100),
	website varchar(50), 
	street varchar(50), 
	number_street char(6), 
	aboutUs varchar(100), 
	active boolean
);

create table jobPositions
(
	jobPositionId int, 
	careerId int,
	description varchar(100)
);

create table carrers
(
	careerId int auto_increment primary key, 
	title varchar(50), 
	description varchar(100),
	active boolean
);