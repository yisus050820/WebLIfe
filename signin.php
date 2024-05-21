<?php
require 'config/constants.php';


// Restaurar los datos del formulario si es necesario
$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

// Limpiar datos de la sesión anterior
unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="stylesheet" href="css/stylelogin.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all">
    <link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .error-message {
            text-align: center;
            color: white;
            background-color: #ff4d4d; /* Un rojo menos intenso */
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <section class="main">
        <div class="layer">
            <div class="bottom-grid">
                <div class="logo">
                    <h1> <a href=""><span class="fas fa-leaf"></span> WebLife</a></h1>
                </div>
                <div class="links">
                    <ul class="links-unordered-list">
                        <li class="active">
                            <a href="#" class="">Iniciar Sesion</a>
                        </li>
                        <li class="">
                            <a href="about.php" class="">Conócenos</a>
                        </li>
                        <li class="">
                            <a href="signup.php" class="">Registrarse</a>
                        </li>
                        <li class="">
                            <a href="contact.php" class="">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-w3ls">
                <div class="text-center icon">
                    <span class="fa fa-user"></span>
                </div>
                <div class="content-bottom">
                    <?php if (isset($_SESSION['signin'])): ?>
                        <div class="error-message">
                            <?php echo $_SESSION['signin']; unset($_SESSION['signin']); ?>
                        </div>
                    <?php endif; ?>
                    <form action="signin-logic.php" method="post">
                        <div class="field-group">
                            <span class="fa fa-user" aria-hidden="true"></span>
                            <div class="wthree-field">
                                <input name="username_email" id="text1" type="text" value="<?php echo htmlspecialchars($username_email); ?>" placeholder="Usuario o Correo" required>
                            </div>
                        </div>
                        <div class="field-group">
                            <span class="fa fa-lock" aria-hidden="true"></span>
                            <div class="wthree-field">
                                <input name="password" id="myInput" type="Password" placeholder="Contraseña" required>
                            </div>
                        </div>
                        <div>
                            <li class="olvide">
                                <a href="contact.php" class="">¿Olvidaste tu contraseña?</a>
                            </li>
                        </div>
                        <div class="wthree-field">
                            <button type="submit" class="btn" name="submit">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bottom-grid1">
                <div class="links">
                    <ul class="links-unordered-list">
                        <li class="">
                            <a href="blog.php" class="">Invitado</a>
                        </li>
                        <li class="">
                            <a href="terminos.html" class="">Derechos y privacidad</a>
                        </li>
                    </ul>
                </div>
                <div class="copyright">
                    <p>© 2024 WebLife. Todos los derechos reservados | Hecho por JARDA</p>
                </div>
            </div>
            <style>
/* Agregar fondo y bordes a la clase content-w3ls */
.content-w3ls {
    background-color: rgba(0, 0, 0, 0.8); /* Fondo negro semitransparente */
    border: 1px solid rgba(0, 0, 0, 0.8); /* Borde negro semitransparente */
    padding: 20px;             /* Espaciado interno */
    border-radius: 10px;       /* Bordes redondeados */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra */
}


.olvide a:hover, .links-unordered-list a:hover {
    text-decoration: underline; /* Subrayado al pasar el ratón */
}


        </style>
        </div>
    </section>
</body>
</html>
