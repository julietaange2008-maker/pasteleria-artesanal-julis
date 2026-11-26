document.addEventListener('DOMContentLoaded', () => {
    // 1. Funcionalidad del acordeón de Preguntas Frecuentes (si usas JS para ello)
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        if (question) {
            question.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                faqItems.forEach(i => i.classList.remove('active'));
                if (!isActive) item.classList.add('active');
            });
        }
    });

    // 2. Alertas para los botones de pedido de las tarjetas
    const cardButtons = document.querySelectorAll('.btn-card');
    cardButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const card = e.target.closest('.card');
            const title = card.querySelector('.card-title').textContent;
            alert(`¡${title} agregado al pedido con éxito!`);
        });
    });

    // 3. Simulación de guardado para el formulario de Pedidos Personalizados
    const orderForm = document.querySelector('#pedidos form');
    if (orderForm) {
        orderForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Capturamos los valores de los inputs
            const inputs = orderForm.querySelectorAll('.form-control');
            const nombre = inputs[0].value;
            const contacto = inputs[1].value;
            const evento = inputs[2].value;
            const descripcion = inputs[3].value;

            // Creamos un objeto con los datos del pedido
            const pedidoData = {
                nombre,
                contacto,
                evento,
                descripcion,
                fecha: new Date().toLocaleString()
            };

            // Simulamos guardado en la memoria local del navegador
            let pedidosGuardados = JSON.parse(localStorage.getItem('misPedidos')) || [];
            pedidosGuardados.push(pedidoData);
            localStorage.setItem('misPedidos', JSON.stringify(pedidosGuardados));

            // Mensaje de éxito simulado
            alert(`¡Pedido guardado con éxito!\n\nGracias ${nombre}, registramos tu encargo para "${evento}". Nos comunicaremos a ${contacto}.`);
            orderForm.reset();
        });
    }

    // 4. Simulación de guardado para el formulario de Contacto
    const contactForm = document.querySelector('#contacto form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const inputs = contactForm.querySelectorAll('.form-control');
            const nombre = inputs[0].value;
            const email = inputs[1].value;
            const asunto = inputs[2].value;
            const mensaje = inputs[3].value;

            const contactoData = {
                nombre,
                email,
                asunto,
                mensaje,
                fecha: new Date().toLocaleString()
            };

            let mensajesGuardados = JSON.parse(localStorage.getItem('misMensajes')) || [];
            mensajesGuardados.push(contactoData);
            localStorage.setItem('misMensajes', JSON.stringify(mensajesGuardados));

            alert(`¡Mensaje guardado y enviado!\n\nGracias ${nombre}, hemos recibido tu consulta. Te responderemos a ${email}.`);
            contactForm.reset();
        });
    }
});