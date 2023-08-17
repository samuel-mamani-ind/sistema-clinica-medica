-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-08-2023 a las 12:18:11
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_curso`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_HISTORIA_LISTAR` (IN `FECHAINICIO` DATE, IN `FECHAFIN` DATE)   SELECT 
fua.fua_id,
fua.fua_fregistro,
fua.historia_id,
fua.consulta_id,
consulta.consulta_diagnostico,
CONCAT_WS(' ',paciente.paciente_nombre,paciente.paciente_apepat,paciente.paciente_apemat) AS paciente,
paciente.paciente_nrodocumento,
CONCAT_WS(' ',medico.medico_nombre,medico.medico_apepat,medico.medico_apepat) AS medico
FROM fua
INNER JOIN consulta
ON fua.consulta_id=consulta.consulta_id
INNER JOIN cita
ON consulta.cita_id=cita.cita_id
INNER JOIN paciente
ON cita.paciente_id=paciente.paciente_id
INNER JOIN medico
ON cita.medico_id=medico.medico_id
WHERE fua.fua_fregistro BETWEEN FECHAINICIO AND FECHAFIN$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INTENTO_USUARIO` (IN `USUARIO` VARCHAR(50))   BEGIN
DECLARE INTENTO INT;
SET @INTENTO:=(SELECT usu_intento FROM usuario WHERE usu_nombre=USUARIO);
IF @INTENTO=2 THEN
	SELECT @INTENTO;
ELSE
 UPDATE usuario SET
 usu_intento=@INTENTO+1
 WHERE usu_nombre=USUARIO;
 SELECT @INTENTO;
 END IF;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_CITA` ()   SELECT 
