DROP TABLE IF EXISTS `camagru`.`users`;
DROP TABLE IF EXISTS `camagru`.`images`;
DROP TABLE IF EXISTS `camagru`.`comments`;
DROP TABLE IF EXISTS `camagru`.`likes`;
DROP DATABASE IF EXISTS `camagru`;

CREATE DATABASE IF NOT EXISTS `camagru`;

CREATE TABLE  IF NOT EXISTS `camagru`.`users` ( 
  `id`            INT(11)         NOT NULL      AUTO_INCREMENT , 
  `username`      VARCHAR(55)     NOT NULL , 
  `email`         VARCHAR(55)     NOT NULL , 
  `password`      VARCHAR(512)    NOT NULL , 
  `hash`          VARCHAR(255)    NOT NULL , 
  `activation`    INT(2)          NOT NULL      DEFAULT '0', 
  `notification`  INT             NOT NULL      DEFAULT '1', 
  `joined`        TIMESTAMP       NOT NULL      DEFAULT CURRENT_TIMESTAMP ,

  PRIMARY KEY (`id`)
  ); 


CREATE TABLE  IF NOT EXISTS `camagru`.`images` ( 
  `id`            INT(11)         NOT NULL      AUTO_INCREMENT , 
  `path`          VARCHAR(128)    NOT NULL , 
  `likes`         INT(11)         NOT NULL      DEFAULT '0', 
  `userId`        INT             NOT NULL , 
  `creation`      TIMESTAMP       NOT NULL      DEFAULT CURRENT_TIMESTAMP ,

  PRIMARY KEY (`id`)
);

CREATE TABLE  IF NOT EXISTS `camagru`.`comments` ( 
  `id`            INT             NOT NULL      AUTO_INCREMENT , 
  `username`      VARCHAR(55)     NOT NULL , 
  `comment`       VARCHAR(512)    NOT NULL , 
  `userId`        INT(11)         NOT NULL , 
  `imgId`         INT(11)         NOT NULL ,

  PRIMARY KEY (`id`)
  ); 


CREATE TABLE  IF NOT EXISTS `camagru`.`likes` ( 
  `userId`        INT(11)         NOT NULL , 
  `imgId`         INT(11)         NOT NULL 
  ); 