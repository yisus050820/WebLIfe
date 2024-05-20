<?php
include 'partials/header.php';

// fetch categories from database
$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);
?>

<script src="../js/btn.js"></script>


<section class="dashboard">

    <?php if (isset($_SESSION['add-category-success'])) : // shows if add category was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-category-success'];
                unset($_SESSION['add-category-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['add-category'])) : // shows if add category was NOT successful
    ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-category'])) : // shows if edit category was NOT successful
    ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-category'];
                unset($_SESSION['edit-category']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-category-success'])) : // shows if edit category was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-category-success'])) : // shows if delete category was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-category-success'];
                unset($_SESSION['delete-category-success']);
                ?>
            </p>
        </div>

    <?php endif ?>
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php" class="a-dsh"><i class="uil uil-pen"></i>
                        <h5 class="h5-dsh">Agregar post</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php"  class="a-dsh"><i class="uil uil-postcard"></i>
                        <h5 class="h5-dsh">Administrar Post</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="add-user.php" class="a-dsh"><i class="uil uil-user-plus"></i>
                            <h5 class="h5-dsh">Añadir usuario</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-users.php" class="a-dsh"><i class="uil uil-users-alt"></i>
                            <h5 class="h5-dsh">Administrar usuarios</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php"  class="a-dsh"><i class="uil uil-edit"></i>
                            <h5 class="h5-dsh">Añadir categoria</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php" class="active" class="a-dsh"><i class="uil uil-list-ul"></i>
                            <h5 class="h5-dsh">Administrar categorias</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2 class="h2-dsh">Categorias</h2>
            <?php if (mysqli_num_rows($categories) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                            <tr>
                                <td><?= $category['title'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>" class="btn sm">Editar</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>" class="btn sm danger">Eliminar</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No categories found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>



<?php
include '../partials/footer.php';
?>