c.cita_id,
c.cita_nroatencion,
c.cita_feregistro,
c.cita_descripcion,
c.cita_estatus,
p.paciente_id,
m.medico_id,
m.especialidad_id,
CONCAT_WS(' ',p.paciente_nombre,p.paciente_apepat,p.paciente_apemat) AS paciente,
c.medico_id,
CONCAT_WS(' ',m.medico_nombre,m.medico_apepat,m.medico_apemat) AS medico
FROM cita AS c 
INNER JOIN paciente AS p ON c.paciente_id=p.paciente_id
INNER JOIN medico AS m ON c.medico_id=m.medico_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COMBO_ESPECIALIDAD` ()   SELECT * FROM especialidad WHERE especialidad_estatus='ACTIVO'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COMBO_INSUMOS` ()   SELECT
insumo.insumo_id,
insumo.insumo_nombre
FROM insumo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COMBO_MEDICAMENTO` ()   SELECT 
medicamento.medicamento_id,
medicamento.medicamento_nombre
FROM
medicamento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COMBO_MEDICO` (IN `ID` INT)   SELECT medico_id,CONCAT_WS(' ',medico_nombre,medico_apepat,medico_apemat) AS medico
FROM medico
WHERE especialidad_id=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COMBO_PACIENTE` ()   SELECT paciente_id,CONCAT_WS(' ',paciente_nombre,paciente_apepat,paciente_apemat) 
FROM paciente WHERE paciente_estatus='ACTIVO'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COMBO_PROCEDIMIENTO` ()   SELECT 
procedimiento.procedimiento_id,
procedimiento.procedimiento_nombre
FROM procedimiento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COMBO_ROL` ()   SELECT
rol.rol_id,
rol.rol_nombre
FROM 
rol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_CONSULTA` (IN `FECHAINICIO` DATE, IN `FECHAFIN` DATE)   SELECT
consulta.consulta_id,
consulta.consulta_descripcion,
consulta.consulta_diagnostico,
consulta.consulta_feregistro,
consulta.consulta_estatus,
cita.cita_nroatencion,
cita.cita_feregistro,
cita.medico_id,
cita.especialidad_id,
cita.paciente_id,
cita.cita_estatus,
cita.cita_descripcion,
especialidad.especialidad_nombre,
cita.usu_id,
CONCAT_WS(' ',paciente.paciente_nombre,paciente.paciente_apepat,paciente.paciente_apemat) AS paciente,
paciente.paciente_nrodocumento,
CONCAT_WS(' ',medico.medico_nombre,medico.medico_apepat,medico.medico_apemat) AS medico
FROM
consulta
INNER JOIN
cita
ON
consulta.cita_id=cita.cita_id
INNER JOIN
paciente
ON
cita.paciente_id=paciente.paciente_id
INNER JOIN
medico
ON
cita.medico_id=medico.medico_id
INNER JOIN
especialidad
ON
cita.especialidad_id=especialidad.especialidad_id
WHERE consulta.consulta_feregistro BETWEEN FECHAINICIO AND FECHAFIN$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_CONSULTA_HISTORIAL` ()   SELECT
consulta.consulta_id,
consulta.consulta_descripcion,
consulta.consulta_diagnostico,
paciente.paciente_nrodocumento,
CONCAT_WS(' ',paciente.paciente_nombre,paciente.paciente_apepat,paciente.paciente_apemat) AS paciente,
historia.historia_id,
consulta.consulta_feregistro
FROM consulta
INNER JOIN cita
ON consulta.cita_id=cita.cita_id
INNER JOIN paciente
ON cita.paciente_id=paciente.paciente_id
INNER JOIN historia
ON paciente.paciente_id=historia.paciente_id
WHERE consulta.consulta_feregistro=CURDATE()$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_ESPECIALIDAD` ()   SELECT * FROM especialidad$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_INSUMO` ()   SELECT * FROM insumo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_INSUMO_DETALLE` (IN `IDFUA` INT)   SELECT 
insumo.insumo_nombre,
detalle_insumo.detain_cantidad
FROM
detalle_insumo
INNER JOIN
insumo
ON detalle_insumo.insumo_id=insumo.insumo_id
WHERE detalle_insumo.fua_id=IDFUA$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_MEDICAMENTO` ()   SELECT * FROM medicamento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_MEDICAMENTO_DETALLE` (IN `IDFUA` INT)   SELECT 
medicamento.medicamento_nombre,
detalle_medicamento.detame_cantidad
FROM
detalle_medicamento
INNER JOIN
medicamento
ON detalle_medicamento.medicamento_id=medicamento.medicamento_id
WHERE detalle_medicamento.fua_id=IDFUA$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_MEDICO` ()   SELECT
medico.medico_id,
medico.medico_nombre,
medico.medico_apepat,
medico.medico_apemat,
CONCAT_WS(' ',medico_nombre,medico_apepat,medico_apemat) AS medico,
medico.medico_direccion,
medico.medico_movil,
medico.medico_sexo,
medico.medico_fenac,
medico.medico_nrodocumento,
medico.medico_colegiatura,
medico.especialidad_id,
medico.usu_id,
especialidad.especialidad_nombre,
usuario.usu_nombre,
usuario.rol_id,
usuario.usu_email
FROM medico
INNER JOIN especialidad ON medico.especialidad_id=especialidad.especialidad_id
INNER JOIN usuario ON
medico.usu_id=usuario.usu_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_PACIENTE` ()   SELECT
CONCAT_WS(' ',paciente_nombre,paciente_apepat,paciente_apemat) AS paciente,
paciente.paciente_id,
paciente.paciente_nombre,
paciente.paciente_apepat,
paciente.paciente_apemat,
paciente.paciente_direccion,
paciente.paciente_movil,
paciente.paciente_sexo,
paciente.paciente_fenac,
paciente.paciente_nrodocumento,
paciente.paciente_estatus
FROM paciente$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_PACIENTE_CITA` ()   SELECT
cita.cita_id,
cita.cita_nroatencion,
CONCAT_WS(' ',paciente.paciente_nombre,paciente.paciente_apepat,paciente.paciente_apemat) AS paciente
FROM cita
INNER JOIN paciente
ON cita.paciente_id=paciente.paciente_id
WHERE cita_feregistro=CURDATE() AND cita_estatus='PENDIENTE'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_PROCEDIMIENTO` ()   SELECT * FROM procedimiento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_PROCEDIMIENTO_DETALLE` (IN `IDFUA` INT)   SELECT 
procedimiento.procedimiento_nombre
FROM
detalle_procedimiento
INNER JOIN
procedimiento
ON detalle_procedimiento.procedimiento_id=procedimiento.procedimiento_id
WHERE detalle_procedimiento.fua_id=IDFUA$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_USUARIO` ()   BEGIN
DECLARE CANTIDAD int;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD+1 AS posicion,
usuario.usu_id,
usuario.usu_nombre,
usuario.usu_sexo,
usuario.rol_id,
usuario.usu_estatus,
rol.rol_nombre,
usuario.usu_email
FROM
usuario
INNER JOIN rol ON usuario.rol_id = rol.rol_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_CITA` (IN `IDCITA` INT, IN `IDPACIENTE` INT, IN `IDESPECIALIDAD` INT, IN `IDMEDICO` INT, IN `DESCRIPCION` TEXT, IN `ESTATUS` VARCHAR(10))   UPDATE cita SET
paciente_id=IDPACIENTE,
medico_id=IDMEDICO,
especialidad_id=IDESPECIALIDAD,
cita_descripcion=DESCRIPCION,
cita_estatus=ESTATUS
WHERE cita_id=IDCITA$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_CONSULTA` (IN `ID` INT, IN `DESCRIPCION` VARCHAR(255), IN `DIAGNOSTICO` VARCHAR(250))   UPDATE consulta
SET
consulta_descripcion=DESCRIPCION,
consulta_diagnostico=DIAGNOSTICO
WHERE consulta_id = ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_CONTRA_USUARIO` (IN `IDUSUARIO` INT, IN `CONTRA` VARCHAR(250))   UPDATE usuario SET
usu_contrasena=CONTRA
WHERE usu_id = IDUSUARIO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_DATOS_USUARIO` (IN `IDUSUARIO` INT, IN `SEXO` CHAR(1), IN `IDROL` INT, IN `EMAIL` VARCHAR(250))   UPDATE usuario SET
usu_sexo = SEXO,
rol_id = IDROL,
usu_email = EMAIL
WHERE usu_id = IDUSUARIO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ESPECIALIDAD` (IN `ID` INT, IN `ESPECIALIDADACTUAL` VARCHAR(50), IN `ESPECIALIDADNUEVA` VARCHAR(50), IN `ESTATUS` VARCHAR(10))   BEGIN
DECLARE CANTIDAD INT;
IF ESPECIALIDADACTUAL = ESPECIALIDADNUEVA THEN
 UPDATE especialidad SET 
 especialidad_estatus = ESTATUS
 WHERE especialidad_id = ID;
 SELECT 1;
ELSE
 SET @CANTIDAD:=(SELECT COUNT(*) FROM especialidad WHERE especialidad_nombre=ESPECIALIDADNUEVA);
  IF @CANTIDAD = 0 THEN
  	 UPDATE especialidad SET
     especialidad_nombre = ESPECIALIDADNUEVA,
     especialidad_estatus = ESTATUS
     WHERE especialidad_id = ID;
     SELECT 1;
  ELSE
     SELECT 2;
  END IF;

END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ESTATUS_USUARIO` (IN `IDUSUARIO` INT, IN `ESTATUS` VARCHAR(20))   UPDATE usuario SET
usu_estatus=ESTATUS
WHERE usu_id=IDUSUARIO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_INSUMO` (IN `ID` INT, IN `INSUMOACTUAL` VARCHAR(50), IN `INSUMONUEVO` VARCHAR(50), IN `STOCK` INT, IN `ESTATUS` VARCHAR(10))   BEGIN
DECLARE CANTIDAD INT;
IF INSUMOACTUAL = INSUMONUEVO THEN
 UPDATE insumo SET 
 insumo_stock = STOCK,
 insumo_estatus = ESTATUS
 WHERE insumo_id = ID;
 SELECT 1;
ELSE
 SET @CANTIDAD:=(SELECT COUNT(*) FROM insumo WHERE insumo_nombre=INSUMONUEVO);
  IF @CANTIDAD = 0 THEN
  	 UPDATE insumo SET
     insumo_nombre = INSUMONUEVO,
     insumo_stock = STOCK,
     insumo_estatus = ESTATUS
     WHERE insumo_id = ID;
     SELECT 1;
  ELSE
     SELECT 2;
  END IF;

END IF;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_MEDICAMENTO` (IN `ID` INT, IN `MEDICAMENTOACTUAL` VARCHAR(50), IN `MEDICAMENTONUEVO` VARCHAR(50), IN `ALIAS` VARCHAR(50), IN `STOCK` INT, IN `ESTATUS` VARCHAR(10))   BEGIN
DECLARE CANTIDAD INT;
IF MEDICAMENTOACTUAL=MEDICAMENTONUEVO THEN
	UPDATE medicamento SET
    medicamento_alias=ALIAS,
    medicamento_stock = STOCK,
    medicamento_estatus= ESTATUS
    WHERE medicamento_id=ID;
    SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) FROM medicamento WHERE medicamento_nombre=MEDICAMENTONUEVO);
    IF @CANTIDAD = 0 THEN
    	UPDATE medicamento SET
        medicamento_nombre=MEDICAMENTONUEVO,
        medicamento_alias=ALIAS,
        medicamento_stock = STOCK,
        medicamento_estatus= ESTATUS
        WHERE medicamento_id=ID;
        SELECT 1;
    ELSE
    	SELECT 2;
    END IF;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_MEDICO` (IN `IDMEDICO` INT, IN `NOMBRES` VARCHAR(50), IN `APEPAT` VARCHAR(50), IN `APEMAT` VARCHAR(50), IN `DIRECCION` VARCHAR(200), IN `MOVIL` CHAR(12), IN `SEXO` CHAR(2), IN `FECHANACIMIENTO` DATE, IN `NRODOCUMENTOACTUAL` CHAR(12), IN `NRODOCUMENTONUEVO` CHAR(12), IN `COLEGIATURAACTUAL` CHAR(12), IN `COLEGIATURANUEVO` CHAR(12), IN `ESPECIALIDAD` INT, IN `EMAIL` VARCHAR(250), IN `IDUSUARIO` INT)   BEGIN
DECLARE CANTIDAD INT;
IF NRODOCUMENTOACTUAL = NRODOCUMENTONUEVO OR COLEGIATURAACTUAL=COLEGIATURANUEVO THEN
	UPDATE usuario SET
    usu_email=EMAIL,
    usu_sexo=SEXO
    WHERE usu_id=IDUSUARIO;
    
    UPDATE medico SET
    medico_nombre=NOMBRES,
    medico_apepat=APEPAT,
    medico_apemat=APEMAT,
    medico_direccion=DIRECCION,
    medico_movil=MOVIL,
    medico_sexo=SEXO,
    medico_fenac=FECHANACIMIENTO,
    medico_nrodocumento=NRODOCUMENTONUEVO,
    medico_colegiatura=COLEGIATURANUEVO,
    especialidad_id=ESPECIALIDAD
    WHERE medico_id=IDMEDICO;
    SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) FROM medico WHERE medico_nrodocumento=NRODOCUMENTONUEVO OR medico_colegiatura=COLEGIATURANUEVO);
    IF @CANTIDAD = 0 THEN
    	UPDATE usuario SET
        usu_email=EMAIL,
        usu_sexo=SEXO
        WHERE usu_id=IDUSUARIO;

        UPDATE medico SET
        medico_nombre=NOMBRES,
        medico_apepat=APEPAT,
        medico_apemat=APEMAT,
        medico_direccion=DIRECCION,
        medico_movil=MOVIL,
        medico_sexo=SEXO,
        medico_fenac=FECHANACIMIENTO,
        medico_nrodocumento=NRODOCUMENTONUEVO,
        medico_colegiatura=COLEGIATURANUEVO,
        especialidad_id=ESPECIALIDAD
        WHERE medico_id=IDMEDICO;
        SELECT 1;
    ELSE
    	SELECT 2;
    END IF;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_PACIENTE` (IN `IDPACIENTE` INT, IN `NOMBRE` VARCHAR(50), IN `APEPAT` VARCHAR(50), IN `APEMAT` VARCHAR(50), IN `DIRECCION` VARCHAR(200), IN `MOVIL` CHAR(12), IN `NRODOCUMENTOACTUAL` CHAR(12), IN `NRODOCUMENTONUEVO` CHAR(12), IN `SEXO` CHAR(1), IN `FECHANACIMIENTO` DATE, IN `ESTATUS` CHAR(10))   BEGIN
