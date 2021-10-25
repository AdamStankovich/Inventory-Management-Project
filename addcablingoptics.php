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
        <form class="form" method="post" action="StatesboroCablingOptics.php">
            <h3>Add to Cabling & Optics</h3>
            <div class="input-group">
                <label>Type</label>
                <input type="text" name="type">
            </div>
            <div class="input-group">
                <label>Length</label>
                <input type="text" name="length">
            </div>
            <div class="input-group">
                <label>Color</label>
                <input type="text" name="color">
            </div>
            <div class="input-group">
                <label>Connectors</label>
                <input type="text" name="connectors">
            </div>
            <div class="input-group">
                <label>Quantity</label>
                <input type="text" name="quantity">
            </div>
            <div class="input-group">
                <label>Description</label>
                <input type="text" name="description">
            </div>
            <div class="input-group">
                <label>Notes</label>
                <input type="text" name="notes">
            </div>
            <div class="input-group">
                <label>Notes</label>
                <input type="text" name="notes">
            </div>
            <div class="input-group">
                <input type="hidden" name="id">
            </div>
            <div class="input-group">
                <button type="submit" name="addcablingoptics">Submit</button>
            </div>
            <p>
                <a href='import.php'> Want to import a .csv? </a>
            </p>
        </form>
    </div>
    </section>
</body>

</html>