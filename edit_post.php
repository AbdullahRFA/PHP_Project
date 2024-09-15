<?php
include 'db.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$post_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $post_id);

    if ($stmt->execute()) {
        header("Location: view_post.php?id=$post_id");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $stmt = $conn->prepare("SELECT title, content FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stmt->bind_result($title, $content);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
}
?>

<?php include 'header.php'; ?>
<h2>Edit Post</h2>
<form method="post" action="edit_post.php?id=<?php echo $post_id; ?>">
    Title: <input type="text" name="title" value="<?php echo $title; ?>" required><br>
    Content: <textarea name="content" required><?php echo $content; ?></textarea><br>
    <button type="submit">Update Post</button>
</form>
<?php include 'footer.php'; ?>
