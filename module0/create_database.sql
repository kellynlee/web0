CREATE DATABASE IF NOT EXISTS test;

use test;

CREATE TABLE IF NOT EXISTS jianzhi
(
id smallint(10) NOT NULL AUTO_INCREMENT,
title varchar(20) NOT NULL,
name varchar(20) NOT NULL,
sex varchar(7) NOT NULL,
age int(3) NOT NULL,
phone varchar(11) NOT NULL,
email varchar(36) NULL,
qq varchar(11) NULL,
msn varchar(36) NULL,
content varchar(600) NOT NULL,
time int(10) NOT NULL, 
primary key
);


CREATE TABLE IF NOT EXISTS meishi
(
id smallint(10) NOT NULL AUTO_INCREMENT,
name varchar(20) NOT NULL,
owner varchar(20) NOT NULL,
phone varchar(11) NOT NULL,
content varchar(600) NOT NULL,
time int(10) NOT NULL, 
);
