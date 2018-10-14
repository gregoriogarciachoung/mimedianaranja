-- drop database mmm;
create database mmm;
use mmm;
create table interes(
id int primary key auto_increment,
nom varchar(45) unique
);
create table distritos(
id int primary key auto_increment,
nom varchar(45)
);
create table estadoCivil(
id int primary key auto_increment,
nom varchar(45)
);
create table nivelEducacion(
id int primary key auto_increment,
nom varchar(45)
);
create table sexos(
id int primary key auto_increment,
nom varchar(45)
);
create table usuario(
id int primary key auto_increment,
mail varchar(45) unique,
pass varchar(45)
);
create table usuarioDatos(
idUsu int,
nom varchar(45),
sexo int,
fecNac date,
idDistrito int,
hijos int,
estCivil int,
nivelEdu int,
altura int,
ocupacion varchar(45),
autodes varchar(250),
foto longblob,
foreign key(idDistrito)references distritos (id),
foreign key(estCivil)references estadoCivil (id),
foreign key(nivelEdu)references nivelEducacion (id),
foreign key(sexo)references sexos(id)
);
create table misIntereses(-- tabla intereses del ususario
-- esta tabla se elimina (elección del grupo) porque interes sera uno de los campos filtros 
-- " buscar personas por sexo, edad, y relación que quieren tener "
idUsu int,
idinteres int,
foreign key(idUsu)references usuario(id),
foreign key(idinteres)references interes(id)
);
create table filtros(
idUsu int,
buscoSexo int,
edadMax int,
edadMin int,
lugar int,
idinteres int,
foreign key(lugar)references distritos (id),
foreign key(buscoSexo)references sexos(id),
foreign key(idinteres)references interes(id)
);
create table contactos(
idUsu int,
idAmigos int,
foreign key(idUsu)references usuario(id)
);
create table preOtrosIntereses(
id int primary key auto_increment,
pre varchar(45)
);
create table resOtrosIntereses(
idUsu int,
idPre int,
res varchar(45),
foreign key(idUsu)references usuario(id),
foreign key(idPre)references preOtrosIntereses(id)
);
-- -----------------------------------------------
insert into preOtrosIntereses(pre) values
('Que busco en mi proxima relacion'),
('Que hago en mis tiempos libres'),
('Peliculas o series favoritas'),
('Bandas o artistas favoritas'),
('Mis 3 pasiones en la vida'),
('Mis libros o autores favoritos');

insert into distritos(nom)values
('Cercado Lima'),('Los olivos'),('Independencia');

insert into interes(nom) values
('A su alma gemela, matrimomio'),
('Una relacion seria'),
('Conocer nuevas personas y ver que pasa'),
('Una relacion de una noche');

insert into sexos(nom)values
('Hombre'),('Mujer'),('Homosexual'),('transexual'),('pansexual');

insert into estadoCivil(nom)values
('Soltero'),('Casado');

insert into nivelEducacion(nom)values
('Secundaria'),('Tecnico'),('Universidad'),('Maestria');
-- -----------------------------------------------

delimiter |
create procedure sp_login(a varchar(45), b varchar(45))
begin
	declare id int;
	if exists(select * from usuario where mail = a and pass = b)then
	set id = 1;
	select id;
else
set id = 2;
select  id;
end if;
end
|
-- drop procedure sp_registraUsuario;
delimiter |
create procedure sp_registraUsuario(p_nom varchar(45), p_mail varchar(45), p_pass varchar(45), p_sexo int, p_fecNac date, p_idDistrito int, p_hijos int, p_estCivil int, p_nivelEdu int, p_altura int, p_ocupacion varchar(45), p_intereses int, p_foto longblob)
begin

	declare idU int;
	declare sex int;
	declare emx int;
	declare emn int;
	declare edad int;
	
	if(p_sexo = 1)then
		set sex = 2;
	else
		set sex = 1;
	end if;
	
	set edad = (select year(curdate()) - year(p_fecNac));
	set emx = edad + 3;
	set emn = edad - 3;
	
	insert into usuario values
	(default, p_mail,p_pass);

	set idU = (select id from usuario where mail = p_mail);
	
	insert into usuarioDatos values
	(idU,p_nom,p_sexo, p_fecNac, p_idDistrito, p_hijos, p_estCivil, p_nivelEdu, p_altura, p_ocupacion, '', LOAD_FILE(p_foto));
	
	insert into filtros values
	(idU, sex, emx, emn, p_idDistrito, p_intereses);
	
	
	insert into resOtrosIntereses values
	(idU, 1, ''),
	(idU, 2, ''),
	(idU, 3, ''),
	(idU, 4, ''),
	(idU, 5, ''),
	(idU, 6, '');
	
