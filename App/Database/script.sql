
create database if not exists upload default character set utf8 collate utf8_unicode_ci;

use upload;

create table imagens (
    id int auto_increment,
    nome varchar(100) not null unique,
    tamanho decimal(7,2) not null,
    endereco varchar(255) not null,
    data_c date,
    primary key(id)
);
