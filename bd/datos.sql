select nom, year(curdate()) - year(fecNac) from usuario;
select * from sexos;

-- se agrega un nuevo parametro a sp_registraUsuario
-- call sp_registraUsuario( 'Nina', 'nina@gmail.com', '1234', 2, '2000-01-01', 1, 1, 1, 1, 160, 'Contabilidad','F:/i201615271.jpg');
-- el campo agregado es intereses

call sp_registraUsuario( 'Nina', 'nina@gmail.com', '1234', 2, '2000-01-01', 1, 1, 1, 1, 160, 'Contabilidad',2,'F:/i201615271.jpg');
call sp_registraUsuario( 'Marco', 'marco@gmail.com', '1234', 1, '1990-01-01', 1, 1, 1, 1, 160, 'Administracion',1,'F:/a.PNG');
call sp_registraUsuario( 'Antony', 'antony@gmail.com', '1234', 1, '2003-01-01', 1, 1, 1, 1, 160, 'Computacion',2,'F:/i201615271.jpg');
call sp_registraUsuario( 'Candy', 'candy@gmail.com', '1234', 2, '2001-01-01', 1, 1, 1, 1, 160, 'Arquitecto',3,'F:/i201615271.jpg');
call sp_registraUsuario( 'Ivan', 'ivan@gmail.com', '1234', 1, '1970-01-01', 1, 1, 1, 1, 160, 'Ingeniero',1,'F:/i201615271.jpg');
call sp_registraUsuario( 'Gin', 'gin@gmail.com', '1234', 1, '2000-01-01', 1, 1, 1, 1, 160, 'Computacion',2,'F:/i201615271.jpg');

call ps_editarResOtrosIntereses('nina@gmail.com', 1, 'Que no me maltrate');
call ps_editarResOtrosIntereses('nina@gmail.com', 2, 'Estudio');
call ps_editarResOtrosIntereses('nina@gmail.com', 3, 'Goku, Mi destino es amarte');
call ps_editarResOtrosIntereses('nina@gmail.com', 4, 'Metalica, joe no se que mas');
call ps_editarResOtrosIntereses('nina@gmail.com', 5, 'Estudio y algo mas');
call ps_editarResOtrosIntereses('nina@gmail.com', 6, 'La divina comedia, dante aligeri');


select * from resOtrosIntereses;

-- saber que filtros tiene el dueño de la cuenta
select * from filtros where idUsu = 1;

call ps_consultaMisDatos('nina@gmail.com');

-- buscoSexo 1:hombre
-- edadMax 21
-- edadMin 15
-- lugar 1:Cercado Lima

-- busca usuarios compatibles con mi filtro
select u.nom as 'Nombre' , year(curdate()) - year(u.fecNac) as 'Edad' , u.ocupacion as 'Ocupacion' from filtros f
join usuario u
on f.idUsu = u.id
where 
u.sexo = 1 and
f.edadMin >= 15 and
f.edadMax <= 21;


select * from usuario where id = 1;
select * from filtros where idUsu = 1;
select * from misintereses where idUsu = 1;

call ps_buscaOtroUsuario(1,15,21,2);

call ps_consultaMisFiltros('nina@gmail.com')
