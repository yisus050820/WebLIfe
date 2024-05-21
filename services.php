<?php
include 'partials/header.php';

?>



<section class="empty__page">
    <h1 class="h1-black">Guía</h1>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/u4XdTDWoZgw?si=zwtF2E_HSO5838dl" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</section>

<style>
    .empty__page {
    text-align: center;
    padding: 20px;
}

.video-container {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
    max-width: 100%;
    background: #000;
    margin: 20px auto;
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

@media (max-width: 600px) {
    .empty__page {
        padding: 10px;
    }

    .video-container {
        padding-bottom: 75%; /* 4:3 aspect ratio for smaller screens */
    }
}


</style>

<?php
include 'partials/footer.php';

?>