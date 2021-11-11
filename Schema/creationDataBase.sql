-- CREATION OF THE DATABASE "JOBSFORSTUDENTS" 
CREATE DATABASE JobsForStudents;

-- TO USE THIS DATABASE
use JobsForStudents;

drop table careers;
drop table appointments;
drop table joboffers;
drop table companies;
drop table jobpositions;
drop table joboffers;
drop table companies;

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
	jobPositionId int not null primary key,
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
	salary int,
	jobPositionId int not null,
	dedication varchar(50),
	companyId int not null,
	administratorId int not null,
	foreign key (companyId) references companies(companyId),
	foreign key (administratorid) references users(userId)
);

create table appointments(
    studentId int not null, 
    jobOfferId int not null,
    cv varchar(100),
    dateAppointment dateTime,
    referenceURL varchar(100),
    comments varchar(150),
    active boolean,
	foreign key (jobOfferId) references joboffers(jobOfferId),
    foreign key (studentId) references users(userId),

    constraint appointmentId primary key (studentId, jobOfferId)
);

create table roles(
	roleId int auto_increment primary key,
	userRole varchar(50)
);

insert into roles (userRole) values 
('admin'),
('student');

create table users(
	userId int auto_increment primary key,
	email varchar(50), 
	password varchar(50),
	roleId int not null, 
	foreign key (roleId) references roles(roleId)
);

CREATE TABLE cvs
(
    cvId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name NVARCHAR(100) NOT NULL
)Engine=InnoDB;

DELIMITER $$
CREATE PROCEDURE cv_add(IN Name VARCHAR(100))
BEGIN
    INSERT INTO cvs
        (name)
    VALUES
        (name);

END$$
DELIMITER ;

-- INSERT
INSERT INTO users VALUES
(default, "Mati@gmail.com", "123", 1);

-- DELETE 
DELETE FROM companies WHERE companyId > -1;
DELETE FROM joboffers WHERE jobofferId > -1;
DELETE FROM appointments WHERE jobofferId > -1;
DELETE FROM users WHERE userId > -1;
DELETE FROM cvs WHERE cvId > -1;

update companies set active = 1 where companyId  = 1;
update appointments set active = 1 where studentid  > 0;


-- SELECT
SELECT * FROM administrators;
SELECT * FROM users;
SELECT * FROM appointments;
SELECT * FROM joboffers;
SELECT * FROM companies;
SELECT * FROM cvs;