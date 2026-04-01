# QR Attendance System: Sistema de Control de Asistencias con QR

## 🚀 Descripción del Proyecto

El sistema permite gestionar el control de asistencias de empleados mediante el escaneo de códigos QR.

El sistema registra automáticamente la entrada y salida de los empleados y genera métricas para el área de recursos humanos.

Incluye funcionalidades como:

-Escaneo de códigos QR para registro de asistencia
-Panel de administración para recursos humanos
-Detección automática de retardos
-Notificaciones en tiempo real
-Dashboard analítico con métricas de asistencia
-Sistema automático de alertas de ausencia
-Arquitectura multiempresa

---

## 🧠 Objetivo

Construir un sistema backend funcional que permita:

-Registro automatizado de asistencias
-Gestión centralizada de empleados
-Generación de métricas y reportes
-Seguridad mediante autenticación
-Escalabilidad para múltiples empresas

---

## 🛠️ Stack Tecnológico

| Área                 | Tecnología               |
|----------------------|--------------------------|
| Backend              | PHP                      |
| Base de datos        | MySQL                    |
| Frontend             | HTML5 / CSS / JavaScript |
| Framework UI         | Bootstrap                |
| Gráficas             | Chart.js                 |
| Escaneo QR           | HTML5 QR Scanner         |
| Envío de correos     | PHPMailer
| Autenticación        | JWT                      |
| Control de versiones | Git / GitHub             |

---

## ⚙️ Funcionalidades Principales

### 👥 Gestión de Empleados

-Registro de empleados
-Generación de código QR único por empleado
-Administración de información de empleados
-Asignación de horarios de entrada

---

### 📷 Registro de Asistencia mediante QR

- Escaneo de código QR desde cámara
- Registro automático de hora de entrada
- Registro de hora de salida
- Prevención de duplicados en el mismo día

---

### 🧠 Detección Automática de Retardos

El sistema compara la hora de llegada con el horario asignado al empleado.

Ejemplo:

```text
Horario de entrada: 08:00
Hora de registro: 08:10
Resultado: Retardo
```

Esto permite generar estadísticas de puntualidad.

---

### 🔔 Notificaciones en Tiempo Real

Cuando un empleado registra su asistencia:

- Se genera una notificación
- Aparece automáticamente en el dashboard
- Permite monitorear actividad del sistema en vivo

---

### 📊 Dashboard Analítico de Recursos Humanos

El panel administrativo incluye métricas como:

- Total de empleados
- Asistencias registradas del día
- Número de retardos
- Faltas del día
- Historial de asistencias

También incluye gráficas generadas con **Chart.js** para visualizar:

- Asistencias por día
- Tendencias de puntualidad
- Actividad reciente

---

### 📧 Sistema Automático de Alertas de Ausencia

El sistema incluye un módulo que detecta automáticamente empleados que no registraron asistencia en el día.

Al finalizar la jornada laboral:

El sistema consulta la base de datos
Identifica empleados sin registro de asistencia
Genera un reporte automático
Envía un correo al departamento de Recursos Humanos

Este proceso utiliza PHPMailer para enviar el reporte mediante SMTP.

Ejemplo de correo generado:

Reporte de Faltas - 2026-03-29

Los siguientes empleados no registraron asistencia hoy:

- Juan Pérez
- María López
- Carlos Sánchez

Esto permite que Recursos Humanos detecte ausencias sin revisar manualmente el sistema.

---


## 🔌 Módulos Principales del Sistema

### 🔐 Autenticación

- Login de administradores
- Protección de rutas
- Manejo de sesiones o JWT

---

### 👨‍💼 Gestión de Empleados

- Crear empleados
- Generar código QR único
- Editar información del empleado
- Consultar registros de asistencia

---

### 📅 Registro de Asistencias

- Escaneo QR
- Registro automático en base de datos
- Validación de duplicados
- Registro de retardos

---

### 📊 Dashboard

- Panel administrativo
- Estadísticas en tiempo real
- Tabla de asistencias
- Gráficas de análisis

---

## 🗄️ Base de Datos

Principales tablas del sistema:

### empleados

| Campo            | Tipo    |
|------------------|---------|
| id               | INT     |
| nombre           | VARCHAR |
| apellido_paterno | VARCHAR |
| codigo_qr        | VARCHAR |
| hora_entrada     | TIME    |

---

### asistencias

| Campo        | Tipo    |
|--------------|---------|
| id           | INT     |
| empleado_id  | INT     |
| fecha        | DATE    |
| hora_entrada | TIME    |
| hora_salida  | TIME    |
| retardo      | BOOLEAN |

