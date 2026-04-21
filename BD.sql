create database personas;
use personas;

create table usuarios(
    id int auto_increment primary key,
    nombre char(50) not null,
    apellido char(50) not null,
    dni char(50) not null,
    correo char(100) not null,
    password char(50) not null
);

delimiter //

create procedure sp_registrar(
    in _nom char(50), 
    in _ape char(50), 
    in _dni char(50), 
    in _cor char(100), 
    in _pass char(50)
)
begin
    insert into usuarios (nombre, apellido, dni, correo, password)
    values (_nom, _ape, _dni, _cor, _pass);
    commit;
end //

create procedure sp_login(
    in _cor char(100), 
    in _pass char(50)
)
begin
    select * from usuarios where correo = _cor and password = _pass;
end //

create procedure sp_recuperar(
    in _cor char(100),
    in _nueva_pass char(50)
)
begin
    update usuarios
    set password = _nueva_pass
    where correo = _cor;
end //

create procedure sp_mostrar(in _id int)
begin
    select id, nombre, apellido, dni, correo
    from usuarios
    where id = _id;
end //

delimiter ;