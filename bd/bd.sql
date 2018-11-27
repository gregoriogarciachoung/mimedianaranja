-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2018 a las 06:49:02
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mmm`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ps_buscaOtroUsuario`(p_sexo int, p_edadMin int, p_edadMax int, p_alturaMin int, p_alturaMax int, p_interes int,p_mail varchar(45))
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
f.idinteres = p_interes and
u.idUsu not in (select mipareja from parejas where yo = cod) and
u.idUsu != cod and
usua.estado = 1;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ps_consultaMisDatos`(p_mail varchar(45))
begin
declare idU int;
set idU = (select id from usuario where mail = p_mail);
select 
nom as 'nom', 
year(curdate()) - year(fecNac) as 'edad',
ocupacion as 'ocu', 
autodes as 'des',
foto
from usuarioDatos where idUsu = idU;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ps_consultaMisDatos2`(p_mail varchar(45))
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
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ps_consultaMisFiltros`(p_mail varchar(45))
begin
select f.buscoSexo as 'Sexo', f.edadMax as 'EdadMax', f.edadMin as 'EdadMin', f.alturaMax, f.alturaMin, f.idInteres as 'relacion'
from filtros f
join usuario u
on f.idUsu = u.id
where u.mail = p_mail;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ps_editarResOtrosIntereses`(p_mail varchar(45), p_idPre int, p_res varchar(250))
begin
	declare idU int;
	set idU = (select id from usuario where mail = p_mail);
	update resOtrosIntereses set res = p_res where idUsu = idU and idPre = p_idPre;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ps_listaRespuestaIntereses`(p_mail varchar(45))
begin
	declare idU int;
	set idU = (select id from usuario where mail = p_mail);
	select 
	idPre,
	(select p.pre from preOtrosIntereses p where id = idPre) as 'pre',
	res from resOtrosIntereses where idUsu = idU;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cargaOtroUsuario`(p_id int)
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
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cc`(p_mail varchar(45),p_pass1 varchar(45), p_pass2 varchar(45))
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
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listaMegustan`(p_mail varchar(45))
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
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listaParejas`(p_mail varchar(45))
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
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login`(a varchar(45), b varchar(45))
begin
	declare id int;
	if exists(select * from usuario where mail = a and pass = b)then
	set id = 1;
	select id;
else
set id = 2;
select  id;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_meGusta`(p_mail varchar(45),p_pareja int)
begin
declare cod int;
set cod = (select id from usuario where mail = p_mail);
insert into parejas(yo, mipareja) values (cod,p_pareja);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registraUsuario`(p_nom varchar(45), p_mail varchar(45), p_pass varchar(45), p_sexo int, p_fecNac date, p_idDistrito int, p_hijos int, p_estCivil int, p_nivelEdu int, p_altura int, p_ocupacion varchar(45), p_intereses int, p_foto varchar(45))
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
	set emx = edad + 3;
	set emn = edad - 3;
	
	
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
	
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

