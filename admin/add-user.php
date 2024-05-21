<?php
include 'partials/header.php';

// get back form data if there was an error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>



<section class="form__section">
    <div class="container form__section-container">
    <body>
        <div class="fleecha">
            <a href="index.php">
                <i class="fas fa-arrow-left" aria-hidden="true" title="Volver"></i>
            </a>
        </div>
    </body>
        <h2 class="h2-dsh-title">Añadir usuario</h2>
        <?php if (isset($_SESSION['add-user'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                    ?>
                </p>
            </div>

        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firstname" class="input-title" value="<?= $firstname ?>" placeholder="Nombre">
            <input type="text" name="lastname" class="input-title" value="<?= $lastname ?>" placeholder="Apellido">
            <input type="text" name="username" class="input-title" value="<?= $username ?>" placeholder="Nombre de usuario">
            <input type="email" name="email"class="input-title" value="<?= $email ?>" placeholder="Correo">
            <input type="password" name="createpassword" class="input-title" value="<?= $createpassword ?>" placeholder="Crear contraseña">
            <input type="password" name="confirmpassword" class="input-title" value="<?= $confirmpassword ?>" placeholder="Confirmar contraseña">
            <select name="userrole">
                <option value="0">Usuario</option>
                <option value="1">Admin</option>
            </select>
            <div class="form__control">
                <label for="avatar">Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Añadir usuario</button>
        </form>
    </div>
</section>



<?php
include '../partials/footer.php';
?>