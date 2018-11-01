-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2018 a las 01:40:19
-- Versión del servidor: 5.7.18-log
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
where 
u.sexo = p_sexo and
year(curdate()) - year(u.fecNac) BETWEEN p_edadMin and p_edadMax and
u.altura between p_alturaMin and p_alturaMax and
f.idinteres = p_interes and
u.idUsu not in (select mipareja from parejas where yo = cod) and
u.idUsu != cod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ps_consultaMisDatos`(p_mail varchar(45))
begin
declare idU int;
set idU = (select id from usuario where mail = p_mail);
select 
nom as 'nom', 
ocupacion as 'ocu', 
autodes as 'des'
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listaMegustan`(p_mail varchar(45))
begin
declare cod int;
set cod = (select id from usuario where mail = p_mail);
select *,
(select nom from usuariodatos where idUsu = p.mipareja) as 'nom'
from parejas p where yo = cod 
and mipareja not in(select yo from parejas where mipareja = 1);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listaParejas`(p_mail varchar(45))
begin
declare cod int;
set cod = (select id from usuario where mail = p_mail);
select *,
(select nom from usuariodatos where idUsu = p.yo) as 'nom'
from parejas p where mipareja = cod;
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
	
	
	insert into usuario values
	(default, p_mail,p_pass);

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
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE IF NOT EXISTS `contactos` (
  `idUsu` int(11) DEFAULT NULL,
  `idAmigos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

CREATE TABLE IF NOT EXISTS `distritos` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`id`, `nom`) VALUES
(1, 'Cercado Lima'),
(2, 'Los olivos'),
(3, 'Independencia');

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
(1, 2, 26, 20, 160, 150, 2, 1),
(2, 1, 25, 19, 170, 160, 1, 1),
(3, 2, 25, 19, 200, 180, 1, 1),
(4, 1, 24, 18, 170, 160, 3, 1),
(5, 2, 26, 20, 160, 150, 1, 1),
(7, 1, 26, 20, 170, 160, 1, 1),
(8, 1, 26, 20, 210, 200, 2, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parejas`
--

INSERT INTO `parejas` (`id`, `yo`, `mipareja`) VALUES
(1, 3, 8);

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
(3, 1, 'Me gusta escuchar musica y ver peliculas'),
(3, 2, 'Me gusta leer y y escuchar musica'),
(3, 3, 'La ciudad y los perros.'),
(3, 4, 'Difonia'),
(3, 5, 'me gusta leer, escuchar musica, ver peliculas'),
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
(8, 1, ''),
(8, 2, ''),
(8, 3, ''),
(8, 4, ''),
(8, 5, ''),
(8, 6, '');

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
  `pass` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `mail`, `pass`) VALUES
(1, 'jacinto@gmail.com', '123'),
(2, 'elba@gmail.com', '1234'),
(3, 'pablito@gmail.com', '1234'),
(4, 'Andrea@gmail.com', '123'),
(5, 'pedro@gmail.com', '123'),
(7, 'maria@gmail.com', '123'),
(8, 'carlita@gmail.com', '123');

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
(3, 'Pablo', 1, '1996-01-01', 1, 1, 1, 1, 160, 'Ingeniero', 'Soy un estudiante de cibertec de la carrera de computacion e informatica de sexto ciclo en mis tiempos libres me gusta escuchar musica ', 'images/pablito@gmail.com//pablo.png'),
(4, 'Andrea ', 2, '1997-11-16', 3, 1, 1, 1, 160, 'promo', '', 'images/Andrea@gmail.com//chia2.jpg'),
(5, 'Pedro Perez', 1, '1995-10-10', 1, 1, 1, 1, 160, 'Ingeniero', '', 'images/pedro@gmail.com//jacinto.jpg'),
(7, 'Maria Gonzales', 2, '1995-10-10', 1, 1, 1, 1, 160, 'MESERA', '', 'images/maria@gmail.com//pablo.png'),
(8, 'carlita jimenez', 2, '1995-10-10', 2, 1, 1, 1, 200, 'MESERA', '', 'images/carlita@gmail.com//chia2.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD KEY `idUsu` (`idUsu`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
-- AUTO_INCREMENT de la tabla `niveleducacion`
--
ALTER TABLE `niveleducacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `parejas`
--
ALTER TABLE `parejas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`idUsu`) REFERENCES `usuario` (`id`);

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
