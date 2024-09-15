<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['user_id'] = $user_id;
            header("Location: index.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with that username";
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include 'header.php'; ?>
<h2>Login</h2>
<form method="post" action="login.php">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<?php include 'footer.php'; ?>