DECLARE CANTIDAD INT;
IF NRODOCUMENTOACTUAL=NRODOCUMENTONUEVO THEN
	UPDATE paciente SET
    paciente_nombre=NOMBRE,
    paciente_apepat=APEPAT,
    paciente_apemat=APEMAT,
    paciente_direccion=DIRECCION,
    paciente_movil=MOVIL,
    paciente_sexo=SEXO,
    paciente_fenac=FECHANACIMIENTO,
    paciente_estatus=ESTATUS
    WHERE paciente_id=IDPACIENTE;
    SELECT 1;
ELSE
	SET @CANTIDAD:=(SELECT COUNT(*) FROM paciente WHERE paciente_nrodocumento=NRODOCUMENTONUEVO);
    IF @CANTIDAD=0 THEN
    		UPDATE paciente SET
            paciente_nombre=NOMBRE,
            paciente_apepat=APEPAT,
            paciente_apemat=APEMAT,
            paciente_direccion=DIRECCION,
            paciente_movil=MOVIL,
            paciente_nrodocumento=NRODOCUMENTONUEVO,
            paciente_sexo=SEXO,
            paciente_fenac=FECHANACIMIENTO,
            paciente_estatus=ESTATUS
            WHERE paciente_id=IDPACIENTE;
            SELECT 1;
    ELSE
    		SELECT 2;
    END IF;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_PROCEDIMIENTO` (IN `ID` INT, IN `PROCEDIMIENTOACTUAL` VARCHAR(50), IN `PROCEDIMIENTONUEVO` VARCHAR(50), IN `ESTATUS` VARCHAR(10))   BEGIN
	DECLARE CANTIDAD INT;
IF PROCEDIMIENTOACTUAL = PROCEDIMIENTONUEVO THEN
	UPDATE procedimiento SET
    procedimiento_estatus=ESTATUS
    WHERE procedimiento_id=ID;
    SELECT 1;
ELSE
    SET @CANTIDAD:=(SELECT COUNT(*) FROM procedimiento WHERE procedimiento_nombre=PROCEDIMIENTONUEVO);
    IF @CANTIDAD=0 THEN
        UPDATE procedimiento SET
        procedimiento_estatus=ESTATUS,
        procedimiento_nombre=PROCEDIMIENTONUEVO
        WHERE procedimiento_id=ID;
        SELECT 1;
    ELSE
    SELECT 2;
    END IF;
 END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_CITA` (IN `IDPACIENTE` INT, IN `IDMEDICO` INT, IN `DESCRIPCION` TEXT, IN `IDUSUARIO` INT, IN `IDESPECIALIDAD` INT)   BEGIN
