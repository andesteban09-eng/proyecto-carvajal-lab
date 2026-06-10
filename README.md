# Proyecto Carvajal Lab

Sistema web desarrollado como proyecto académico para la gestión de servicios de laboratorio clínico, citas médicas y administración de pacientes.

## Objetivo

Desarrollar una aplicación web que permita gestionar los procesos principales de un laboratorio clínico, incluyendo:

* Registro de pacientes.
* Gestión de profesionales de salud.
* Administración de servicios de laboratorio.
* Agendamiento de citas.
* Consulta y cancelación de citas.
* Generación de reportes y comprobantes en PDF.
* Cotización de servicios.
* Gestión de sedes y disponibilidad de profesionales.

---

## Tecnologías utilizadas

### Backend

* PHP
* MySQL

### Frontend

* HTML5
* CSS3
* Bootstrap 5
* JavaScript

### Librerías

* FPDF para generación de documentos PDF.

---

## Funcionalidades implementadas

### Gestión de usuarios

* Inicio de sesión.
* Control de acceso por roles.
* Registro de pacientes.

### Gestión de citas

* Solicitud de citas.
* Selección de profesional según el tipo de servicio.
* Consulta de horarios disponibles.
* Visualización de citas agendadas.
* Cancelación de citas.
* Consulta detallada de una cita.

### Gestión de reportes

* Generación de comprobante de cita en PDF.
* Cotización de servicios de laboratorio.

### Administración de datos

* Gestión de tipos de servicio.
* Gestión de servicios.
* Gestión de profesionales.
* Gestión de agendas.
* Gestión de pacientes.

---

## Estructura general del proyecto

```text
controlador/
modelo/
vista/
css/
librerias/
```

---

## Posibles mejoras futuras

Durante el desarrollo se identificó una oportunidad de mejora relacionada con el proceso de solicitud de exámenes.

Actualmente el sistema permite que un paciente agende una cita seleccionando un tipo de servicio y un profesional disponible.

Sin embargo, se identificó un segundo escenario de negocio:

* Pacientes remitidos por un profesional de salud.
* Pacientes particulares que desean solicitar directamente un examen específico.

Para una futura versión del sistema se propone implementar un módulo independiente denominado:

**Solicitud de Exámenes Particulares**

Este módulo permitiría:

* Seleccionar directamente un servicio específico.
* Generar una solicitud sin necesidad de agendar una consulta médica previa.
* Mantener separada la lógica de consultas médicas y solicitudes de laboratorio.
* Facilitar procesos de cotización y pago de exámenes individuales.

Esta mejora fue documentada como una posible evolución del sistema, pero no se implementó en la versión actual para mantener la estabilidad y alcance definidos para el proyecto académico.

---

## Estado actual

Proyecto en desarrollo académico.

Versión funcional con módulos principales de autenticación, agendamiento de citas, gestión de pacientes, cotizaciones y generación de reportes PDF.
