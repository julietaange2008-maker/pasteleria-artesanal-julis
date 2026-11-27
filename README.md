# Pastelería Artesanal — Migración a PHP (TP N° 4)
## Rodriguez Diaz Julieta
## 1. Título y Descripción del Proyecto
Proyecto **Pastelería Artesanal** evolucionado desde una maqueta estática hacia **PHP** en el marco del Trabajo Práctico N° 4 (*Migración a PHP, Modularización (SSI) y Renderizado Server-Side (SSR)*). Se implementaron plantillas modulares con `require_once` (`header.php`, `nav.php` y `footer.php`), título de página dinámico y carga de variables de entorno desde `.env` con plantilla `.env.example`.


## 3. Tecnologías Utilizadas
- HTML5
- CSS3
- JavaScript
- PHP 8.x
- Laragon (Apache / entorno local)
- Git bash y GitHub

## 4. Instrucciones de Instalación y Ejecución Local
1. Clonar el repositorio dentro de `C:\laragon\www\`:
   ```bash
   git clone <URL-DE-TU-REPOSITORIO-EN-GITHUB>
   cp .env.example .env

## 5. Evidencia de Funcionamiento
### Servidor Local Ejecutándose
![Servidor local ejecutándose](capturas/captura1.jpeg)

### Estructura Modular (SSI)
![Estructura modular (SSI)](capturas/captura2.jpeg)

### Navegación Dinámica
![Navegación dinámica](capturas/captura3.jpeg)

### Configuración de Variables de Entorno
![Configuración de variables de entorno](capturas/captura4.jpeg)
## Clase 6 — Bases de Datos Relacionales en MySQL

En el directorio `clase6/` se desarrolló el modelado relacional, el script DDL y las consultas CRUD aplicadas al proyecto **Pastelería Artesanal**, probadas en MySQL local a través de Laragon y HeidiSQL.

### Archivos y Contenidos

* **`clase6/NORMALIZACION.md`:** análisis de una tabla inicial de pedidos sin normalizar y su evolución paso a paso hasta la **Tercera Forma Normal (3FN)**, eliminando campos multivalorados, dependencias parciales y dependencias transitivas, con el detalle de claves primarias (`PK`) y foráneas (`FK`) en las tablas resultantes (`roles`, `usuarios`, `categorias`, `estados_pedido`, `productos`, `pedidos` y `detalle_pedidos`).
* **`clase6/schema.sql`:** script DDL que crea la base de datos `pasteleria_artesanal_db` y las tablas normalizadas en 3FN con `INT AUTO_INCREMENT PRIMARY KEY`, restricciones `FOREIGN KEY`, campos de auditoría (`created_at` y `updated_at`) e índices explícitos (`CREATE INDEX`) sobre columnas clave de búsqueda y filtrado.
* **`clase6/consultas.sql`:** script DML con operaciones CRUD para validar el esquema con datos de prueba: inserciones (`INSERT`) en tablas maestras y entidades vinculadas por clave foránea, consultas `SELECT` con `WHERE`, `ORDER BY` e `INNER JOIN`, actualización (`UPDATE`) con `WHERE` y eliminación (`DELETE`) con `WHERE`.