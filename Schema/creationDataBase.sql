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
	active boolean,
	industry varchar(50)
);

-- CREATION OF TABLE: JOBPOSITIONS
create table jobPositions
(
	jobPositionIdFromDB int auto_increment primary key, 
	jobPositionId int not null,
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

-- CREATION OF TABLE: STUDENTS
create table students(
	studentId int auto_increment primary key, 
	email varchar(50), 
	password varchar(50)
);

-- CREATION OF TABLE: ADMINISTRATOR
create table administrators
(
	administratorId int auto_increment primary key, 
	userName varchar(50), 
	password varchar(50)
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
	salary int,
	jobPositionId int not null,
	dedication varchar(50),
	companyId int not null,
	administratorId int not null,
	foreign key (jobPositionId) references jobPositions(jobPositionIdFromDB),
	foreign key (companyId) references companies(companyId),
	foreign key (administratorid) references administrators(administratorid)
);

create table appointments(
    studentId int not null, 
    jobOfferId int not null,
    cv varchar(100),
    dateAppointment dateTime,
    referenceURL varchar(100),
	foreign key (jobOfferId) references joboffers(jobOfferId),
    foreign key (studentId) references students(studentId),

    constraint appointmentId primary key (studentId, jobOfferId)
);

DELIMITER $$
DROP PROCEDURE IF EXISTS cv_add $$
CREATE PROCEDURE cv_add(IN name VARCHAR(100), IN stuId INT, IN jobId INT)
BEGIN
    UPDATE appointments
    SET cv = name
    WHERE studentId = stuId AND jobOfferId = jobId;
END$$

DELIMITER ;

-- INSERT
INSERT INTO administrators VALUES
(default, "Mati", "tobi");

-- DELETE 
DELETE FROM administrators WHERE administratorId > -1;
DELETE FROM companies WHERE companyId > -1;
DELETE FROM students WHERE studentId > -1;
DELETE FROM joboffers WHERE jobofferId > -1;

-- DELETE 
USE jobsforstudents;
DROP TABLE joboffers;

-- SELECT
SELECT * FROM administrators;
SELECT * FROM students;
SELECT * FROM appointments;

use jobsforstudents;
SELECT * FROM students;