<!DOCTYPE html>
<html>
<head>
    <title>My CMS</title>
</head>
<body>
    <header>
        <h1>My CMS</h1>
        <?php session_start(); ?>
        <?php if(isset($_SESSION['user_id'])): ?>
            <nav>
                <a href="index.php">Home</a>
                <a href="create_post.php">Create Post</a>
                <a href="logout.php">Logout</a>
            </nav>
        <?php else: ?>
            <nav>
                <a href="index.php">Home</a>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            </nav>
        <?php endif; ?>
    </header>
    <hr>
