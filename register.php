<?php include('server.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GSU Networking Inventory</title>
    <meta name="description" content="GSU Networking Inventory">
    <meta name="author" content="Adam Stankovich">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
    <script src="https://use.fontawesome.com/50856d93ba.js"></script>
</head>

<body>

    <div class="center">
        <form class="form" method="post" action="register.php">
        <h3>Register</h3>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" maxlength="40" required>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" maxlength="40" required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password_1" maxlength="40" required>
            </div>
            <div class="input-group">
                <button type="submit" name="reg_user">Register</button>
            </div>
            <p>
                Already a member? <a href="index.php">Sign in</a>
            </p>
        </form>
    </div>
    </section>

    <script src="js/script.js"></script>
</body>

</html>