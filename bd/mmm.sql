drop database mmm;
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
pass varchar(45),
estado int
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
foto varchar(45),
foreign key(idDistrito)references distritos (id),
foreign key(estCivil)references estadoCivil (id),
foreign key(nivelEdu)references nivelEducacion (id),
foreign key(sexo)references sexos(id)
);
create table filtros(
idUsu int,
buscoSexo int,
edadMax int,
edadMin int,
alturaMax int,
alturaMin int,
lugar int,
idinteres int,
foreign key(lugar)references distritos (id),
foreign key(buscoSexo)references sexos(id),
foreign key(idinteres)references interes(id)
);
create table preOtrosIntereses(
id int primary key auto_increment,
pre varchar(45)
);
create table resOtrosIntereses(
idUsu int,
idPre int,
res varchar(250),
foreign key(idUsu)references usuario(id),
foreign key(idPre)references preOtrosIntereses(id)
);
create table parejas(
id int primary key auto_increment,
yo int,
mipareja int,
foreign key(yo)references usuario(id),
foreign key(mipareja)references usuario(id)
);
create table mensajes(
id int primary key auto_increment,
emisor int,
receptor int,
fecha date,
msj varchar(240)
);
-- -----------------------------------------------
insert into preOtrosIntereses(pre) values
('¿Que busco en mi próxima relación?'),
('¿Que hago en mis tiempos libres?'),
('Películas o series favoritas'),
('Bandas o artistas favoritas'),
('Mis 3 pasiones en la vida'),
('Mis libros o autores favoritos');

insert into distritos(nom)values
('Cercado Lima'),('Los olivos'),('Independencia'),('ANCON'),('ATE'),('BARRANCO'),('BREÑA'),('BELLAVISTA'),('CALLAO'),('CARABAYLLO'),('CHACLACAYO'),('CARMEN DE LA LEGUA REYNOSO'),('CHORRILLOS'),('CIENEGUILLA'),('COMAS'),('EL AGUSTINO'),('JESUS MARIA'),('LA PERLA'),('LA PUNTA'),('LA MERCED'),('LA MOLINA'),('LA VICTORIA'),('LINCE'),('LURIGANCHO'),('LURIN'),('MAGDALENA DEL MAR'),('MIRAFLORES'),('PACHACAMAC'),('PUCUSANA'),('PUEBLO LIBRE'),('PUENTE PIEDRA'),('PUNTA HERMOSA'),('PUNTA NEGRA'),('RIMAC'),('SAN BARTOLO'),('SAN BORJA'),('SAN ISIDRO'),('SAN JUAN DE LURIGANCHO'),('SAN JUAN DE MIRAFLORES'),('SAN LUIS'),('SAN MARTIN DE PORRES'),('SAN MIGUEL'),('SANTA ANITA'),('SANTA ROSA'),('SANTIAGO DE SURCO'),('SURQUILLO'),('VILLA EL SALVADOR'),('VILLA MARIA DEL TRIUNFO'),('VENTANILLA');

insert into interes(nom) values
('A su alma gemela, matrimomio'),
('Una relación seria'),
('Conocer nuevas personas y ver que pasa'),
('Una relación de una noche');

insert into sexos(nom)values
('Hombre'),('Mujer'),('Homosexual'),('transexual'),('pansexual');

insert into estadoCivil(nom)values
('Soltero'),('Casado'),('Comprometído');

insert into nivelEducacion(nom)values
('Secundaría'),('Técnico'),('Universidad'),('Maestría');
-- -----------------------------------------------
drop procedure sp_login;
delimiter |
create procedure sp_login(a varchar(45), b varchar(45))
begin
/*
estado de usuario
	controlado por usuario 0: bloqueado, 1:desbloqueado
	controlado por administrador 2: no ingreso
	
resultado de login
	1: ingreso
	2: no ingreso
	3: bloqueo de cuenta
*/
	declare id int;
	declare est int;
	declare adm int;
		set adm = (select id from usuario where mail = a and pass = b);
	if exists(select * from usuario where mail = a and pass = b)then
		set est = (select estado from usuario where mail = a and pass = b);
		if(est = 1 or est = 0)then
				set id = 1;
				select id;
		else
			set id = 3;
			select id;
		end if;
	else
		set id = 2;
		select  id;
	end if;
