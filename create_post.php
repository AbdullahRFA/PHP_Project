<?php
include 'db.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include 'header.php'; ?>
<h2>Create Post</h2>
<form method="post" action="create_post.php">
    Title: <input type="text" name="title" required><br>
    Content: <textarea name="content" required></textarea><br>
    <button type="submit">Create Post</button>
</form>
<?php include 'footer.php'; ?>
