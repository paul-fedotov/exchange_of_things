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

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` char(40) DEFAULT NULL,
  `login` char(20) DEFAULT NULL,
  `password` char(100) DEFAULT NULL,
  `email` char(40) DEFAULT NULL,
  `rating` int(5) DEFAULT NULL,
  `foto` mediumblob,
  `phone` char(30) DEFAULT NULL,
  `city` char(20) DEFAULT NULL,
  `key` char(100) NOT NULL,
  PRIMARY KEY (`user_id`)
);
/*связи надо еще*/
DROP TABLE IF EXISTS `exchanges`;
CREATE TABLE IF NOT EXISTS `exchanges` (/*дату нужно (или не нужно) и т.д.*/
	id int(5) NOT NULL AUTO_INCREMENT,
	toUser int(5),/*кому*/
	fromUser int(5),/*от кого*/
	toThing CHAR(100),/*на что меняем (из чужих)*/
	fromThing CHAR(100),/*что меняем (из своих)*/
	comments CHAR(255),
	sost BOOLEAN,
	PRIMARY KEY (id)
);