<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    // handle avatar upload
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $avatar_name = $_FILES['avatar']['name'];
        $avatar_tmp_name = $_FILES['avatar']['tmp_name'];
        $avatar_destination = '../images/' . $avatar_name;
        move_uploaded_file($avatar_tmp_name, $avatar_destination);
    } else {
        $avatar_name = null;
    }

    // check for valid input
    if (!$firstname || !$lastname || !$username || !$email) {
        $_SESSION['edit-user'] = "Entrada de formulario no válida en la página de edición.";
    } else {
        // update user
        $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', is_admin=$is_admin";
        
        if ($password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query .= ", password='$hashed_password'";
        }

        if ($avatar_name) {
            $query .= ", avatar='$avatar_name'";
        }

        $query .= " WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "No se pudo actualizar la usuario.";
        } else {
            $_SESSION['edit-user-success'] = "User $firstname $lastname actualizado correctamente";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();
?>
