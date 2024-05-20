<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>

    <section class="contact__section">
        <h1 class="section__title">Contáctanos</h1>
        <div class="contact__container">
            <div class="contact__info">
                <h2 class="contact__subtitle">Estamos aquí para ayudarte</h2>
                <p class="contact__text">Puedes ponerte en contacto con nosotros a través de los siguientes medios:</p>
                <ul class="contact__list">
                    <li>
                        <a href="https://www.instagram.com/weblife.0/" target="_blank" class="contact__link">
                            <i class="fab fa-instagram contact__icon"></i> Instagram
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/3141484974" target="_blank" class="contact__link">
                            <i class="fab fa-whatsapp contact__icon"></i> WhatsApp
                        </a>
                    </li>
                    <li>
                        <a href="mailto:weblifejarda@gmail.com" class="contact__link">
                            <i class="fas fa-envelope contact__icon"></i> weblifejarda@gmail.com
                        </a>
                    </li>
                </ul>
            </div>
           
        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
</body>
</html>
