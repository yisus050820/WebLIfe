<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
    die();
}
?>

<section class="form__section">
    <div class="container form__section-container">
        <div class="fleecha">
            <a href="index.php">
                <i class="fas fa-arrow-left" aria-hidden="true" title="Volver"></i>
            </a>
        </div>
        <h2 class="h2-dsh">Edit User</h2>
        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?= $user['id'] ?>" name="id">
            <input type="text" value="<?= $user['firstname'] ?>" name="firstname" placeholder="First Name">
            <input type="text" value="<?= $user['lastname'] ?>" name="lastname" placeholder="Last Name">
            <input type="text" value="<?= $user['username'] ?>" name="username" placeholder="Username">
            <input type="email" value="<?= $user['email'] ?>" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="New Password">
            <input type="file" name="avatar" placeholder="Avatar">
            <select name="userrole">
                <option value="0" <?= $user['is_admin'] == 0 ? 'selected' : '' ?>>Usuario</option>
                <option value="1" <?= $user['is_admin'] == 1 ? 'selected' : '' ?>>Admin</option>
            </select>
            <button type="submit" name="submit" class="btn submit-btn">Update User</button>
        </form>
    </div>
</section>

<script src="../js/confirmation.js"></script>

<?php
include '../partials/footer.php';
?>
