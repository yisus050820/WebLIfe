<?php
include 'partials/header.php';

// Recupera datos del formulario si son inválidos
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

unset($_SESSION['add-category-data']);
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
        <h2 class="h2-dsh-title">Añadir categoría</h2>
        <?php if (isset($_SESSION['add-category'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']) ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
            <input type="text" value="<?= $title ?>" name="title" class="input-title" placeholder="Título">
            <textarea rows="4" name="description" class="input-title" placeholder="Descripción"><?= $description ?></textarea>
            <button type="submit" name="submit" class="btn">Añadir categoría</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>
