-- CREATION OF THE DATABASE "JOBSFORSTUDENTS" 
create database JobsForStudents;

-- TO USE THIS DATABASE
use JobsForStudents;

-- CREATION OF TABLE: COMPANIES
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

-- CREATION OF TABLE: JOBPOSITIONS
create table jobPositions
(
	jobPositionId int, 
	careerId int,
	description varchar(100)
);

-- CREATION OF TABLE: CAREERS
create table careers
(
	careerId int auto_increment primary key, 
	title varchar(50), 
	description varchar(100),
	active boolean
);

-- CREATION OF TABLE: JOBOFFERS
create table jobOffers
(
	jobOfferId int auto_increment primary key,
	title varchar(50),
	publishedDate date,
	finishDate date,
	task varchar(100),
	skills varchar(100),
	active boolean,
	remote boolean,
	salary int
);

-- CREATION OF TABLE: ADMINISTRATOR
create table administrators
(
	administratorId int auto_increment primary key, 
	userName varchar(50), 
	password varchar(50)
);

-- CREATION OF TABLE: STUDENTS
create table students(
	studentId int auto_increment primary key, 
	email varchar(50), 
	password varchar(50)
);

/*-- CREATION OF TABLE: APPOINTMENT
create table appointment
(
	appointmentId int auto_increment primary key, 
	dateAppointment varchar(50), 
	referenceURL varchar(100),
);*/