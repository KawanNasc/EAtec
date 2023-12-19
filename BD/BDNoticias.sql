create database PortalNoticias;
use PortalNoticias;

create table usuario (
	cod_usu int primary key auto_increment,
    nv_usu varchar(20) not null,
	nmCompl_usu varchar(70) not null,
    nick_usu varchar(30) not null,
    email_usu varchar(50) not null,
    senha_usu varchar(50) not null,
    perm_usu int(1) not null
);

create table noticia (
  cod_not int primary key auto_increment,
  titu_not varchar(80) not null,
  descr_not varchar(100) not null,
  corpo_not varchar(255) not null,
  img_not varchar(200) not null,
  esp_not varchar(25) not null,
  perm_not int(1) not null,
  usu_not varchar(70) not null
);

insert into usuario values (1, 'Administrador', 'Administrador', 'Administrador', 'adm.adm@gmail.com', '123', 1);

drop table usuario;
drop table noticia;

select * from usuario;
select * from noticia;