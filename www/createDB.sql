DROP DATABASE IF EXISTS SWAG;
CREATE DATABASE SWAG;
USE SWAG;

DROP TABLE IF EXISTS things;/*таблица вещей*/
CREATE TABLE things (
	id INT(5) AUTO_INCREMENT,/*id*/
	PRIMARY KEY (id),
	user_id INT(5),/*id пользователя,который залил (из cookie, session берется)*/
	thingType CHAR(20),/*Тип вещи*/
	rating INT(5),/*Рейтинг вещи*/
	countReview int(10),/*Кол-во просмотр*/
	puctureOne mediumblob,/*Картинка1*/
	puctureTwo mediumblob,/*Картинка2*/
	puctureThree mediumblob,/*Картинка3*/
	cost DECIMAL(10,2),/*цена*/
	name CHAR(40),/*название*/
	description CHAR(100)/*Описание*/);

/*	пока не надо
DROP TABLE IF EXISTS thingsComments;
CREATE TABLE thingsComments (
	id INT(5) AUTO_INCREMENT,
	thing_id INT(5),
	user_id INT(5),
	comment CHAR(200));
*/

DROP TABLE IF EXISTS users;/*таблица вещей*/
CREATE TABLE users (
	user_id INT(5) AUTO_INCREMENT,/*id*/
	PRIMARY KEY (user_id),
	name CHAR(40),/*Имя*/
	login CHAR(20),/*login*/
	password CHAR(50),/*пароль*/
	email CHAR(40),/*почта*/
	rating INT(5),/*Рейтинг*/
	foto mediumblob,/*фотография*/
	phone CHAR(20) DEFAULT NULL,/*телефон(не обязательное поле для заполнения)*/
	city CHAR(20)/*Город*/
	key CHAR(50) /*Ключ для авторизации*/);