DECLARE NUMCITA INT;
SET @NUMCITA:=(SELECT COUNT(*)+1 FROM cita WHERE cita_feregistro=CURDATE());
INSERT cita(cita_nroatencion,cita_feregistro,medico_id,paciente_id,cita_estatus,cita_descripcion,usu_id,especialidad_id)
VALUES(@NUMCITA,CURDATE(),IDMEDICO,IDPACIENTE,'PENDIENTE',DESCRIPCION,IDUSUARIO,IDESPECIALIDAD);
SELECT LAST_INSERT_ID();

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_CONSULTA` (IN `ID` INT, IN `DESCRIPCION` VARCHAR(255), IN `DIAGNOSTICO` VARCHAR(250))   BEGIN
INSERT INTO consulta(consulta_descripcion,consulta_diagnostico,consulta_feregistro,consulta_estatus,cita_id)
VALUES(DESCRIPCION,DIAGNOSTICO,CURDATE(),'ATENDIDA',ID);
UPDATE cita SET
cita_estatus='ATENDIDA'
WHERE cita_id=ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_DETALLE_INSUMO` (IN `IDFUA` INT, IN `IDINSUMO` INT, IN `CANTIDAD` INT)   INSERT INTO detalle_insumo(fua_id ,insumo_id,detain_cantidad)
VALUES(IDFUA,IDINSUMO,CANTIDAD)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_DETALLE_MEDICAMENTO` (IN `IDFUA` INT, IN `IDMEDICAMENTO` INT, IN `CANTIDAD` INT)   INSERT INTO detalle_medicamento(fua_id,medicamento_id,detame_cantidad)
VALUES(IDFUA,IDMEDICAMENTO,CANTIDAD)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_DETALLE_PROCEDIMIENTO` (IN `ID` INT, IN `IDPROCEDIMIENTO` INT)   INSERT INTO detalle_procedimiento(fua_id,procedimiento_id)
VALUES(ID,IDPROCEDIMIENTO)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ESPECIALIDAD` (IN `ESPECIALIDAD` VARCHAR(50), IN `ESTATUS` VARCHAR(10))   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM especialidad WHERE especialidad_nombre=ESPECIALIDAD);

IF @CANTIDAD = 0 THEN
INSERT INTO especialidad(especialidad_nombre,especialidad_fregistro,especialidad_estatus)
VALUES(ESPECIALIDAD,CURDATE(),ESTATUS);
SELECT 1;
ELSE
SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_FUA` (IN `IDHISTORIAL` INT, IN `IDCONSULTA` INT)   BEGIN
	INSERT INTO fua(fua_fregistro,historia_id,consulta_id)VALUES(CURDATE(),IDHISTORIAL,IDCONSULTA);
    SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_INSUMO` (IN `INSUMO` VARCHAR(50), IN `STOCK` INT, IN `ESTATUS` VARCHAR(10))   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM insumo WHERE insumo_nombre=INSUMO);

IF @CANTIDAD = 0 THEN
INSERT INTO insumo(insumo_nombre,insumo_stock,insumo_feregistro,insumo_estatus)
VALUES(INSUMO,STOCK,CURDATE(),ESTATUS);
SELECT 1;
ELSE
SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_MEDICAMENTO` (IN `MEDICAMENTO` VARCHAR(50), IN `ALIAS` VARCHAR(50), IN `STOCK` INT, IN `ESTATUS` VARCHAR(10))   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:= (SELECT COUNT(*) FROM medicamento WHERE medicamento_nombre=MEDICAMENTO);
IF @CANTIDAD = 0 THEN
	INSERT INTO medicamento(medicamento_nombre,medicamento_alias,medicamento_stock,medicamento_fregistro,medicamento_estatus)
    VALUES(MEDICAMENTO,ALIAS,STOCK,CURDATE(),ESTATUS);
    SELECT 1;