end
|
-- drop  procedure ps_buscaOtroUsuario;
delimiter |
create procedure ps_buscaOtroUsuario(p_sexo int, p_edadMin int, p_edadMax int, p_interes int)
begin
select u.idUsu as 'id', u.foto as 'foto' , u.nom as 'Nombre' , year(curdate()) - year(u.fecNac) as 'Edad' , u.ocupacion as 'Ocupacion' from filtros f
join usuarioDatos u
on f.idUsu = u.idUsu
where 
u.sexo = p_sexo and
year(curdate()) - year(u.fecNac) BETWEEN p_edadMin and p_edadMax and
f.idinteres = p_interes;
end
|

-- drop procedure ps_consultaMisDatos;
delimiter |
create procedure ps_consultaMisDatos(p_mail varchar(45))
begin
declare idU int;
set idU = (select id from usuario where mail = p_mail);
select 
nom as 'nom', 
ocupacion as 'ocu', 
autodes as 'des'
from usuarioDatos where idUsu = idU;
end
|
-- drop procedure ps_consultaMisFiltros
delimiter |
create procedure ps_consultaMisFiltros(p_mail varchar(45))
begin
select f.buscoSexo as 'Sexo', f.edadMax as 'EdadMax', f.edadMin as 'EdadMin', f.idInteres as 'relacion'
from filtros f
join usuario u
on f.idUsu = u.id
where u.mail = p_mail;
end
|
delimiter |
create procedure ps_editarResOtrosIntereses(p_mail varchar(45), p_idPre int, p_res varchar(45))
begin
	declare idU int;
	set idU = (select id from usuario where mail = p_mail);
	update resOtrosIntereses set res = p_res where idUsu = idU and idPre = p_idPre;
end
|
-- drop procedure ps_listaRespuestaIntereses;
delimiter |
create procedure ps_listaRespuestaIntereses(p_mail varchar(45))
begin
	declare idU int;
	set idU = (select id from usuario where mail = p_mail);
	select (select p.pre from preOtrosIntereses p where id = idPre) as 'pre',
	res from resOtrosIntereses where idUsu = idU;
end
|
-- drop procedure sp_cargaOtroUsuario
delimiter |
create procedure sp_cargaOtroUsuario(p_id int)
begin
select 
nom as 'nom', 
ocupacion as 'ocu', 
autodes as 'des',
(select nom from estadoCivil where id = u.estCivil) as 'est'
from usuarioDatos u where idUsu = p_id;
end
|
delimiter |
create procedure ps_consultaMisDatos2(p_mail varchar(45))
begin
select  
u.nom as 'Nombre',
u.mail as 'Mail',
u.sexo as 'Sexo',
u.fecNac as 'Fecha_Nacimiento',
year(curdate()) - year(u.fecNac) as 'Edad',
u.idDistrito as 'Distrito',
u.hijos as 'Hijos',
u.estCivil as 'Estado_Civil',
u.nivelEdu as 'Nivel_Educacion',
u.altura as 'Altura',
u.ocupacion as 'Ocupacion',
f.buscoSexo as 'buscoSexo',
f.edadMax as 'edadMax',
f.edadMin as 'edadMin',
f.lugar as 'Lugar'
from filtros f join usuario u on f.idUsu = u.id where u.mail = p_mail;
end
|