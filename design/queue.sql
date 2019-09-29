create database if not exists queue charset=utf8;
use queue;
create table if not exists users(
    id mediumint unsigned auto_increment,
    username varchar(191) not null,
    password varchar(191) not null,
    email varchar(191) not null,
    phone varchar(191) not null,
    status tinyint default 0,
    active_code varchar(32) not null,
    active_status tinyint default 0,
    primary key(id),
    unique key uk_username(username),
    key idx_email(email),
    key idx_phone(phone),
    key idx_status(status),
    key idx_active_code(active_code),
    key idx_active_status(active_status)
)charset=utf8,engine=innodb;