---

### notificaciones

| Campo   | Tipo     |
|--------|----------|
| id     | INT      |
| mensaje| TEXT     |
| fecha  | DATETIME |
| leido  | BOOLEAN  |

---

### empresas

| Campo          | Tipo      |
|---------------|-----------|
| id            | INT       |
| nombre        | VARCHAR   |
| email         | VARCHAR   |
| fecha_registro| TIMESTAMP |

---

## 🔄 Flujo de Uso

1. El administrador registra empleados en el sistema  
2. Se genera un código QR único para cada empleado  
3. El empleado escanea su QR al llegar  
4. El sistema registra la asistencia automáticamente  
5. Se verifica si existe retardo  
6. Se genera una notificación  
7. El dashboard actualiza métricas y gráficas  

---

## 🚀 Instalación y Ejecución

### 1. Clonar repositorio

```bash
git clone https://github.com/tu-repositorio
```

---

### 2. Importar base de datos

Importar el archivo:

```bash
consultas_asistencias.sql
```

en MySQL.

---

### 3. Configurar conexión a base de datos

Editar el archivo:

```bash
config/database.php
```

con las credenciales de tu servidor MySQL.

---

### 4. Ejecutar servidor local

Puedes utilizar:

- XAMPP
- Laragon
- Apache

Acceder al sistema desde:

```bash
http://localhost/qr-attendance-system
```

---

## 🧪 Testing

El sistema puede probarse mediante:

- Navegador web
- Escaneo de QR con cámara
- Herramientas de testing HTTP como Postman

---

## 📈 Habilidades Demostradas

Este proyecto demuestra habilidades en:

- Desarrollo backend con PHP
- Diseño de bases de datos relacionales
- Arquitectura cliente-servidor
- Implementación de dashboards analíticos
- Integración de escaneo QR
- Manejo de eventos en tiempo real
- Seguridad y autenticación

---

## 👨‍💻 Autor

```bash
Juan Carlos Reynoso Zúñiga
```


<img width="1915" height="948" alt="image" src="https://github.com/user-attachments/assets/5e481423-1ec9-4fd9-8e85-c3faf0ee4095" />
<img width="1919" height="943" alt="image" src="https://github.com/user-attachments/assets/91c728fb-3d3d-435d-b1a7-4f16ea6b5682" />
<img width="1919" height="938" alt="image" src="https://github.com/user-attachments/assets/365ee409-0af3-4554-8751-15944e7e2720" />
<img width="1919" height="948" alt="image" src="https://github.com/user-attachments/assets/4a7a1ce3-7d96-43af-ac46-0c8d90052891" />
<img width="1919" height="947" alt="image" src="https://github.com/user-attachments/assets/3496328f-518e-4286-b74d-e96a083cac93" />
<img width="1919" height="939" alt="image" src="https://github.com/user-attachments/assets/7735c6e7-fe66-4c28-b05e-045399760976" />
<img width="1915" height="954" alt="image" src="https://github.com/user-attachments/assets/257ca694-6bb0-4b59-b1cf-99653f1ab47e" />
<img width="1919" height="939" alt="image" src="https://github.com/user-attachments/assets/6f68616c-a430-4c12-a5b5-f541f08216f2" />
<img width="1912" height="943" alt="image" src="https://github.com/user-attachments/assets/961f5904-a6d6-4f89-bc95-376b7c9bf831" />
<img width="1919" height="947" alt="image" src="https://github.com/user-attachments/assets/5dcc4734-f41c-42e2-b49b-001da2b810e6" />
<img width="809" height="238" alt="image" src="https://github.com/user-attachments/assets/29cdb0ce-95d5-4a7a-ab43-761242a53851" />


<img width="1848" height="266" alt="image" src="https://github.com/user-attachments/assets/1eca2f06-81a5-49d0-bc8e-8529b22146aa" />

<img width="1917" height="936" alt="image" src="https://github.com/user-attachments/assets/67e267ba-a27c-4593-a31a-ffb33144debb" />
<img width="1908" height="945" alt="image" src="https://github.com/user-attachments/assets/5cfa7e82-5984-46b8-bddf-c91af2913e8d" />

<img width="1912" height="945" alt="image" src="https://github.com/user-attachments/assets/da840105-fefe-492e-b91e-433f5db170a5" />

<img width="1913" height="952" alt="image" src="https://github.com/user-attachments/assets/3e341e94-af68-4074-8924-b26f14c282f8" />


