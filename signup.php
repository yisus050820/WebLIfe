<?php
require 'config/constants.php';


// Restaurar los datos del formulario si es necesario
$firstname = $_SESSION['signup-data']['firstname'] ?? '';
$lastname = $_SESSION['signup-data']['lastname'] ?? '';
$username = $_SESSION['signup-data']['username'] ?? '';
$email = $_SESSION['signup-data']['email'] ?? '';
$createpassword = $_SESSION['signup-data']['createpassword'] ?? '';
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? '';

unset($_SESSION['signup-data']);
?>

<!DOCTYPE html>
<html lang="zxx">
<!-- Head -->

<head>
    <title>Register</title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/stylelogin.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all">
    <link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .error-message, .success-message {
            text-align: center;
            color: white;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .error-message {
            background-color: #ff4d4d; /* Rojo para mensajes de error */
        }
        .success-message {
            background-color: #4CAF50; /* Verde para mensajes de éxito */
        }
    </style>
</head>
<!-- //Head -->
<!-- Body -->

<body>

<section class="main">
    <div class="layer">

        <div class="bottom-grid">
            <div class="logo">
                <h1> <a href="index.html"><span class="fas fa-leaf"></span> WebLife</a></h1>
            </div>
            <div class="links">
                <ul class="links-unordered-list">
                    <li>
                        <a href="signin.php" class="">Iniciar Sesión</a>
                    </li>
                    <li>
                        <a href="about.php" class="">Conócenos</a>
                    </li>
                    <li class="active">
                        <a href="#" class="">Registrarse</a>
                    </li>
                    <li>
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
                <?php if (isset($_SESSION['signup'])): ?>
                    <div class="error-message"><?php echo $_SESSION['signup']; unset($_SESSION['signup']); ?></div>
                <?php endif; ?>
                <?php if (isset($_SESSION['signup-success'])): ?>
                    <div class="success-message"><?php echo $_SESSION['signup-success']; unset($_SESSION['signup-success']); ?></div>
                <?php endif; ?>
                <form action="signup-logic.php" method="post" enctype="multipart/form-data">
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="firstname" type="text" value="<?php echo htmlspecialchars($firstname); ?>" placeholder="Nombres" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="lastname" type="text" value="<?php echo htmlspecialchars($lastname); ?>" placeholder="Apellidos" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <span class="fa fa-envelope" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="email" type="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Correo electrónico" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="username" type="text" value="<?php echo htmlspecialchars($username); ?>" placeholder="Nombre de usuario" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <span class="fa fa-lock" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="createpassword" type="password" placeholder="Crear contraseña" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <span class="fa fa-lock" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="confirmpassword" type="password" placeholder="Confirmar contraseña" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <span class="fa fa-file-image-o" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="avatar" type="file" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <input type="checkbox" name="terms" id="terms" required>
                        <label for="terms" style="color: white;">Aceptar términos y condiciones</label>
                    </div>
                    <div class="wthree-field">
                        <button type="submit" name="submit" class="btn">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="bottom-grid1">
            <div class="links">
                <ul class="links-unordered-list">
                    <li>
                        <a href="#" class="">Conócenos</a>
                    </li>
                    
                    <li>
                        <a href="terminos.html" class="">Derechos y privacidad</a>
                    </li>
                </ul>
            </div>
            <div class="copyright">
                <p>© 2024 WebLife. Todos los derechos reservados | Hecho por JARDA
                </p>
            </div>
        </div>
    </div>
    <style>
        .content-w3ls {
    background-color: rgba(0, 0, 0, 0.8); /* Fondo negro semitransparente */
    border: 1px solid rgba(0, 0, 0, 0.8); /* Borde negro semitransparente */
    padding: 20px;             /* Espaciado interno */
    border-radius: 10px;       /* Bordes redondeados */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra */
}

    </style>
</section>

</body>
<!-- //Body -->
</html>
