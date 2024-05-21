<?php

include 'partials/header.php';

// buscar la publicación destacada de la base de datos
$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

// busca 9 publicaciones de la tabla de publicaciones
$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 9";
$posts = mysqli_query($connection, $query);
?>

<section class="category__buttons">
    <div class="container category__buttons-container">
        <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection, $all_categories_query);
        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
        <?php endwhile ?>
    </div>
</section>
<!--====================== fin de botones de categorias ====================-->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.category__buttons-container');
    const originalButtons = Array.from(container.children);
    const scrollSpeed = 1; // Velocidad del desplazamiento (px)
    let scrollInterval;

    function cloneButtons() {
        originalButtons.forEach(button => {
            const clone = button.cloneNode(true);
            container.appendChild(clone);
        });
    }

    function scrollStep() {
        container.scrollLeft += scrollSpeed;

        // Verificar si hemos llegado al final del scroll
        if (container.scrollLeft >= container.scrollWidth / 2) {
            container.scrollLeft = 0;
        }
    }

    function initializeCarousel() {
        if (window.innerWidth <= 600) {
            cloneButtons();
            if (scrollInterval) clearInterval(scrollInterval);
            scrollInterval = setInterval(scrollStep, 20);
        }
    }

    // Inicializar el carrusel
    initializeCarousel();

    // Reinitialize the carousel on window resize
    window.addEventListener('resize', function() {
        if (scrollInterval) clearInterval(scrollInterval);
        container.scrollLeft = 0;
        container.innerHTML = '';
        originalButtons.forEach(button => container.appendChild(button));
        initializeCarousel();
    });

    // Desactivar el desplazamiento horizontal con la rueda del mouse
    container.addEventListener('wheel', function(event) {
        if (event.deltaY !== 0) {
            event.preventDefault();
        }
    });

    // Stop the scroll interval when the container is out of view
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            if (scrollInterval) clearInterval(scrollInterval);
        } else {
            if (scrollInterval) clearInterval(scrollInterval);
            scrollInterval = setInterval(scrollStep, 20);
        }
    });
});
</script>

<!-- mostrar publicación destacada si hay alguna -->
<?php if (mysqli_num_rows($featured_result) == 1) : ?>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail" id="post_thumbnail_<?= $featured['id'] ?>">
                <img src="./images/<?= $featured['thumbnail'] ?>">
                <div class="heart-overlay <?= isset($_SESSION['user-id']) && userLikedPost($connection, $_SESSION['user-id'], $featured['id']) ? 'liked' : '' ?>">
                    <i class="fas fa-leaf"></i>
                </div>
            </div>
            <div class="post__info">
                <?php
                // busca la categoría de la tabla de categorías usando el ID de categoría de la publicación
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                ?>
                <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $featured['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                <h2 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
                <p class="post__body">
                    <?= substr($featured['body'], 0, 300) ?>...
                </p>
                <div class="post__author">
                    <?php
                    // busca el autor de la tabla de usuarios usando Author_id
                    $author_id = $featured['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>
                    <div class="post__author-avatar">
                        <img src="./images/<?= $author['avatar'] ?>">
                    </div>
                    <div class="post__author-info">
                        <h5>Publicado por: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                        <small>
                            <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
<!--====================== FIN DE DESTACADOS ====================-->

<section class="posts <?= $featured ? '' : 'section__extra-margin' ?>">
    <div class="container posts__container">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post__thumbnail" id="post_thumbnail_<?= $post['id'] ?>">
                    <img src="./images/<?= $post['thumbnail'] ?>">
                    <div class="heart-overlay <?= isset($_SESSION['user-id']) && userLikedPost($connection, $_SESSION['user-id'], $post['id']) ? 'liked' : '' ?>">
                        <i class="fas fa-leaf"></i>
                    </div>
                </div>
                <div class="post__info">
                    <?php
                    // busca la categoría de la tabla de categorías usando el ID de categoría de la publicación
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    ?>
                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                    <h3 class="post__title">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                    </h3>
                    <div class="post__like-indicator <?= isset($_SESSION['user-id']) && userLikedPost($connection, $_SESSION['user-id'], $post['id']) ? 'visible' : '' ?>">
                        <i class="fas fa-leaf" style="color: red;"></i>
                    </div>
                    <p class="post__body">
                        <?= substr($post['body'], 0, 150) ?>...
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>" class="vermas">Ver más...</a>
                    </p>
                    <div class="post__author">
                        <?php
                        // busca el autor de la tabla de usuarios usando Author_id
                        $author_id = $post['author_id'];
                        $author_query = "SELECT * FROM users WHERE id=$author_id";
                        $author_result = mysqli_query($connection, $author_query);
                        $author = mysqli_fetch_assoc($author_result);
                        ?>
                        <div class="post__author-avatar">
                            <img src="./images/<?= $author['avatar'] ?>">
                        </div>
                        <div class="post__author-info">
                            <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                            <small>
                                <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                            </small>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile ?>
    </div>
</section>
<!--====================== fin de post ====================-->

<!-- Add the modal for unauthorized access -->
<div id="unauthorizedModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Debe iniciar sesión para poder dar like.</p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const posts = document.querySelectorAll('.post__thumbnail');
    const unauthorizedModal = document.getElementById('unauthorizedModal');
    const closeModal = unauthorizedModal.querySelector('.close');

    // Check if user is authenticated
    const isAuthenticated = <?php echo isset($_SESSION['user-id']) ? 'true' : 'false'; ?>;

    posts.forEach(post => {
        post.addEventListener('dblclick', function () {
            if (!isAuthenticated) {
                // Show the modal if the user is not authenticated
                unauthorizedModal.style.display = 'block';
                return;
            }

            const heartOverlay = this.querySelector('.heart-overlay');
            const postId = this.id.split('_')[2];

            if (heartOverlay.classList.contains('liked')) {
                // Remove the like
                updateLike(postId, false);
            } else {
                // Add the like
                updateLike(postId, true);
            }
        });
    });

    // Close the modal when the close button is clicked
    closeModal.addEventListener('click', function() {
        unauthorizedModal.style.display = 'none';
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === unauthorizedModal) {
            unauthorizedModal.style.display = 'none';
        }
    });

    // Function to update the like status in the database and reload the page
    function updateLike(postId, like) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "update_like.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error('Error updating like status');
                }
            }
        };
        xhr.send("post_id=" + postId + "&like=" + like);
    }
});



</script>

<style>
/* Add styles for the unauthorized modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 400px;
    text-align: center;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.post__like-indicator.visible {
    display: block !important;
}
</style>

<?php
include 'partials/footer.php';
?>

<?php
function userLikedPost($connection, $userId, $postId) {
    $query = "SELECT * FROM post_likes WHERE user_id=$userId AND post_id=$postId";
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result) > 0;
}
?>