end
|
drop procedure sp_registraUsuario;
delimiter |
create procedure sp_registraUsuario(p_nom varchar(45), p_mail varchar(45), p_pass varchar(45), p_sexo int, p_fecNac date, p_idDistrito int, p_hijos int, p_estCivil int, p_nivelEdu int, p_altura int, p_ocupacion varchar(45), p_intereses int, p_foto varchar(45))
begin

	declare idU int;
	declare sex int;
	declare emx int;
	declare emn int;
	declare edad int;
	declare amx int;
	declare amn int;
	
	if(p_sexo = 1)then
		set sex = 2;
		set amx = p_altura;
		set amn = p_altura - 10;
	else
		set sex = 1;
		set amn = p_altura;
		set amx = p_altura + 10;
	end if;
	
	set edad = (select year(curdate()) - year(p_fecNac));
	if(edad = 18 or edad = 19 or edad = 20 or edad = 21)then
			set emx = edad + 3;
			set emn = edad;
	else
		set emx = edad + 3;
		set emn = edad - 3;
	end if;
	
	insert into usuario(mail, pass,estado) values
	(p_mail,p_pass,1);

	set idU = (select id from usuario where mail = p_mail);
	insert into usuarioDatos values
	(idU,p_nom,p_sexo, p_fecNac, p_idDistrito, p_hijos, p_estCivil, p_nivelEdu, p_altura, p_ocupacion,'',p_foto);
	
	insert into filtros values
	(idU, sex, emx, emn, amx, amn, p_idDistrito, p_intereses);
	
	
	insert into resOtrosIntereses values
	(idU, 1, ''),
	(idU, 2, ''),
	(idU, 3, ''),
	(idU, 4, ''),
	(idU, 5, ''),
	(idU, 6, '');
	
end
|
drop  procedure ps_buscaOtroUsuario;
delimiter |
create procedure ps_buscaOtroUsuario(p_sexo int, p_edadMin int, p_edadMax int, p_alturaMin int, p_alturaMax int, p_lugar int, p_interes int,p_mail varchar(45))
begin
declare cod int;
set cod = (select id from usuario where mail = p_mail);
select u.idUsu as 'id', u.foto as 'foto' , u.nom as 'Nombre' , year(curdate()) - year(u.fecNac) as 'Edad' , u.ocupacion as 'Ocupacion' from filtros f
join usuarioDatos u
on f.idUsu = u.idUsu
join usuario usua
on u.idUsu = usua.id
where 
u.sexo = p_sexo and
year(curdate()) - year(u.fecNac) BETWEEN p_edadMin and p_edadMax and
u.altura between p_alturaMin and p_alturaMax and
u.idDistrito = p_lugar and
f.idinteres = p_interes and
u.idUsu not in (select mipareja from parejas where yo = cod) and
u.idUsu != cod and
usua.estado = 1;
end
|

