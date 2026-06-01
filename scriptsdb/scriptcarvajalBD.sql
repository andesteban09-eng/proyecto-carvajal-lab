create DATABASE IF NOT EXISTS proyectocarvajallab;
USE proyectocarvajallab;

CREATE TABLE `paciente` (
  `idPaciente` int NOT NULL AUTO_INCREMENT,
  `TipoDoc` varchar(10) NOT NULL,
  `NumDoc` varchar(45) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `FechaNacimiento` datetime NOT NULL,
  `Sexo` varchar(20) NOT NULL,
  `Telefono` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Direccion` varchar(45) NOT NULL,
  `TipoSangre` varchar(10) NOT NULL,
  `Estado` tinyint NOT NULL DEFAULT '1',
  `Contrasena` varchar(250) NOT NULL,
  PRIMARY KEY (`idPaciente`),
  CONSTRAINT `chk_estado` CHECK ((`Estado` in (1,2,3,4))),
  CONSTRAINT `chk_tipodoc` CHECK ((`TipoDoc` in (_utf8mb3'CC',_utf8mb3'TI',_utf8mb3'CE',_utf8mb3'PAS',_utf8mb3'RC',_utf8mb3'PPT',_utf8mb3'OT')))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;


CREATE TABLE `profesionalsalud` (
  `idProfesionalSalud` int NOT NULL AUTO_INCREMENT,
  `TipoDoc` tinyint NOT NULL,
  `NumDoc` varchar(20) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Estado` tinyint NOT NULL,
  `Contrasena` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idProfesionalSalud`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


CREATE TABLE `sede` (
  `idSede` int NOT NULL AUTO_INCREMENT,
  `Ciudad` varchar(45) NOT NULL,
  `Direccion` varchar(45) NOT NULL,
  `DetallesSede` varchar(100) NOT NULL,
  PRIMARY KEY (`idSede`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


CREATE TABLE `tiposervicio` (
  `idTipoServicio` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Procedimiento` tinyint NOT NULL,
  `Prerequisitos` varchar(45) NOT NULL,
  `DetalleTipoServicio` varchar(100) NOT NULL,
  `Estado` tinyint NOT NULL,
  PRIMARY KEY (`idTipoServicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


CREATE TABLE `agenda` (
  `idHorarioDispo` int NOT NULL AUTO_INCREMENT,
  `DiaSemana` varchar(45) NOT NULL,
  `Hora` time NOT NULL,
  `Consultorio` varchar(45) NOT NULL,
  `ProfesionalSalud_idMedico` int NOT NULL,
  `Sede_idSede` int NOT NULL,
  PRIMARY KEY (`idHorarioDispo`),
  KEY `fk_Agenda_ProfesionalSalud1_idx` (`ProfesionalSalud_idMedico`),
  KEY `fk_Agenda_Sede1_idx` (`Sede_idSede`),
  CONSTRAINT `fk_Agenda_ProfesionalSalud1` FOREIGN KEY (`ProfesionalSalud_idMedico`) REFERENCES `profesionalsalud` (`idProfesionalSalud`),
  CONSTRAINT `fk_Agenda_Sede1` FOREIGN KEY (`Sede_idSede`) REFERENCES `sede` (`idSede`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


CREATE TABLE `perfiltiposervicio` (
  `idPerfilTipoServicio` int NOT NULL AUTO_INCREMENT,
  `TipoServicio_idTipoServicio` int NOT NULL,
  `ProfesionalSalud_idMedico` int NOT NULL,
  PRIMARY KEY (`idPerfilTipoServicio`),
  KEY `fk_PerfilTipoServicio_TipoServicio_idx` (`TipoServicio_idTipoServicio`),
  KEY `fk_PerfilTipoServicio_ProfesionalSalud1_idx` (`ProfesionalSalud_idMedico`),
  CONSTRAINT `fk_PerfilTipoServicio_ProfesionalSalud1` FOREIGN KEY (`ProfesionalSalud_idMedico`) REFERENCES `profesionalsalud` (`idProfesionalSalud`),
  CONSTRAINT `fk_PerfilTipoServicio_TipoServicio` FOREIGN KEY (`TipoServicio_idTipoServicio`) REFERENCES `tiposervicio` (`idTipoServicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `cita` (
  `idCita` int NOT NULL AUTO_INCREMENT,
  `ProfesionalSalud_idMedico` int NOT NULL,
  `Sede_idSede` int NOT NULL,
  `idPaciente` int NOT NULL,
  `TipoServicio_idTipoServicio` int NOT NULL,
  `FechaCita` datetime NOT NULL,
  `DetalleCita` varchar(100) NOT NULL,
  PRIMARY KEY (`idCita`),
  KEY `fk_Cita_ProfesionalSalud1_idx` (`ProfesionalSalud_idMedico`),
  KEY `fk_Cita_Sede1_idx` (`Sede_idSede`),
  KEY `fk_Cita_TipoServicio1_idx` (`TipoServicio_idTipoServicio`),
  KEY `fk_Cita_Paciente` (`idPaciente`),
  CONSTRAINT `fk_Cita_Paciente` FOREIGN KEY (`idPaciente`) REFERENCES `paciente` (`idPaciente`),
  CONSTRAINT `fk_Cita_ProfesionalSalud1` FOREIGN KEY (`ProfesionalSalud_idMedico`) REFERENCES `profesionalsalud` (`idProfesionalSalud`),
  CONSTRAINT `fk_Cita_Sede` FOREIGN KEY (`Sede_idSede`) REFERENCES `sede` (`idSede`),
  CONSTRAINT `fk_Cita_TipoServicio1` FOREIGN KEY (`TipoServicio_idTipoServicio`) REFERENCES `tiposervicio` (`idTipoServicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `servicio` (
  `idServicio` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `DetalleServicio` varchar(45) NOT NULL,
  `Estado` tinyint NOT NULL,
  `Cita_idCita` int NOT NULL,
  `TipoServicio_idTipoServicio` int NOT NULL,
  PRIMARY KEY (`idServicio`),
  KEY `fk_Servicio_Cita1_idx` (`Cita_idCita`),
  KEY `fk_Servicio_TipoServicio1_idx` (`TipoServicio_idTipoServicio`),
  CONSTRAINT `fk_Servicio_Cita1` FOREIGN KEY (`Cita_idCita`) REFERENCES `cita` (`idCita`),
  CONSTRAINT `fk_Servicio_TipoServicio1` FOREIGN KEY (`TipoServicio_idTipoServicio`) REFERENCES `tiposervicio` (`idTipoServicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `ordenlaboratorio` (
  `idordenLaboratorio` int NOT NULL AUTO_INCREMENT,
  `FechaOrden` datetime NOT NULL,
  `TipoExamen` varchar(45) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Estado` tinyint NOT NULL,
  `Resultado` varchar(45) NOT NULL,
  `Observaciones` varchar(100) NOT NULL,
  `Sede_idSede` int NOT NULL,
  `Cita_idCita` int NOT NULL,
  PRIMARY KEY (`idordenLaboratorio`),
  KEY `fk_OrdenLaboratorio_Sede1_idx` (`Sede_idSede`),
  KEY `fk_OrdenLaboratorio_Cita1_idx` (`Cita_idCita`),
  CONSTRAINT `fk_OrdenLaboratorio_Cita1` FOREIGN KEY (`Cita_idCita`) REFERENCES `cita` (`idCita`),
  CONSTRAINT `fk_OrdenLaboratorio_Sede1` FOREIGN KEY (`Sede_idSede`) REFERENCES `sede` (`idSede`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

ALTER TABLE paciente
add constraint chk_sexo CHECK (Sexo IN ('Masculino', 'Femenino', 'Otro'));