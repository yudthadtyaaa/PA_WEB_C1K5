<?php

include '../database/connection.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
        $_SESSION['level'] = "user";
		$_SESSION['username'] = $row;
		header("Location: index.php");
    } else {
	echo "<script>alert('Username/Password salah silahkan coba lagi!')</script>";
    }
} 



?>

<link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>">

<title>Login Mango</title>

<div class="navbar">
    <div class="navbarTengah">
        <ul>
            <span>
                <li><a href="index.php">Mango</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
            </span>
        </ul>
    </div>
    <div class="navbarKanan">
        <ul>
            <span>
                <?php
                    session_start();
                    error_reporting(0);
                    if($_SESSION['username'])
                    echo '<li><a href="logout.php">Logout</a></li>';
                    else{
                        echo '<li><a href="login.php">Login</a></li>';
                    }
                ?>
            </span>
        </ul>
    </div>
</div>


<div class="login">
    <form action="" method="POST">
        <div class="logForm">
            <h3>Login</h3>
            <hr>

            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
    
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" name="submit" class="logBtn">Login</button>
            <div class="reg"><p>Belum punya akun? <a href="../public/registration.php" style="color: black;">Registrasi</a></p>
            <a href="../admin/adminLogin.php" id="developer">Login as admin</a>
        </div>
    </div>
</form>
</div>