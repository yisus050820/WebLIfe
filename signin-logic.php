<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //obtener datos del formulario
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION['signin'] = "Ingresa el nombre de usuario";
    } elseif (!$password) {
        $_SESSION['signin'] = "Ingresa la contraseña";
    } else {
        // buscar usuario de la base de datos
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            // convierte el registro en una matriz asociada
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            // compara la contraseña del formulario con la contraseña de la base de datos
            if (password_verify($password, $db_password)) {
                // establecer sesión para control de acceso
                $_SESSION['user-id'] = $user_record['id'];
                // Establecer sesión si la usuario es administrador
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }
                // iniciar sesión como usuario
                header('location: ' . ROOT_URL . 'admin/');
            } else {
                $_SESSION['signin'] = "Verifica tus datos";
            }
        } else {
            $_SESSION['signin'] = "Usuario no encontrado";
        }
    }

    // si hay algún problema, redirige a la página de inicio de sesión con los datos de inicio de sesión
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}
