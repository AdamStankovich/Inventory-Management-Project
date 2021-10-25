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
</head>

<body>
    <div class="center2">
        <form class="form" method="post" action="StatesboroAccessories.php">
            <h3>Add to Accessories</h3>
            <div class="input-group">
                <label>Make</label>
                <input type="text" name="make">
            </div>
            <div class="input-group">
                <label>Model</label>
                <input type="text" name="model">
            </div>
            <div class="input-group">
                <label>Location</label>
                <input type="text" name="location">
            </div>
            <div class="input-group">
                <label>Notes</label>
                <input type="text" name="notes">
            </div>
            <div class="input-group">
                <input type="hidden" name="id">
            </div>
            <div class="input-group">
                <button type="submit" name="addrowaccessories">Submit</button>
            </div>
            <p>
                <a href='import.php'> Want to import a .csv? </a>
            </p>
        </form>
    </div>
    </section>
</body>

</html>