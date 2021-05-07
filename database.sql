create database dbmsdb;
use dbmsdb;

CREATE TABLE users (
  usersid int NOT NULL auto_increment primary key,
  usersfname varchar(128) NOT NULL,
  userslname varchar(128) NOT NULL,
  usersemail varchar(128) NOT NULL,
  usersuid varchar(128) NOT NULL,
  userspwd varchar(256) NOT NULL,
  userscode int NOT NULL,
  usersstatus varchar(128) NOT NULL
);

CREATE TABLE profileimg (
  id int NOT NULL auto_increment primary key,
  usersuid varchar(128) NOT NULL,
  pic_status int NOT NULL
);

CREATE TABLE pwdreset (
  pwdresetid int NOT NULL auto_increment primary key,
  pwdresetemail varchar(128) NOT NULL,
  pwdresetselector text NOT NULL,
  pwdresettoken longtext NOT NULL,
  pwdresetexpries text NOT NULL
);