ELSE
	SELECT 2;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_MEDICO` (IN `NOMBRES` VARCHAR(50), IN `APEPAT` VARCHAR(50), IN `APEMAT` VARCHAR(50), IN `DIRECCION` VARCHAR(200), IN `MOVIL` CHAR(12), IN `SEXO` CHAR(2), IN `FECHANACIMIENTO` DATE, IN `NRODOCUMENTO` CHAR(12), IN `COLEGIATURA` CHAR(12), IN `ESPECIALIDAD` INT, IN `USUARIO` VARCHAR(20), IN `CONTRA` VARCHAR(250), IN `ROL` INT, IN `EMAIL` VARCHAR(250))   BEGIN
DECLARE CANTIDADU INT;
DECLARE CANTIDADME INT;
SET @CANTIDADU:=(SELECT COUNT(*) FROM usuario WHERE usu_nombre=USUARIO);
IF @CANTIDADU = 0 THEN
    
    SET @CANTIDADME:=(SELECT COUNT(*) FROM medico WHERE medico_nrodocumento=NRODOCUMENTO OR medico_colegiatura=COLEGIATURA);
    IF @CANTIDADME=0 THEN
    
    INSERT INTO usuario(usu_nombre,usu_contrasena,usu_sexo,rol_id,usu_estatus,usu_email,usu_intento)
    VALUES (USUARIO,CONTRA,SEXO,ROL,'ACTIVO',EMAIL,0);
    
    INSERT INTO medico(medico_nombre,medico_apepat,medico_apemat,medico_direccion,medico_movil,medico_sexo,medico_fenac,medico_nrodocumento,medico_colegiatura,especialidad_id,usu_id)
    VALUES(NOMBRES,APEPAT,APEMAT,DIRECCION,MOVIL,SEXO,FECHANACIMIENTO,NRODOCUMENTO,COLEGIATURA,ESPECIALIDAD,(SELECT MAX(usu_id) FROM usuario));
    SELECT 1;
    ELSE
		SELECT 2;    
    END IF;
ELSE
	SELECT 2;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_PACIENTE` (IN `NOMBRE` VARCHAR(50), IN `APEPAT` VARCHAR(50), IN `APEMAT` VARCHAR(50), IN `DIRECCION` VARCHAR(200), IN `MOVIL` CHAR(12), IN `NRODOCUMENTO` CHAR(12), IN `SEXO` CHAR(1), IN `FECHANACIMIENTO` DATE)   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD :=(SELECT COUNT(*) FROM paciente WHERE paciente_nrodocumento=NRODOCUMENTO);
	IF @CANTIDAD=0 THEN
    	INSERT INTO paciente(paciente_nombre,paciente_apepat,paciente_apemat,paciente_direccion,paciente_movil,paciente_sexo,paciente_fenac,paciente_nrodocumento,paciente_estatus)
        VALUES(NOMBRE,APEPAT,APEMAT,DIRECCION,MOVIL,SEXO,FECHANACIMIENTO,NRODOCUMENTO,'ACTIVO');
        SELECT 1;
    ELSE
    	SELECT 2;
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_PROCEDIMIENTO` (IN `PROCEDIMIENTO` VARCHAR(50), IN `ESTATUS` VARCHAR(10))   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM procedimiento WHERE procedimiento_nombre=PROCEDIMIENTO);
IF @CANTIDAD=0 THEN
	INSERT INTO	procedimiento(procedimiento_nombre,procedimiento_fecregistro,procedimiento_estatus)
    VALUES(PROCEDIMIENTO,CURDATE(),ESTATUS);
    SELECT 1;
ELSE
    SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_USUARIO` (IN `USU` VARCHAR(20), IN `CONTRA` VARCHAR(250), IN `SEXO` CHAR(1), IN `ROL` INT, IN `EMAIL` VARCHAR(250))   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM usuario WHERE usu_nombre = BINARY USU);