drop procedure ps_consultaMisDatos;
delimiter |
create procedure ps_consultaMisDatos(p_mail varchar(45))
begin
declare idU int;
set idU = (select id from usuario where mail = p_mail);
select 
nom as 'nom', 
year(curdate()) - year(fecNac) as 'edad',
ocupacion as 'ocu', 
autodes as 'des',
foto,
(select nom from distritos where id = (select idDistrito from usuariodatos where idUsu = idU)) as 'nomdis',
hijos,
altura,
(select estado from usuario where mail = p_mail) as 'estado'
from usuarioDatos where idUsu = idU;
end
|
drop procedure ps_consultaMisFiltros;
delimiter |
create procedure ps_consultaMisFiltros(p_mail varchar(45))
begin
select f.buscoSexo as 'Sexo', f.edadMax as 'EdadMax', f.edadMin as 'EdadMin', f.alturaMax, f.alturaMin, f.idInteres as 'relacion', f.lugar as 'lugar', (select nom from distritos where id = f.lugar) as 'nomdis'
from filtros f
join usuario u
on f.idUsu = u.id
where u.mail = p_mail;
end
|
delimiter |
create procedure ps_editarResOtrosIntereses(p_mail varchar(45), p_idPre int, p_res varchar(250))
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
	select 
	idPre,
	(select p.pre from preOtrosIntereses p where id = idPre) as 'pre',
	res from resOtrosIntereses where idUsu = idU;
end
|
-- drop procedure sp_cargaOtroUsuario
delimiter |
create procedure sp_cargaOtroUsuario(p_id int)
begin
select 
u.idUsu,
u.foto,
u.nom as 'nom',
year(curdate()) - year(u.fecNac) as 'edad',
u.autodes as 'des',
u.altura,
u.sexo,
(select nom from estadoCivil where id = u.estCivil) as 'est',
(select nom from distritos where id = u.idDistrito) as 'vivoen',
u.ocupacion as 'ocu',
(select res from resOtrosIntereses where idPre = 1 and idUsu = p_id) as 'quebusco',
(select res from resOtrosIntereses where idPre = 2 and idUsu = p_id) as 'tmplibres',
(select res from resOtrosIntereses where idPre = 3 and idUsu = p_id) as 'pelis',
(select res from resOtrosIntereses where idPre = 4 and idUsu = p_id) as 'musi',
(select res from resOtrosIntereses where idPre = 5 and idUsu = p_id) as 'pasiones',
(select res from resOtrosIntereses where idPre = 6 and idUsu = p_id) as 'lbrs'
from usuarioDatos u 
where idUsu = p_id;
end
|
drop procedure sp_listaParejas;
delimiter |
create procedure sp_listaParejas(p_mail varchar(45))
begin
declare cod int;
set cod = (select id from usuario where mail = p_mail);
select *,
year(curdate()) - year(ud.fecNac) as 'edad'
-- (select nom from usuariodatos where idUsu = p.mipareja) as 'nom'
from parejas p 
join usuariodatos ud
on p.yo = ud.idUsu
where p.mipareja = cod
and p.yo in(select mipareja from parejas where yo = cod);
-- and p.mipareja in(select mipareja from parejas where -.-1 mipareja = cod);
-- -.-1 lista parejas donde yo este como pareja de alguien
end
|
-- drop procedure sp_listaMegustan;
delimiter |
create procedure sp_listaMegustan(p_mail varchar(45))
begin
declare cod int;
set cod = (select id from usuario where mail = p_mail);
select *,
year(curdate()) - year(ud.fecNac) as 'edad'
-- (select nom from usuariodatos where idUsu = p.mipareja) as 'nom'
from parejas p 
join usuariodatos ud
on p.mipareja = ud.idUsu
where p.yo = cod 
and p.mipareja not in(select yo from parejas where mipareja = cod);
end
|
delimiter |
create procedure sp_meGusta(p_mail varchar(45),p_pareja int)
begin
declare cod int;
set cod = (select id from usuario where mail = p_mail);
insert into parejas(yo, mipareja) values (cod,p_pareja);
end
|
drop procedure sp_cc;
delimiter |
create procedure sp_cc(p_mail varchar(45),p_pass1 varchar(45), p_pass2 varchar(45))
begin
declare getpass varchar(45);
declare resultado int;
set getpass = (select pass from usuario where mail = p_mail);
if(getpass = p_pass1)then
	update usuario set pass = p_pass2 where mail = p_mail;
	set resultado = 1;
else
	set resultado = 0;
end if;
select resultado;
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
