<?php
session_start();
require 'config/database.php';

if (isset($_SESSION['user-id']) && isset($_POST['post_id']) && isset($_POST['like'])) {
    $userId = $_SESSION['user-id'];
    $postId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
    $like = filter_var($_POST['like'], FILTER_VALIDATE_BOOLEAN);

    if ($like) {
        // Add like
        $query = "INSERT INTO post_likes (user_id, post_id) VALUES ($userId, $postId)";
        mysqli_query($connection, $query);
    } else {
        // Remove like
        $query = "DELETE FROM post_likes WHERE user_id=$userId AND post_id=$postId";
        mysqli_query($connection, $query);
    }
}
?>
