<?php include('server.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GSU Networking Inventory</title>
    <meta name="description" content="GSU Networking Inventory">
    <meta name="author" content="Adam Stankovich">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
</head>

<body>
    <div class='center'>
        <form class="form" class='redirecting' method="post" action="index.php">
            <h3>GSU Networking Inventory</h3>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" maxlength="40" required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" maxlength="40" required>
            </div>
            <div class="input-group">
                <button type="submit" name="login_user">Login</button>
            </div>
            Don't Have an account? <a href='register.php'>Register</a>
            <br>
            <a href='StatesboroSwitchActive.php'>Or continue as guest..</a>
        </form>
        </section>
    </div>

    <script src="js/script.js"></script>

    <!-- Rebecca Black cheat code.... -->
    <script src="konami.js"></script>
</body>

</html>