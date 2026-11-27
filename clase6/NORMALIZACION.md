# Parte 1 — Normalización Aplicada al Proyecto: Pastelería Artesanal

## 1. Entidad / Tabla Principal sin Normalizar

En un diseño inicial sin normalizar (`pedidos_sin_normalizar`), un único registro mezcla datos del cliente, su cuenta/rol, múltiples teléfonos o productos en una sola celda y datos repetidos de categorías o estados:

| id_pedido | cliente_nombre | cliente_email | cliente_rol | telefonos_cliente | productos_solicitados | categoria_principal | estado_pedido |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| 101 | Pepito Sanchez | sanchezpepi11@gmail.com | Cliente | `387-111111, 387-222222` | `Torta Chocolate (1), Alfajores (12)` | Tortas artesanales | Confirmado |
| 102 | Laura Gómez | laura.gomez@correo.com | Cliente | `387-333333` | `Torta Chocolate (1), Tarta Frutilla (2)` | Tortas artesanales | Pendiente |

**Problemas detectados:**
* **Campos multivalorados:** `telefonos_cliente` y `productos_solicitados` guardan varios valores dentro de una misma celda.
* **Redundancia y anomalías:** si cambia el nombre de una categoría o el estado de un pedido, o si un cliente cambia su correo o teléfono, hay que actualizar múltiples filas o se corre el riesgo de inconsistencias.

---

## 2. Proceso de Normalización

### Primera Forma Normal (1FN) — Atributos atómicos
Se eliminan listas y grupos repetitivos separando cada ítem en filas individuales para que cada columna tenga un único valor atómico:

* `pedidos_1fn(id_pedido, producto_nombre, cantidad, cliente_nombre, cliente_email, cliente_rol, telefono, categoria_nombre, estado_nombre)`
* Clave primaria temporal compuesta: `(id_pedido, producto_nombre)`.

### Segunda Forma Normal (2FN) — Dependencia funcional completa
Como en 1FN la clave primaria es compuesta `(id_pedido, producto_nombre)`, los datos que dependen solo del pedido (`cliente_nombre`, `cliente_email`, `cliente_rol`, `telefono`, `categoria_nombre`, `estado_nombre`) se separan de los datos propios de cada ítem del pedido (`cantidad`, `precio_unitario`):

* `pedidos_2fn(id_pedido [PK], cliente_nombre, cliente_email, cliente_rol, telefono, categoria_nombre, estado_nombre)`
* `detalle_pedidos_2fn(pedido_id [PK, FK], producto_nombre [PK], cantidad, precio_unitario)`

### Tercera Forma Normal (3FN) — Eliminación de dependencias transitivas
Se extraen a tablas propias los atributos que no dependen directamente de la clave primaria del pedido, sino de otra entidad o atributo no clave (como roles, usuarios, categorías de productos, productos y estados):

* `roles(id [PK], nombre)`
* `usuarios(id [PK], rol_id [FK], nombre, email, password_hash, telefono, created_at, updated_at)`
* `categorias(id [PK], nombre, descripcion)`
* `estados_pedido(id [PK], nombre)`
* `productos(id [PK], categoria_id [FK], nombre, descripcion, precio, disponible, created_at, updated_at)`
* `pedidos(id [PK], usuario_id [FK], estado_id [FK], notas, total, created_at, updated_at)`
* `detalle_pedidos(id [PK], pedido_id [FK], producto_id [FK], cantidad, precio_unitario)`

---

## 3. Listado de Tablas Resultantes (PK y FK)

* **`roles`**:
  * **PK:** `id`
  * **FK:** ninguna
* **`usuarios`**:
  * **PK:** `id`
  * **FK:** `rol_id` -> `roles(id)`
* **`categorias`**:
  * **PK:** `id`
  * **FK:** ninguna
* **`estados_pedido`**:
  * **PK:** `id`
  * **FK:** ninguna
* **`productos`**:
  * **PK:** `id`
  * **FK:** `categoria_id` -> `categorias(id)`
* **`pedidos`**:
  * **PK:** `id`
  * **FK:** `usuario_id` -> `usuarios(id)`, `estado_id` -> `estados_pedido(id)`
* **`detalle_pedidos`**:
  * **PK:** `id`
  * **FK:** `pedido_id` -> `pedidos(id)`, `producto_id` -> `productos(id)`