CREATE TABLE IF NOT EXISTS `distritos` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`id`, `nom`) VALUES
(1, 'Cercado Lima'),
(2, 'Los olivos'),
(3, 'Independencia'),
(4, 'ANCON'),
(5, 'ATE'),
(6, 'BARRANCO'),
(7, 'BREÑA'),
(8, 'BELLAVISTA'),
(9, 'CALLAO'),
(10, 'CARABAYLLO'),
(11, 'CHACLACAYO'),
(12, 'CARMEN DE LA LEGUA REYNOSO'),
(13, 'CHORRILLOS'),
(14, 'CIENEGUILLA'),
(15, 'COMAS'),
(16, 'EL AGUSTINO'),
(17, 'JESUS MARIA'),
(18, 'LA PERLA'),
(19, 'LA PUNTA'),
(20, 'LA MERCED'),
(21, 'LA MOLINA'),
(22, 'LA VICTORIA'),
(23, 'LINCE'),
(24, 'LURIGANCHO'),
(25, 'LURIN'),
(26, 'MAGDALENA DEL MAR'),
(27, 'MIRAFLORES'),
(28, 'PACHACAMAC'),
(29, 'PUCUSANA'),
(30, 'PUEBLO LIBRE'),
(31, 'PUENTE PIEDRA'),
(32, 'PUNTA HERMOSA'),
(33, 'PUNTA NEGRA'),
(34, 'RIMAC'),
(35, 'SAN BARTOLO'),
(36, 'SAN BORJA'),
(37, 'SAN ISIDRO'),
(38, 'SAN JUAN DE LURIGANCHO'),
(39, 'SAN JUAN DE MIRAFLORES'),
(40, 'SAN LUIS'),
(41, 'SAN MARTIN DE PORRES'),
(42, 'SAN MIGUEL'),
(43, 'SANTA ANITA'),
(44, 'SANTA ROSA'),
(45, 'SANTIAGO DE SURCO'),
(46, 'SURQUILLO'),
(47, 'VILLA EL SALVADOR'),
(48, 'VILLA MARIA DEL TRIUNFO'),
(49, 'VENTANILLA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocivil`
--

CREATE TABLE IF NOT EXISTS `estadocivil` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadocivil`
--

INSERT INTO `estadocivil` (`id`, `nom`) VALUES
(1, 'Soltero'),
(2, 'Casado'),
(3, 'Comprometído');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filtros`
--

CREATE TABLE IF NOT EXISTS `filtros` (
  `idUsu` int(11) DEFAULT NULL,
  `buscoSexo` int(11) DEFAULT NULL,
  `edadMax` int(11) DEFAULT NULL,
  `edadMin` int(11) DEFAULT NULL,
  `alturaMax` int(11) DEFAULT NULL,
  `alturaMin` int(11) DEFAULT NULL,
  `lugar` int(11) DEFAULT NULL,
  `idinteres` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `filtros`
--

INSERT INTO `filtros` (`idUsu`, `buscoSexo`, `edadMax`, `edadMin`, `alturaMax`, `alturaMin`, `lugar`, `idinteres`) VALUES
(1, 2, 26, 20, 200, 150, 2, 1),
(2, 1, 25, 19, 170, 160, 1, 1),
(3, 2, 24, 17, 200, 150, 1, 1),
(4, 1, 24, 18, 170, 160, 3, 1),
(5, 2, 26, 20, 160, 150, 1, 1),
(7, 1, 26, 20, 170, 160, 1, 1),
(8, 1, 26, 20, 210, 160, 2, 1),
(9, 1, 24, 15, 180, 160, 1, 1),
(10, 1, 24, 15, 178, 150, 3, 1),
(11, 1, 21, 15, 177, 167, 3, 4),
(12, 1, 31, 25, 179, 169, 1, 1),
(13, 1, 31, 25, 179, 167, NULL, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interes`
--

CREATE TABLE IF NOT EXISTS `interes` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `interes`
--

INSERT INTO `interes` (`id`, `nom`) VALUES
(1, 'A su alma gemela, matrimomio'),
(3, 'Conocer nuevas personas y ver que pasa'),
(4, 'Una relación de una noche'),
(2, 'Una relación seria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(11) NOT NULL,
  `emisor` int(11) DEFAULT NULL,
  `receptor` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `msj` varchar(240) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `emisor`, `receptor`, `fecha`, `msj`) VALUES
(4, 8, 3, '2018-11-18', 'hola'),
(5, 8, 3, '2018-11-18', 'Mi número es 931 510 579. Envíame un mensaje'),
(6, 3, 8, '2018-11-22', 'hoy a las 7 pm en mega'),
(7, 3, 8, '2018-11-22', 'ya'),
(8, 3, 8, '2018-11-22', 'nada'),
(9, 3, 8, '2018-11-22', 'dime que puedo mejorar para salir'),
(10, 3, 8, '2018-11-22', 'ámame'),
(11, 3, 2, '2018-11-22', 'hola Elba'),
(12, 2, 3, '2018-11-22', 'hola Pablito'),
(13, 8, 3, '2018-11-22', 'que vas a hacer hoy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveleducacion`
--

CREATE TABLE IF NOT EXISTS `niveleducacion` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `niveleducacion`
--

INSERT INTO `niveleducacion` (`id`, `nom`) VALUES
(1, 'Secundaría'),
(2, 'Técnico'),
(3, 'Universidad'),
(4, 'Maestría');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parejas`
--

CREATE TABLE IF NOT EXISTS `parejas` (
  `id` int(11) NOT NULL,
  `yo` int(11) DEFAULT NULL,
  `mipareja` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parejas`
--

INSERT INTO `parejas` (`id`, `yo`, `mipareja`) VALUES
(4, 3, 8),
(5, 8, 3),
(6, 3, 7),
(7, 3, 9),
(8, 3, 10),
(9, 3, 4),
(10, 3, 2),
(11, 2, 3),
(12, 8, 1),
(13, 1, 8),
(14, 7, 1),
(15, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preotrosintereses`
--

CREATE TABLE IF NOT EXISTS `preotrosintereses` (
  `id` int(11) NOT NULL,
  `pre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preotrosintereses`
--

INSERT INTO `preotrosintereses` (`id`, `pre`) VALUES
(1, '¿Que busco en mi próxima relación?'),
(2, '¿Que hago en mis tiempos libres?'),
(3, 'Películas o series favoritas'),
(4, 'Bandas o artistas favoritas'),
(5, 'Mis 3 pasiones en la vida'),
(6, 'Mis libros o autores favoritos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resotrosintereses`
--

CREATE TABLE IF NOT EXISTS `resotrosintereses` (
  `idUsu` int(11) DEFAULT NULL,
  `idPre` int(11) DEFAULT NULL,
  `res` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `resotrosintereses`
--

INSERT INTO `resotrosintereses` (`idUsu`, `idPre`, `res`) VALUES
(1, 1, 'que sea veneca'),
(1, 2, 'Me gusta estar con manuela'),
(1, 3, 'American pie'),
(1, 4, 'RBD'),
(1, 5, 'Mis lentes , mi trabajo y mis alumnos <3'),
(1, 6, '7 semillas'),
(2, 1, 'Busco una persona con quien tener relacion duradera'),
(2, 2, 'me gusta cantar y tocar guitarra y salir con amigos(as)'),
(2, 3, 'Harry Potter, el hobbit'),
(2, 4, 'ACDC'),
(2, 5, 'Ser programadora\nser presidente\nser corrupta'),
(2, 6, 'los 3 chamchitos'),
(3, 1, 'Me gusta escuchar música y ver películas'),
(3, 2, 'Me gusta leer y y escuchar música'),
(3, 3, 'La ciudad y los perros.'),
(3, 4, 'Difonia'),
(3, 5, 'me gusta leer, escuchar música, ver péliculas'),
(3, 6, 'Comentarios reales de los incas'),
(4, 1, ''),
(4, 2, ''),
(4, 3, ''),
(4, 4, ''),
(4, 5, ''),
(4, 6, ''),
(5, 1, ''),
(5, 2, ''),
(5, 3, ''),
(5, 4, ''),
(5, 5, ''),
(5, 6, ''),
(7, 1, ''),
(7, 2, ''),
(7, 3, ''),
(7, 4, ''),
(7, 5, ''),
(7, 6, ''),
(8, 1, 'No tengo idea, que pase lo que tenga que pasar'),
(8, 2, 'entrenar, bailar o dormir'),
(8, 3, 'star wars, harry poher, el conjuro'),
(8, 4, 'fiestar, IU'),
(8, 5, 'dormir, cantar, nadar'),
(8, 6, 'Cielo Latini, absurda, Gabriel Rolan, Los padecientes'),
(9, 1, 'Busco una persona seria, para conocenos y tener una linda relación'),
(9, 2, 'Bailar, cine, viajar.'),
(9, 3, 'Muchos doramas'),
(9, 4, 'Fiestar, IU.'),
(9, 5, 'Bailar, cine, viajar.'),
(9, 6, 'El exorcista'),
(10, 1, 'Pasarla bien... XD'),
(10, 2, 'Estudio, veo tv, leo y otras cosas que solo hago con mi pareja.'),
(10, 3, 'Lo que da a las 12 de la noche en edge'),
(10, 4, 'Fiestar, IU'),
(10, 5, 'Música, deportes, lecutra.'),
(10, 6, 'La divina comedia, la iliada, la odisea.'),
(11, 1, ''),
(11, 2, ''),
(11, 3, ''),
(11, 4, ''),
(11, 5, ''),
(11, 6, ''),
(12, 1, ''),
(12, 2, ''),
(12, 3, ''),
(12, 4, ''),
(12, 5, ''),
(12, 6, ''),
(13, 1, ''),
(13, 2, ''),
(13, 3, ''),
(13, 4, ''),
(13, 5, ''),
(13, 6, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexos`
--

CREATE TABLE IF NOT EXISTS `sexos` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sexos`
--

INSERT INTO `sexos` (`id`, `nom`) VALUES
(1, 'Hombre'),
(2, 'Mujer'),
(3, 'Homosexual'),
(4, 'transexual'),
(5, 'pansexual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `mail`, `pass`, `estado`) VALUES
(1, 'jacinto@gmail.com', 'abcd', 1),
(2, 'elba@gmail.com', '1234', 1),
(3, 'pablito@gmail.com', '1234', 1),
(4, 'Andrea@gmail.com', '123', 1),
(5, 'pedro@gmail.com', '123', 1),
(7, 'maria@gmail.com', '123', 1),
(8, 'carlita@gmail.com', '1234', 1),
(9, 'nina@gmail.com', '1234', 1),
(10, 'ana@gmail.com', '1234', 1),
(11, 'hyemi@gmail.com', '1234', 1),
(12, 'candid@gmail.com', '1234', 1),
(13, 'valeria@gmail.com', 'mivale', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariodatos`
--

CREATE TABLE IF NOT EXISTS `usuariodatos` (
  `idUsu` int(11) DEFAULT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `fecNac` date DEFAULT NULL,
  `idDistrito` int(11) DEFAULT NULL,
  `hijos` int(11) DEFAULT NULL,
  `estCivil` int(11) DEFAULT NULL,
  `nivelEdu` int(11) DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `ocupacion` varchar(45) DEFAULT NULL,
  `autodes` varchar(250) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuariodatos`
--

INSERT INTO `usuariodatos` (`idUsu`, `nom`, `sexo`, `fecNac`, `idDistrito`, `hijos`, `estCivil`, `nivelEdu`, `altura`, `ocupacion`, `autodes`, `foto`) VALUES
(1, 'jacinto', 1, '1995-10-10', 2, 1, 1, 1, 160, 'doy clases en cibertec', 'Soy profesor de cibertec, me gusta la crema de leche deslactosada', 'images/jacinto@gmail.com//jacinto.jpg'),
(2, 'Elba', 2, '1996-01-01', 1, 1, 1, 1, 160, 'estudiante', '', 'images/elba@gmail.com//pablo.png'),
(3, 'Pablo', 1, '1996-01-01', 1, 1, 1, 1, 160, 'Ingeniero', 'Soy un estudiante de cibertec de la carrera de computacion e informática de sexto ciclo en mis tiempos libres me gusta escuchar música', 'images/pablito@gmail.com//pablo.png'),
(4, 'Andrea ', 2, '1997-11-16', 3, 1, 1, 1, 160, 'promo', '', 'images/Andrea@gmail.com//chia2.jpg'),
(5, 'Pedro Perez', 1, '1995-10-10', 1, 1, 1, 1, 160, 'Ingeniero', '', 'images/pedro@gmail.com//jacinto.jpg'),
(7, 'Maria Gonzales', 2, '1995-10-10', 1, 1, 1, 1, 160, 'MESERA', '', 'images/maria@gmail.com//pablo.png'),
(8, 'carlita jimenez', 2, '1995-10-10', 2, 1, 1, 1, 200, 'MESERA', 'me gusta conversar de temas variados en mis tiempos de ocio.', 'images/carlita@gmail.com//chia2.jpg'),
(9, 'Nina', 2, '2000-01-01', 1, 2, 1, 1, 170, 'Estudiante', 'Soy una chica muy amable, responsable, amorosa, muy detallista, sincera sobre todo honesta.', 'images/nina@gmail.com//p_00023.jpg'),
(10, 'Ana', 2, '2000-11-11', 3, 2, 1, 1, 168, 'Arquitecto', 'Soy una chica linda, me gusta salir con amigos y hacerles creer estoy interesada en ellos.', 'images/ana@gmail.com//ana.jpg'),
(11, 'Hyemi', 2, '2000-11-11', 3, 2, 1, 3, 167, 'Estudiante', '', 'images/hyemi@gmail.com//hyemi.jpg'),
(12, 'Candid', 2, '1990-12-11', 3, 2, 1, 4, 169, 'Piano', '', 'images/candid@gmail.com//candid.jpg'),
(13, 'Valeria', 2, '1990-01-01', NULL, 2, 1, 3, 169, 'Abogada', '', 'images/valeria@gmail.com//valeria.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `distritos`
--
ALTER TABLE `distritos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `filtros`
--
ALTER TABLE `filtros`
  ADD KEY `lugar` (`lugar`),
  ADD KEY `buscoSexo` (`buscoSexo`),
  ADD KEY `idinteres` (`idinteres`);

--
-- Indices de la tabla `interes`
--
ALTER TABLE `interes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `niveleducacion`
--
ALTER TABLE `niveleducacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parejas`
--
ALTER TABLE `parejas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yo` (`yo`),
  ADD KEY `mipareja` (`mipareja`);

--
-- Indices de la tabla `preotrosintereses`
--
ALTER TABLE `preotrosintereses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resotrosintereses`
--
ALTER TABLE `resotrosintereses`
  ADD KEY `idUsu` (`idUsu`),
  ADD KEY `idPre` (`idPre`);

--
-- Indices de la tabla `sexos`
--
ALTER TABLE `sexos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indices de la tabla `usuariodatos`
--
ALTER TABLE `usuariodatos`
  ADD KEY `idDistrito` (`idDistrito`),
  ADD KEY `estCivil` (`estCivil`),
  ADD KEY `nivelEdu` (`nivelEdu`),
  ADD KEY `sexo` (`sexo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `distritos`
--
ALTER TABLE `distritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `interes`
--
ALTER TABLE `interes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `niveleducacion`
--
ALTER TABLE `niveleducacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `parejas`
--
ALTER TABLE `parejas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `preotrosintereses`
--
ALTER TABLE `preotrosintereses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `sexos`
--
ALTER TABLE `sexos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `filtros`
--
ALTER TABLE `filtros`
  ADD CONSTRAINT `filtros_ibfk_1` FOREIGN KEY (`lugar`) REFERENCES `distritos` (`id`),
  ADD CONSTRAINT `filtros_ibfk_2` FOREIGN KEY (`buscoSexo`) REFERENCES `sexos` (`id`),
  ADD CONSTRAINT `filtros_ibfk_3` FOREIGN KEY (`idinteres`) REFERENCES `interes` (`id`);

--
-- Filtros para la tabla `parejas`
--
ALTER TABLE `parejas`
  ADD CONSTRAINT `parejas_ibfk_1` FOREIGN KEY (`yo`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `parejas_ibfk_2` FOREIGN KEY (`mipareja`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `resotrosintereses`
--
ALTER TABLE `resotrosintereses`
  ADD CONSTRAINT `resotrosintereses_ibfk_1` FOREIGN KEY (`idUsu`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `resotrosintereses_ibfk_2` FOREIGN KEY (`idPre`) REFERENCES `preotrosintereses` (`id`);

--
-- Filtros para la tabla `usuariodatos`
--
ALTER TABLE `usuariodatos`
  ADD CONSTRAINT `usuariodatos_ibfk_1` FOREIGN KEY (`idDistrito`) REFERENCES `distritos` (`id`),
  ADD CONSTRAINT `usuariodatos_ibfk_2` FOREIGN KEY (`estCivil`) REFERENCES `estadocivil` (`id`),
  ADD CONSTRAINT `usuariodatos_ibfk_3` FOREIGN KEY (`nivelEdu`) REFERENCES `niveleducacion` (`id`),
  ADD CONSTRAINT `usuariodatos_ibfk_4` FOREIGN KEY (`sexo`) REFERENCES `sexos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
