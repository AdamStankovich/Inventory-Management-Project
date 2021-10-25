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
        <form class="form" method="post" action="StatesboroSwitchActive.php">
            <h3>Add to Switch Active</h3>
            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name">
            </div>
            <div class="input-group">
                <label>Model</label>
                <input type="text" name="model">
            </div>
            <div class="input-group">
                <label>Serial</label>
                <input type="text" name="serial">
            </div>
            <div class="input-group">
                <label>MAC</label>
                <input type="text" name="mac">
            </div>
            <div class="input-group">
                <label>Type</label>
                <input type="text" name="type">
            </div>
            <div class="input-group">
                <label>Decal</label>
                <input type="text" name="decal">
            </div>
            <div class="input-group">
                <label>Building</label>
                <input type="text" name="building">
            </div>
            <div class="input-group">
                <label>Notes</label>
                <input type="text" name="notes">
            </div>
            <div class="input-group">
                <label>Cisco Notes</label>
                <input type="text" name="cisconotes">
            </div>
            <div class="input-group">
                <input type="hidden" name="id">
            </div>
            <div class="input-group">
                <button type="submit" name="addrow">Submit</button>
            </div>
            <p>
                <a href='import.php'> Want to import a .csv? </a>
            </p>
        </form>
    </div>
    </section>
</body>

</html>