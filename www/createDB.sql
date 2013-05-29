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



INSERT INTO `users` (`user_id`, `name`, `login`, `password`, `email`, `rating`, `foto`, `phone`, `city`, `key`) VALUES/*тест*/
(1, 'Sergey', 'RME5!6', '0ca9e5597e44aaf4dd1c70c25ca72e82', 'RME5!6_MKW8S]00P', 1, '', 'eroa@', 'Москва', 'FAPeT6QxsY6wvR50D36J2Rn8');