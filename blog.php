<?php
include 'partials/header.php';

// Fetch all posts from posts table
$query = "SELECT * FROM posts ORDER BY date_time DESC";
$posts = mysqli_query($connection, $query);
?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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







</head>

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




<section class="posts <?= $featured ? '' : 'section__extra-margin' ?>">
    <div class="container posts__container">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post__thumbnail" id="post_thumbnail_<?= $post['id'] ?>">
                    <img src="./images/<?= $post['thumbnail'] ?>">
                    <div class="heart-overlay">
                        <i class="fas fa-leaf"></i>
                    </div>
                </div>
                <div class="post__info">
                    <?php
                    // Fetch category from categories table using category_id of post
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    ?>
                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                    <h3 class="post__title">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                    </h3>
                    <div class="post__like-indicator" id="like_indicator_<?= $post['id'] ?>">
                        <i class="fas fa-leaf" style="color: red;"></i>
                    </div>
                    <p class="post__body">
                        <?= substr($post['body'], 0, 150) ?>...
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>" class="vermas">Ver más...</a>
                    </p>
                    <div class="post__author">
                        <?php
                        // Fetch author from users table using author_id
                        $author_id = $post['author_id'];
                        $author_query = "SELECT * FROM users WHERE id=$author_id";
                        $author_result = mysqli_query($connection, $author_query);
                        $author = mysqli_fetch_assoc($author_result);
                        ?>
                        <div class="post__author-avatar">
                            <img src="./images/<?= $author['avatar'] ?>">
                        </div>
                        <div class="post__author-info">
                            <h5>Publicado por : <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const posts = document.querySelectorAll('.post__thumbnail');

    posts.forEach(post => {
        post.addEventListener('dblclick', function () {
            const heartOverlay = this.querySelector('.heart-overlay');
            const likeIndicator = this.nextElementSibling.querySelector('.post__like-indicator');

            if (heartOverlay.classList.contains('liked')) {
                // Remove the like
                heartOverlay.classList.remove('liked');
                heartOverlay.classList.remove('animate-like');
                heartOverlay.style.color = 'white';
                likeIndicator.style.display = 'none';
            } else {
                // Add the like
                heartOverlay.classList.add('liked');
                heartOverlay.classList.add('animate-like');
                heartOverlay.style.color = 'red';
                likeIndicator.style.display = 'block';

                // Remove the animation class after the animation ends
                setTimeout(() => {
                    heartOverlay.classList.remove('animate-like');
                }, 500);
            }
        });
    });
});
</script>

<?php
include 'partials/footer.php';
?>
