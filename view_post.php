<?php
include 'db.php';

$post_id = $_GET['id'];

$stmt = $conn->prepare("SELECT title, content, created_at FROM posts WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->bind_result($title, $content, $created_at);
$stmt->fetch();
$stmt->
