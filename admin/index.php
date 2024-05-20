<?php
include 'partials/header.php';

// Check if the current user is an admin
$current_user_id = $_SESSION['user-id'];
$user_query = "SELECT is_admin FROM users WHERE id=$current_user_id";
$user_result = mysqli_query($connection, $user_query);
$user = mysqli_fetch_assoc($user_result);

// Fetch posts based on user role
if ($user['is_admin'] == 1) {
    // If user is admin, fetch all posts
    $query = "SELECT id, title, category_id FROM posts ORDER BY id DESC";
} else {
    // If user is not admin, fetch only their posts
    $query = "SELECT id, title, category_id FROM posts WHERE author_id=$current_user_id ORDER BY id DESC";
}
$posts = mysqli_query($connection, $query);
?>

<script src="../js/btn.js"></script>

<section class="dashboard">
    <?php if (isset($_SESSION['add-post-success'])) : // shows if add post was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-post-success'];
                unset($_SESSION['add-post-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-post-success'])) : // shows if edit post was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-post-success'];
                unset($_SESSION['edit-post-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-post'])) : // shows if edit post was NOT successful ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-post'];
                unset($_SESSION['edit-post']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-post-success'])) : // shows if delete post was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-post-success'];
                unset($_SESSION['delete-post-success']);
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
                    <a href="index.php" class="active" class="a-dsh"><i class="uil uil-postcard"></i>
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
                        <a href="add-category.php" class="a-dsh"><i class="uil uil-edit"></i>
                            <h5 class="h5-dsh">Añadir categoria</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php" class="a-dsh"><i class="uil uil-list-ul"></i>
                            <h5 class="h5-dsh">Administrar categorias</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2 class="h2-dsh">Post</h2>
            <?php if (mysqli_num_rows($posts) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Categoria</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                            <!-- get category title of each post from categories table -->
                            <?php
                            $category_id = $post['category_id'];
                            $category_query = "SELECT title FROM categories WHERE id=$category_id";
                            $category_result = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                            ?>
                            <tr>
                                <td><?= $post['title'] ?></td>
                                <td><?= $category['title'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="btn sm">Editar</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn sm danger">Borrar</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No posts found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>

<?php
include '../partials/footer.php';
?>
