<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastelería Artesanal</title>
    <!-- Vinculación del CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Aquí va el contenido de tu HTML (header, secciones, footer...) -->

    <!-- Vinculación del JavaScript -->
    <script src="main.js"></script>
</body>
</html>
    <title>Pastelería Artesanal - Dulzura Hecha en Casa</title>
    <style>
        :root {
            --primary: #4a2e18;
            --secondary: #d4a373;
            --accent: #e09f84;
            --bg: #fcf9f2;
            --card-bg: #ffffff;
            --text: #333333;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg);
            color: var(--text);
        }

        /* NAVEGACIÓN FIJA */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: var(--card-bg);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 3rem;
            z-index: 1000;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: bold;
            font-size: 1.2rem;
            color: var(--primary);
        }

        .logo-badge {
            background-color: #f3c6bb;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        nav {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: var(--text);
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        nav a:hover {
            color: var(--accent);
        }

        .btn-header {
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-header:hover {
            background-color: #2e1c0e;
        }

        /* HERO SECTION */
        .hero {
            height: 90vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url
            ('https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=1600&q=80') center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 0 1rem;
            margin-top: 70px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 10px;
            font-family: serif;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 25px;
            font-weight: 300;
        }

        .btn-hero {
            background-color: var(--primary);
            color: white;
            padding: 12px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            border: 2px solid var(--secondary);
            transition: all 0.3s;
        }

        .btn-hero:hover {
            background-color: var(--secondary);
            color: var(--primary);
        }

        /* CONTENEDOR GENERAL DE SECCIONES */
        section {
            padding: 5rem 2rem 3rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary);
            font-family: serif;
            margin-bottom: 8px;
        }

        .section-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 1rem;
        }

        .divider {
            width: 60px;
            height: 3px;
            background-color: var(--accent);
            margin: 0 auto 40px auto;
        }

        /* GRID DE PRODUCTOS */
        .grid-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .card-content {
            padding: 20px;
        }

        .card-title {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 8px;
            font-weight: bold;
        }

        .card-desc {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px 20px 20px;
        }

        .price {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--primary);
        }

        .btn-card {
            background-color: #faedcd;
            color: var(--primary);
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-card:hover {
            background-color: var(--accent);
            color: white;
        }

        /* SECCIÓN PEDIDOS PERSONALIZADOS */
        .order-section {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .order-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 0.9rem;
            color: var(--primary);
        }

        .form-control {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.95rem;
            background-color: #faf9f6;
        }

        .btn-submit {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background-color: #2e1c0e;
        }

        /* PREGUNTAS FRECUENTES (FAQ) Y ACORDEÓN */
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: white;
            margin-bottom: 15px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .faq-question {
            padding: 18px 20px;
            font-weight: bold;
            color: var(--primary);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            padding: 0 20px 18px 20px;
            color: #555;
            font-size: 0.95rem;
            line-height: 1.5;
            display: none;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        /* CONTACTO */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .info-box {
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: center;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 1.05rem;
            color: var(--primary);
        }

        /* FOOTER */
        footer {
            background-color: var(--primary);
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
        }

        /* RESPONSIVE */
        @media(max-width: 768px) {
            .order-section, .contact-grid {
                grid-template-columns: 1fr;
            }
            header {
                padding: 1rem;
            }
            nav {
                display: none; /* Versión móvil simplificada o usa el botón */
            }
        }
    </style>
</head>
<body>

    <!-- BARRA DE NAVEGACIÓN FIJA -->
    <header>
        <div class="logo-container">
            <div class="logo-badge">🍰</div>
            <span>Pastelería Artesanal</span>
        </div>
        <nav>
            <a href="#inicio">Inicio</a>
            <a href="#productos">Productos</a>
            <a href="#tortas">Tortas</a>
            <a href="#alfajores">Alfajores</a>
            <a href="#masas">Masas y Galletitas</a>
            <a href="#contacto">Contacto</a>
            <a href="#faq">FAQ</a>
        </nav>
        <a href="#pedidos" class="btn-header">Hacer Pedido</a>
    </header>

    <!-- 1. SECCIÓN INICIO -->
    <section id="inicio" class="hero">
        <h1>Pastelería Artesanal</h1>
        <p>Dulzura hecha en casa con ingredientes naturales y mucho amor.</p>
        <a href="#productos" class="btn-hero">Ver Productos</a>
    </section>

    <!-- 2. PRODUCTOS DESTACADOS -->
    <section id="productos">
        <h2 class="section-title">Productos Destacados</h2>
        <p class="section-subtitle">Nuestros clásicos más elegidos para alegrar tus momentos</p>
        <div class="divider"></div>

        <div class="grid-cards">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=600&q=80" 
                alt="Torta de Chocolate">
                <div class="card-content">
                    <h3 class="card-title">Torta de Chocolate</h3>
                    <p class="card-desc">Bizcochuelo húmedo de chocolate, abundante dulce de leche y baño de fudge italiano.</p>
                </div>
                <div class="card-footer">
                    <span class="price">$15.000 x kg</span>
                    <button class="btn-card" onclick="alert('¡Torta de Chocolate agregada al pedido!')">Pedir</button>
                </div>
            </div>

            <div class="card">
                <img src="https://tse1.explicit.bing.net/th/id/OIP.nNZ8BAcE8EQqvWlkKrjMVQHaHE?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" 
                alt="Alfajores">
                <div class="card-content">
                    <h3 class="card-title">Alfajores x12</h3>
                    <p class="card-desc">Surtido de nuestros mejores alfajores de maicena, chocolate y rogel.</p>
                </div>
                <div class="card-footer">
                    <span class="price">$10.000</span>
                    <button class="btn-card" onclick="alert('¡Alfajores x12 agregados al pedido!')">Pedir</button>
                </div>
            </div>

            <div class="card">
                <img src="https://www.barilochense.com/suplementos/cafeteria-don-federico/fotos/51966.jpg" 
                alt="Facturas">
                <div class="card-content">
                    <h3 class="card-title">Facturas surtidas x6</h3>
                    <p class="card-desc">Las clásicas facturas argentinas: medialunas de hogaldre, caritas sucias, miguelitos, facturas de membrillo y crema pastelera</p>
                </div>
                <div class="card-footer">
                    <span class="price">$7.800</span>
                    <button class="btn-card" onclick="alert('¡Facturas surtidas agregadas al pedido!')">Pedir</button>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. SECCIÓN TORTAS -->
    <section id="tortas">
        <h2 class="section-title">Nuestras Tortas</h2>
        <p class="section-subtitle">Elaboradas con ingredientes frescos y mucho amor</p>
        <div class="divider"></div>

        <div class="grid-cards">
            <div class="card">
                <img src="https://tse3.mm.bing.net/th/id/OIP.LIdHniZ2-m8nCFJp2UiPKgHaEU?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" 
                alt="Torta Rogel">
                <div class="card-content">
                    <h3 class="card-title">Torta Rogel</h3>
                    <p class="card-desc">Capas de Rogel, dulce de leche, y merengue.</p>
                </div>
                <div class="card-footer">
                    <span class="price">$12.500 x kg</span>
                    <button class="btn-card" onclick="alert('¡Torta Rogel agregada!')">Pedir</button>
                </div>
            </div>

            <div class="card">
                <img src="https://images.unsplash.com/photo-1533134242443-d4fd215305ad?auto=format&fit=crop&w=600&q=80" 
                alt="Cheesecake">
                <div class="card-content">
                    <h3 class="card-title">Cheesecake de Frutos Rojos</h3>
                    <p class="card-desc">Base crujiente de galletitas, crema suave de queso y abundante salsa de frutos rojos.</p>
                </div>
                <div class="card-footer">
                    <span class="price">$8.000</span>
                    <button class="btn-card" onclick="alert('¡Cheesecake agregado!')">Pedir</button>
                </div>
            </div>

            <div class="card">
                <img src="https://images.unsplash.com/photo-1519869325930-281384150729?auto=format&fit=crop&w=600&q=80" alt="magdalena">
                <div class="card-content">
                    <h3 class="card-title">capkey/magdalena x 6</h3>
                    <p class="card-desc">Esponjosa magdalena casera, con suave aroma a vainilla y crema chantilly por arriba.</p>
                </div>
                <div class="card-footer">
                    <span class="price">$7.500</span>
                    <button class="btn-card" onclick="alert('¡Capkey/magdalena agregada!')">Pedir</button>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. SECCIÓN ALFAJORES -->
    <section id="alfajores">
        <h2 class="section-title">Alfajores Artesanales</h2>
        <p class="section-subtitle">Hechos a mano con dulce de leche casero</p>
        <div class="divider"></div>

        <div class="grid-cards">
            <div class="card">
                <img src="https://www.mendozapost.com/files/image/289/289415/600ffe19ea78e_1420_!.png?s=c5a08a0a05c10c34a82f44a0ebca020e&d=1611661740" 
                alt="Maicena">
                <div class="card-content">
                    <h3 class="card-title">Alfajores de Maicena x12</h3>
                    <p class="card-desc">Masa ultra tierna que se deshace en la boca, mucho dulce de leche y coco rallado.</p>
                </div>
                <div class="card-footer">
                    <span class="price">$5.200</span>
                    <button class="btn-card" onclick="alert('¡Maicena agregados!')">Pedir</button>
                </div>
            </div>

            <div class="card">
                <img src="https://1.bp.blogspot.com/-9q7LNEeypw4/YLQOpKCVkpI/AAAAAAAAGBQ/_QTR2fhaQ6Y1vD7pysOwa1nSvglloyxDQCLcBGAsYHQ/s16000/Alfajores_de_chocolate_3.jpg" 
                alt="Chocolate">
                <div class="card-content">
                    <h3 class="card-title">Alfajores de Chocolate x12</h3>
                    <p class="card-desc">Galletitas de cacao rellenas de dulce de leche con una cobertura crocante de chocolate semi amargo.</p>
                </div>
                <div class="card-footer">
                    <span class="price">$5.800</span>
                    <button class="btn-card" onclick="alert('¡Chocolate agregados!')">Pedir</button>
                </div>
            </div>

            <div class="card">
                <img src="https://media.diariouno.com.ar/p/6f1c81208cea46fab4752d0bc026982b/adjuntos/298/imagenes/009/283/0009283646/1200x0/smart/palmeritas-hojaldre-1jpg.jpg" 
                alt="Palmerita">
                <div class="card-content">
                    <h3 class="card-title">Palmeritas x6</h3>
                    <p class="card-desc">Crujientes palmeritas de hojaldre, doradas al horno y caramelizadas con azúcar.</p>
                </div>
                <div class="card-footer">
                    <span class="price">$6.000</span>
                    <button class="btn-card" onclick="alert('¡Palmeritas agregados!')">Pedir</button>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. SECCIÓN MASAS Y GALLETITAS -->
    <section id="masas">
        <h2 class="section-title">Masas y Galletitas</h2>
        <p class="section-subtitle">Ideales para la merienda o para compartir</p>
        <div class="divider"></div>

        <div class="grid-cards">
            <div class="card">
                <img src="https://elsaborartesanal.com/wp-content/uploads/2016/08/facturas-sabrosisimo-es-sabor-artesanal.jpg" 
                alt="Facturas surtidas">
                <div class="card-content">
                    <h3 class="card-title">Facturas Surtidas x12</h3>
                    <p class="card-desc">Docena surtida con medialunas de hojaldre, crema pastelera, dulce de leche y membrillo.</p>
                </div>
                <div class="card-footer">
                    <span class="price">$6.500</span>
                    <button class="btn-card" onclick="alert('Agregado al pedido')">Pedir</button>
                </div>
            </div>

            <div class="card">
                <img src="https://cdn.kiwilimon.com/recetaimagen/11964/5073.jpg" 
                alt="Galletitas de manteca">
                <div class="card-content">
                    <h3 class="card-title">Galletitas de Manteca x500g</h3>
                    <p class="card-desc">Masitas secas finas de manteca con decoración de chocolate, mermelada y granas.</p>
                </div>
                <div class="card-footer">
                    <span class="price">$3.200</span>
                    <button class="btn-card" onclick="alert('Agregado al pedido')">Pedir</button>
                </div>
            </div>

            <div class="card">
                <img src="https://tse3.mm.bing.net/th/id/OIP.R44WLhS2pSdoLF8a89-iZwHaEK?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Medialunas">
                <div class="card-content">
                    <h3 class="card-title">Medialunas x6</h3>
                    <p class="card-desc">Nuestras famosas medialunas de manteca súper esponjosas con almíbar casero.</p>
                </div>
                <div class="card-footer">
                    <span class="price">$6.000</span>
                    <button class="btn-card" onclick="alert('Agregado al pedido')">Pedir</button>
                </div>
            </div>
        </div>
    </section>

<!-- 6. SECCIÓN PEDIDOS PERSONALIZADOS -->
    <section id="pedidos">
        <div class="order-section">
            <img src="https://tse2.mm.bing.net/th/id/OIP.CXYSsXFCdBS9eGZuxWbLEgHaHa?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" 
            alt="Torta personalizada con diseño artesanal y decoración elegante" class="order-img">
            <div>
                <h2 style="color:var(--primary); font-family:serif; font-size: 2.2rem; margin-bottom: 10px;">Pedidos Personalizados</h2>
                <p style="color:#666; margin-bottom: 20px;">Diseñamos tu torta o mesa dulce a medida para cualquier evento especial.</p>
                
                <form>
                    <div class="form-group">
                        <label for="nombre-pedido">Nombre Completo</label>
                        <input type="text" id="nombre-pedido" class="form-control" placeholder="Ej. Sofía Fernández" required>
                    </div>
                    <div class="form-group">
                        <label for="contacto-pedido">Email o WhatsApp</label>
                        <input type="text" id="contacto-pedido" class="form-control" placeholder="Ej. 3871234567" required>
                    </div>
                    <div class="form-group">
                        <label for="evento-pedido">Tipo de Evento o Producto</label>
                        <input type="text" id="evento-pedido" class="form-control" placeholder="Ej. Cumpleaños de 15, Torta temática..." required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion-pedido">Descripción del Pedido</label>
                        <textarea id="descripcion-pedido" class="form-control" rows="3" placeholder="Detallanos sabores preferidos, cantidad de invitados..." required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Enviar Pedido</button>
                </form>
            </div>
        </div>
    </section>

<!-- 7. SECCIÓN CONTACTO -->
    <section id="contacto">
        <h2 class="section-title">Contáctanos</h2>
        <p class="section-subtitle">Estamos para responder tus dudas y recibir tus consultas</p>
        <div class="divider"></div>

        <div class="contact-grid">
            <form style="display:flex; flex-direction:column; gap:15px;">
                <h3 style="color:var(--primary); margin-bottom:5px;">Envíanos un mensaje</h3>
                
                <div style="display:flex; flex-direction:column; gap:5px;">
                    <label for="nombre-contacto" style="font-weight:600; font-size:0.9rem; color:var(--primary);">Tu Nombre</label>
                    <input type="text" id="nombre-contacto" class="form-control" placeholder="Tu Nombre" required>
                </div>

                <div style="display:flex; flex-direction:column; gap:5px;">
                    <label for="email-contacto" style="font-weight:600; font-size:0.9rem; color:var(--primary);">Tu Correo Electrónico</label>
                    <input type="email" id="email-contacto" class="form-control" placeholder="Tu Correo Electrónico" required>
                </div>

                <div style="display:flex; flex-direction:column; gap:5px;">
                    <label for="asunto-contacto" style="font-weight:600; font-size:0.9rem; color:var(--primary);">Asunto</label>
                    <input type="text" id="asunto-contacto" class="form-control" placeholder="Asunto">
                </div>

                <div style="display:flex; flex-direction:column; gap:5px;">
                    <label for="mensaje-contacto" style="font-weight:600; font-size:0.9rem; color:var(--primary);">Escribe tu mensaje</label>
                    <textarea id="mensaje-contacto" class="form-control" rows="4" placeholder="Escribe tu mensaje..." required></textarea>
                </div>

                <button type="submit" class="btn-submit">Enviar Mensaje</button>
            </form>
            
            <div class="info-box">
                <h3 style="color:var(--primary);">Información de contacto</h3>
                <div class="info-item">📱 <span>+54 9 387 1234567</span></div>
                <div class="info-item">✉️ <span>contacto@pasteleriaartesanal.com</span></div>
                <div class="info-item">⏰ <span>Lunes a Sábados: 9:00 a 20:00 hs</span></div>
            </div>
        </div>
    </section>

    <!-- 8. PREGUNTAS FRECUENTES (FAQ) -->
    <section id="faq">
        <h2 class="section-title">Preguntas Frecuentes</h2>
        <p class="section-subtitle">Resolvemos tus dudas más comunes</p>
        <div class="divider"></div>

        <div class="faq-container">
            <!-- Pregunta 1 -->
<details>
    <summary>¿Cómo hago un pedido?</summary>
    <p>Podés hacer tu pedido directamente desde nuestra sección de productos o completando el formulario de pedidos personalizados.</p>
</details>

<!-- Pregunta 2 -->
<details>
    <summary>¿Hacen envíos a domicilio?</summary>
    <p>Sí, realizamos envíos a domicilio en toda la ciudad de 9:00 a 19:00 hs.</p>
</details>

<!-- Pregunta 3 -->
<details>
    <summary>¿Con cuánto tiempo de anticipación debo encargar?</summary>
    <p>Recomendamos realizar los encargos con al menos 48 horas de anticipación.</p>
</details>

<!-- Pregunta 4 -->
<details>
    <summary>¿Qué medios de pago aceptan?</summary>
    <p>Aceptamos tarjetas de crédito, débito, transferencias bancarias y efectivo.</p>
</details>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>Pastelería Artesanal Online — Todos los derechos reservados</p>
    </footer>

    <!-- SCRIPT PARA FUNCIONALIDAD DE LAS PREGUNTAS FRECUENTES -->
    <script>
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            question.addEventListener('click', () => {
                // Cierra los demás
                faqItems.forEach(i => {
                    if (i !== item) i.classList.remove('active');
                });
                // Alterna el actual
                item.classList.toggle('active');
            });
        });
    </script>
</body>
</html>