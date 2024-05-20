<?php
include 'partials/header.php';

// get back form data if invalid
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
        <h2 class="h2-dsh-title">Añadir categoria</h2>
        <?php if (isset($_SESSION['add-category'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']) ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
            <input type="text" value="<?= $title ?>" name="title" class="input-title" placeholder="Titulo">
            <textarea rows="4" value="<?= $description ?>" name="description" class="input-title" placeholder="Descripcion"></textarea>
            <button type="submit" name="submit" class="btn">Añadir</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>