<?php
require 'config/database.php';

// obtener datos del formulario de registro si se hizo clic en el botón de registro
if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    // validar valores de entrada
    if (!$firstname) {
        $_SESSION['signup'] = "Ingresa tu nombre";
    } elseif (!$lastname) {
        $_SESSION['signup'] = "Ingresa tu apellido";
    } elseif (!$username) {
        $_SESSION['signup'] = "Ingresa tu nombre de usuario";
    } elseif (!$email) {
        $_SESSION['signup'] = "Ingresa un email válido";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "La contraseña tiene que tener +8 caracteres";
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Porfavot, añade un avatar";
    } else {
        //comprobar si las contraseñas no coinciden
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Las contraseñas no coinciden";
        } else {
            // contraseña hash
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            // comprueba si el nombre de usuario o el correo electrónico ya existen en la base de datos
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Usuario o correo ya existen";
            } else {
                // TRABAJAR EN AVATAR
                 // cambiar el nombre del avatar
                $time = time(); // hacer que cada nombre de imagen sea único usando la marca de tiempo actual
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                // asegurar de que el archivo sea una imagen
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $allowed_files)) {
                    // asegúrate de que la imagen no sea demasiado grande (1mb+)
                    if ($avatar['size'] < 1000000) {
                        // subir avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['signup'] = "El archivo tiene que pesar menos de 1mb";
                    }
                } else {
                    $_SESSION['signup'] = "El avatar tiene que ser png, jpg, o jpeg";
                }
            }
        }
    }

    // redirigir nuevamente a la página de registro si hubo algún problema
    if (isset($_SESSION['signup'])) {
        // pasar los datos del formulario a la página de registro
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        // Insertar nueva usuario en la tabla de usuarios
        $insert_user_query = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=0";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            // redirigir a la página de inicio de sesión con mensaje de éxito
            $_SESSION['signup-success'] = "Registro exitoso. Inicia sesión";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
} else {
   // si no se hizo clic en el botón, regresamos a la página de registro
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}