IF @CANTIDAD=0 THEN
	INSERT INTO usuario(usu_nombre,usu_contrasena,usu_sexo,rol_id,usu_estatus,usu_email,usu_intento) VALUES(USU,CONTRA,SEXO,ROL,'ACTIVO',EMAIL,0);
    SELECT 1;
ELSE
	SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RESTABLECER_CONTRA` (IN `EMAIL` VARCHAR(250), IN `CONTRA` VARCHAR(255))   BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM usuario WHERE usu_email=EMAIL);
IF @CANTIDAD > 0 THEN
	UPDATE usuario SET
    usu_contrasena=CONTRA,
usu_intento = 0
    WHERE usu_email = EMAIL;
    SELECT 1;
ELSE
	SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TRAER_STOCK_INSUMO_H` (IN `ID` INT)   SELECT
insumo.insumo_id,
insumo.insumo_stock
FROM insumo
WHERE insumo.insumo_id=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TRAER_STOCK_MEDICAMENTO_H` (IN `ID` INT)   SELECT
medicamento.medicamento_nombre,
medicamento.medicamento_stock
FROM
medicamento
WHERE medicamento.medicamento_id=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VERIFICAR_USUARIO` (IN `USUARIO` VARCHAR(20))   SELECT 
usuario.usu_id,
usuario.usu_nombre,
usuario.usu_contrasena,
usuario.usu_sexo,
usuario.rol_id,
usuario.usu_estatus,
rol.rol_nombre,
usuario.usu_intento
FROM
usuario
INNER JOIN rol ON usuario.rol_id = rol.rol_id
WHERE usu_nombre = BINARY USUARIO$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `cita_id` int(11) NOT NULL,
  `cita_nroatencion` int(11) NOT NULL,
  `cita_feregistro` date NOT NULL,
  `cita_descripcion` text NOT NULL,
  `usu_id` int(11) NOT NULL,
  `medico_id` int(11) NOT NULL,
  `especialidad_id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `cita_estatus` enum('PENDIENTE','CANCELADA','ATENDIDA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `consulta_id` int(11) NOT NULL,
  `consulta_descripcion` text NOT NULL,
  `consulta_diagnostico` text NOT NULL,
  `consulta_feregistro` date NOT NULL,
  `consulta_estatus` enum('ATENDIDA','PENDIENTE') NOT NULL,
  `cita_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_insumo`
--

CREATE TABLE `detalle_insumo` (
  `detain_id` int(11) NOT NULL,
  `detain_cantidad` int(255) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `fua_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `detalle_insumo`
--
DELIMITER $$
CREATE TRIGGER `TR_STOCK_INSUMO` BEFORE INSERT ON `detalle_insumo` FOR EACH ROW BEGIN
DECLARE STOCKACTUAL DECIMAL(10,2);
SET @STOCKACTUAL:=(SELECT insumo_stock FROM insumo WHERE insumo.insumo_id=new.insumo_id);
UPDATE insumo 
SET 
insumo_stock=@STOCKACTUAL-new.detain_cantidad
WHERE insumo.insumo_id=new.insumo_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_medicamento`
--

CREATE TABLE `detalle_medicamento` (
  `detame_id` int(11) NOT NULL,
  `detame_cantidad` int(11) NOT NULL,
  `medicamento_id` int(11) NOT NULL,
  `fua_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `detalle_medicamento`
