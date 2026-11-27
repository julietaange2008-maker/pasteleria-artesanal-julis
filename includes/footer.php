<footer>
        <p>Pastelería Artesanal Online — Todos los derechos reservados</p>
    </footer>

    <script src="main.js"></script>
    <script>
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            if (question) {
                question.addEventListener('click', () => {
                    faqItems.forEach(i => {
                        if (i !== item) i.classList.remove('active');
                    });
                    item.classList.toggle('active');
                });
            }
        });
    </script>
</body>
</html>