DROP DATABASE JobsForStudents;
drop table careers;
drop table appointments;
drop table joboffers;
drop table companies;
drop table jobpositions;
drop table joboffers;
drop table companies;

-- CREATION OF THE DATABASE "JOBSFORSTUDENTS" 
CREATE DATABASE JobsForStudents;

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
	industry varchar(50),
    companyUserId int,
    foreign key (companyUserId) references users (userId)
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
-- CREATION OF TABLE: Roles
create table roles(
	roleId int auto_increment primary key,
	userRole varchar(50)
);

-- CREATION OF TABLE: users
create table users(
	userId int auto_increment primary key,
	email varchar(50), 
	password varchar(50),
	roleId int not null, 
	foreign key (roleId) references roles(roleId)
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

CREATE TABLE cvs
(
    cvId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name NVARCHAR(100) NOT null,
    studentId int,
    foreign key (studentId) references users(userId)
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
insert into roles (userRole) values 
('admin'),
('student'),
('company');

INSERT INTO users VALUES
(default, "Company@gmail.com", "123", 3),
(default, "Company2@gmail.com", "123", 3),
(default, "Mati@gmail.com", "123", 1);

update joboffers set finishDate = '2019-03-20' where jobOfferId > 0;
update joboffers set finishDate = '2022-03-20' where jobOfferId > 0;

update joboffers set active = 1 where jobOfferId > 0;

-- DELETE 
DELETE FROM companies WHERE companyId > -1;
DELETE FROM joboffers WHERE jobofferId > -1;
DELETE FROM appointments WHERE jobofferId > -1;
DELETE FROM users WHERE userId > -1;
DELETE FROM cvs WHERE cvId > -1;
DELETE FROM roles WHERE roleId > 2;

-- SELECT
SELECT * FROM roles;
SELECT * FROM users;
SELECT * FROM appointments;
SELECT * FROM joboffers;
SELECT * FROM companies;
SELECT * FROM cvs;