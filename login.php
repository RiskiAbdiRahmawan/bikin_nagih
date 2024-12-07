<!DOCTYPE html>
<html lang="en">

<head>
    <title>Logins</title>
    <link rel="stylesheet" href="styleLogin.css" />
</head>

<body>
    <div class="background"></div>
    <div class="card">
        <img class="logo" src="img/logo.png" />
        <h2>Welcome Back</h2>
        <form class="form" action="proses_Login.php" method="POST">
            <input type="text" placeholder="Username" name="username" />
            <input type="password" placeholder="Password" name="password" />
            <button>Sign In</button>
        </form>
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "<p style='color:red;'>Invalid username or password</p>";
        }
        ?>
    </div>
</body>

</html>