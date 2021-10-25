<?php include('server.php');

// If the URL contains a specific Row ID
if (!empty($_GET["id"])) {

    //get the ID from the URL
    $id = $_GET["id"];

    // grab values from the row that was selected
    $sql = "SELECT * FROM StatesboroCablingOptics WHERE ID='$id'";
    $result = mysqli_query($db, $sql);
    $array = mysqli_fetch_assoc($result);
    $type = $array['Type'];
    $length = $array['Length'];
    $color = $array['Color'];
    $connectors = $array['Connectors'];
    $quantity = $array['Quantity'];
    $description = $array['Description'];
    $notes = $array['Notes'];
}
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
    <div class="center">
        <form class="form" method="post" action="editcablingoptics.php?id=<?php echo $id ?>">
            <h3>Edit Inventory Item</h3>
            <div class="input-group">
                <label>Type</label>
                <input type="text" name="type" value="<?php echo $type ?>">
            </div>
            <div class="input-group">
                <label>Length</label>
                <input type="text" name="length" value="<?php echo $length ?>">
            </div>
            <div class="input-group">
                <label>Color</label>
                <input type="text" name="color" value="<?php echo $color ?>">
            </div>
            <div class="input-group">
                <label>Connectors</label>
                <input type="text" name="connectors" value="<?php echo $connectors ?>">
            </div>
            <div class="input-group">
                <label>Quantity</label>
                <input type="text" name="quantity" value="<?php echo $quantity ?>">
            </div>
            <div class="input-group">
                <label>Description</label>
                <input type="text" name="description" value="<?php echo $description ?>">
            </div>
            <div class="input-group">
                <label>Notes</label>
                <input type="text" name="notes" value="<?php echo $notes ?>">
            </div>
            <div class="input-group">
                <input type="hidden" name="id" value="<?php echo $id ?>">
            </div>
            <div class="input-group">
                <button type="submit" name="editrowcablingoptics">Submit</button>
            </div>
        </form>
    </div>
    </section>
</body>

</html>