--
DELIMITER $$
CREATE TRIGGER `TR_STOCK_MEDICAMENTO` BEFORE INSERT ON `detalle_medicamento` FOR EACH ROW BEGIN
DECLARE STOCKACTUAL DECIMAL(10,2);
SET @STOCKACTUAL:=(SELECT medicamento_stock FROM medicamento WHERE medicamento.medicamento_id =new.medicamento_id );
UPDATE medicamento 
SET 
medicamento_stock=@STOCKACTUAL-new.detame_cantidad
WHERE medicamento.medicamento_id =new.medicamento_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_procedimiento`
--

CREATE TABLE `detalle_procedimiento` (
  `detaproce_id` int(11) NOT NULL,
  `procedimiento_id` int(11) NOT NULL,
  `fua_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `especialidad_id` int(11) NOT NULL,
  `especialidad_nombre` varchar(50) NOT NULL,
  `especialidad_fregistro` date NOT NULL,
  `especialidad_estatus` enum('ACTIVO','INACTIVO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`especialidad_id`, `especialidad_nombre`, `especialidad_fregistro`, `especialidad_estatus`) VALUES
(1, 'FORENSE', '2023-08-01', 'ACTIVO'),
(2, 'ODONTOLOGIA', '2023-08-02', 'ACTIVO'),
(3, 'PEDIATRA', '2023-08-11', 'ACTIVO'),
(4, 'GINECOLOGIA', '2023-08-01', 'INACTIVO'),
(5, 'CARDIOLOGIA', '2023-08-11', 'INACTIVO'),
(6, 'FARMACOLOGIA', '2023-08-11', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fua`
--

CREATE TABLE `fua` (
  `fua_id` int(11) NOT NULL,
  `fua_fregistro` date NOT NULL,
  `historia_id` int(11) NOT NULL,
  `consulta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia`
--

CREATE TABLE `historia` (
  `historia_id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `historia_feregistro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo`
--

CREATE TABLE `insumo` (
  `insumo_id` int(11) NOT NULL,
  `insumo_nombre` varchar(50) NOT NULL,
  `insumo_stock` int(11) NOT NULL,
  `insumo_feregistro` date NOT NULL,
  `insumo_estatus` enum('ACTIVO','INACTIVO','AGOTADO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `insumo`
--

INSERT INTO `insumo` (`insumo_id`, `insumo_nombre`, `insumo_stock`, `insumo_feregistro`, `insumo_estatus`) VALUES
(1, 'GUANTES', 8, '2023-08-02', 'INACTIVO'),
(2, 'JERINGAS', 0, '2023-08-02', 'AGOTADO'),
(3, 'AGUJAS', 2, '2023-08-02', 'INACTIVO'),
(4, 'MASCARILLAS', 25, '2023-08-02', 'ACTIVO'),
(5, 'PINZAS', 12, '2023-08-02', 'ACTIVO'),
(6, 'ADHESIVOS', 10, '2023-08-02', 'INACTIVO'),
(7, 'VENDAS', 10, '2023-08-09', 'ACTIVO'),
(8, 'GASAS', 10, '2023-08-09', 'ACTIVO'),
(9, 'SUTURASDEACERO', 12, '2023-08-09', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `medicamento_id` int(11) NOT NULL,
  `medicamento_nombre` varchar(50) NOT NULL,
  `medicamento_alias` varchar(50) NOT NULL,
  `medicamento_stock` int(11) NOT NULL,
  `medicamento_fregistro` date NOT NULL,
  `medicamento_estatus` enum('ACTIVO','INACTIVO','AGOTADO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`medicamento_id`, `medicamento_nombre`, `medicamento_alias`, `medicamento_stock`, `medicamento_fregistro`, `medicamento_estatus`) VALUES
(1, 'Verapamilo', 'Vepa', 4, '2023-08-09', 'ACTIVO'),
(2, 'Somastotatina', 'Soma', 1, '2023-08-09', 'INACTIVO'),
(3, 'Paracetamol', 'Parace', 0, '2023-08-08', 'AGOTADO'),
(4, 'Propofol', 'propo', 12, '2023-08-10', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `medico_id` int(11) NOT NULL,
  `medico_nombre` varchar(50) NOT NULL,
  `medico_apepat` varchar(50) NOT NULL,
  `medico_apemat` varchar(50) NOT NULL,
  `medico_direccion` varchar(200) NOT NULL,
  `medico_movil` char(12) NOT NULL,
  `medico_sexo` char(1) NOT NULL,
  `medico_fenac` date NOT NULL,
  `medico_nrodocumento` char(12) NOT NULL,
  `medico_colegiatura` char(12) NOT NULL,
  `especialidad_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `paciente_id` int(11) NOT NULL,
  `paciente_nombre` varchar(50) NOT NULL,
  `paciente_apepat` varchar(50) NOT NULL,
  `paciente_apemat` varchar(50) NOT NULL,
  `paciente_direccion` varchar(200) NOT NULL,
  `paciente_movil` char(12) NOT NULL,
  `paciente_sexo` char(1) NOT NULL,
  `paciente_fenac` date NOT NULL,
  `paciente_nrodocumento` char(12) NOT NULL,
  `paciente_estatus` enum('ACTIVO','INACTIVO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `paciente`
--
DELIMITER $$
CREATE TRIGGER `TR_CREAR_HISTORIAL` AFTER INSERT ON `paciente` FOR EACH ROW INSERT INTO historia(paciente_id,historia_feregistro)
VALUES(new.paciente_id,CURDATE())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimiento`
--

CREATE TABLE `procedimiento` (
  `procedimiento_id` int(11) NOT NULL,
  `procedimiento_nombre` varchar(50) NOT NULL,
  `procedimiento_fecregistro` date NOT NULL,
  `procedimiento_estatus` enum('ACTIVO','INACTIVO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procedimiento`
--

INSERT INTO `procedimiento` (`procedimiento_id`, `procedimiento_nombre`, `procedimiento_fecregistro`, `procedimiento_estatus`) VALUES
(1, 'Auscultacíon', '2020-05-06', 'ACTIVO'),
(2, 'Inspecciónmedica', '2020-05-06', 'ACTIVO'),
(3, 'Palpación', '2020-05-06', 'ACTIVO'),
(5, 'Electromiografía', '2023-08-01', 'ACTIVO'),
(6, 'Electrocardiografía', '2023-08-01', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'RECEPCIONISTA'),
(3, 'MEDICO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_nombre` varchar(20) NOT NULL,
  `usu_contrasena` varchar(255) NOT NULL,
  `usu_sexo` char(1) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `usu_estatus` enum('ACTIVO','INACTIVO') NOT NULL,
  `usu_email` varchar(250) NOT NULL,
  `usu_intento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_nombre`, `usu_contrasena`, `usu_sexo`, `rol_id`, `usu_estatus`, `usu_email`, `usu_intento`) VALUES
(1, 'admin', '$2y$10$0BQAvLjtUArnUvRrXbMHWu9U3M4QcV2n6cAkBexJV3raE4teVop1.', 'M', 1, 'ACTIVO', 'admin@gmail.com', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`cita_id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `medico_id` (`medico_id`),
  ADD KEY `cita_ibfk_3` (`usu_id`),
  ADD KEY `cita_ibfk_4` (`especialidad_id`);

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`consulta_id`),
  ADD KEY `cita_id` (`cita_id`);

--
-- Indices de la tabla `detalle_insumo`
--
ALTER TABLE `detalle_insumo`
  ADD PRIMARY KEY (`detain_id`),
  ADD KEY `insumo_id` (`insumo_id`),
  ADD KEY `fua_id` (`fua_id`);

--
-- Indices de la tabla `detalle_medicamento`
--
ALTER TABLE `detalle_medicamento`
  ADD PRIMARY KEY (`detame_id`),
  ADD KEY `medicamento_id` (`medicamento_id`),
  ADD KEY `fua_id` (`fua_id`);

--
-- Indices de la tabla `detalle_procedimiento`
--
ALTER TABLE `detalle_procedimiento`
  ADD PRIMARY KEY (`detaproce_id`),
  ADD KEY `fua_id` (`fua_id`),
  ADD KEY `procedimiento_id` (`procedimiento_id`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`especialidad_id`);

--
-- Indices de la tabla `fua`
--
ALTER TABLE `fua`
  ADD PRIMARY KEY (`fua_id`),
  ADD KEY `historia_id` (`historia_id`),
  ADD KEY `consulta_id` (`consulta_id`);

--
-- Indices de la tabla `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`historia_id`),
  ADD KEY `paciente_id` (`paciente_id`);

--
-- Indices de la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`insumo_id`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`medicamento_id`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`medico_id`),
  ADD KEY `usu_id` (`usu_id`),
  ADD KEY `especialidad_id` (`especialidad_id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`paciente_id`);

--
-- Indices de la tabla `procedimiento`
--
ALTER TABLE `procedimiento`
  ADD PRIMARY KEY (`procedimiento_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `cita_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `consulta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_insumo`
--
ALTER TABLE `detalle_insumo`
  MODIFY `detain_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_medicamento`
--
ALTER TABLE `detalle_medicamento`
  MODIFY `detame_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_procedimiento`
--
ALTER TABLE `detalle_procedimiento`
  MODIFY `detaproce_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `especialidad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `fua`
--
ALTER TABLE `fua`
  MODIFY `fua_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historia`
--
ALTER TABLE `historia`
  MODIFY `historia_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumo`
--
ALTER TABLE `insumo`
  MODIFY `insumo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `medicamento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `medico_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `paciente_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `procedimiento`
--
ALTER TABLE `procedimiento`
  MODIFY `procedimiento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`paciente_id`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`medico_id`) REFERENCES `medico` (`medico_id`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`),
  ADD CONSTRAINT `cita_ibfk_4` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidad` (`especialidad_id`);

--
-- Filtros para la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`cita_id`) REFERENCES `cita` (`cita_id`);

--
-- Filtros para la tabla `detalle_insumo`
--
ALTER TABLE `detalle_insumo`
  ADD CONSTRAINT `detalle_insumo_ibfk_1` FOREIGN KEY (`insumo_id`) REFERENCES `insumo` (`insumo_id`),
  ADD CONSTRAINT `detalle_insumo_ibfk_2` FOREIGN KEY (`fua_id`) REFERENCES `fua` (`fua_id`);

--
-- Filtros para la tabla `detalle_medicamento`
--
ALTER TABLE `detalle_medicamento`
  ADD CONSTRAINT `detalle_medicamento_ibfk_1` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamento` (`medicamento_id`),
  ADD CONSTRAINT `detalle_medicamento_ibfk_2` FOREIGN KEY (`fua_id`) REFERENCES `fua` (`fua_id`);

--
-- Filtros para la tabla `detalle_procedimiento`
--
ALTER TABLE `detalle_procedimiento`
  ADD CONSTRAINT `detalle_procedimiento_ibfk_1` FOREIGN KEY (`fua_id`) REFERENCES `fua` (`fua_id`),
  ADD CONSTRAINT `detalle_procedimiento_ibfk_2` FOREIGN KEY (`procedimiento_id`) REFERENCES `procedimiento` (`procedimiento_id`);

--
-- Filtros para la tabla `fua`
--
ALTER TABLE `fua`
  ADD CONSTRAINT `fua_ibfk_1` FOREIGN KEY (`historia_id`) REFERENCES `historia` (`historia_id`),
  ADD CONSTRAINT `fua_ibfk_2` FOREIGN KEY (`consulta_id`) REFERENCES `consulta` (`consulta_id`);

--
-- Filtros para la tabla `historia`
--
ALTER TABLE `historia`
  ADD CONSTRAINT `historia_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`paciente_id`);

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`),
  ADD CONSTRAINT `medico_ibfk_2` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidad` (`especialidad_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
