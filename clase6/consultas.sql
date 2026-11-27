-- Parte 3: Consultas de Prueba CRUD (Pastelería Artesanal)
USE pasteleria_artesanal_db;

-- 1. CREATE (Insertar datos iniciales)

-- Inserciones en tablas maestras / secundarias
INSERT INTO roles (nombre, descripcion) VALUES
('cliente', 'Usuario que realiza pedidos y consultas en la pastelería'),
('admin', 'Administrador del catálogo y gestión de pedidos');

INSERT INTO categorias (nombre, descripcion) VALUES
('Tortas artesanales', 'Tortas clásicas y temáticas por porción o enteras'),
('Alfajores y cookies', 'Alfajores de maicena, chocolate y galletitas artesanales'),
('Tartas dulces y frutales', 'Tartas con frutas de estación y cremas');

INSERT INTO estados_pedido (nombre) VALUES
('Pendiente'),
('Confirmado'),
('Entregado');

-- Inserciones en tablas vinculadas por clave foránea
INSERT INTO usuarios (rol_id, nombre, email, password_hash, telefono) VALUES
(1, 'Pepito Sanchez', 'sanchezpepi11@gmail.com', '$2y$10$ejemploHashSeguro1', '387-111111'),
(1, 'Laura Gómez', 'laura.gomez@correo.com', '$2y$10$ejemploHashSeguro2', '387-333333');

INSERT INTO productos (categoria_id, nombre, descripcion, precio, disponible) VALUES
(1, 'Torta Chocolate con Frutos Rojos', 'Bizcochuelo húmedo de cacao con ganache y frutas', 28500.00, 1),
(2, 'Caja de Alfajores Artesanales x12', 'Rellenos con dulce de leche repostero y baño de chocolate', 14200.00, 1),
(3, 'Tarta de Frutilla y Crema', 'Masa sablée con crema pastelera y frutillas frescas', 21000.00, 1);

INSERT INTO pedidos (usuario_id, estado_id, notas, total) VALUES
(1, 1, 'Torta de chocolate con decoración de fruta para el sábado', 28500.00),
(2, 2, 'Entregar por la tarde', 35200.00);

INSERT INTO detalle_pedidos (pedido_id, producto_id, cantidad, precio_unitario) VALUES
(1, 1, 1, 28500.00),
(2, 1, 1, 28500.00),
(2, 2, 1, 14200.00);

-- 2. READ (Consultas con WHERE, ORDER BY e INNER JOIN)

-- Consulta con filtro WHERE y ordenamiento ORDER BY
SELECT id, nombre, precio, disponible
FROM productos
WHERE disponible = 1
ORDER BY precio ASC;

-- Consulta con INNER JOIN entre pedidos, usuarios y estados_pedido
SELECT
    p.id AS pedido_id,
    u.nombre AS cliente,
    u.email,
    e.nombre AS estado,
    p.total,
    p.created_at
FROM pedidos p
INNER JOIN usuarios u ON p.usuario_id = u.id
INNER JOIN estados_pedido e ON p.estado_id = e.id
ORDER BY p.created_at DESC;

-- 3. UPDATE (Actualizar un registro específico con WHERE)
UPDATE pedidos
SET estado_id = 2,
    total = 42700.00
WHERE id = 1;

-- 4. DELETE (Eliminar un registro de prueba específico con WHERE)
DELETE FROM detalle_pedidos
WHERE id = 3;