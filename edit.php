<?php include('server.php');

// If the URL contains a specific Row ID
if (!empty($_GET["id"])) {

    //get the ID from the URL
    $id = $_GET["id"];

    // grab values from the row that was selected
    $sql = "SELECT * FROM StatesboroSwitchActive WHERE ID='$id'";
    $result = mysqli_query($db, $sql);
    $array = mysqli_fetch_assoc($result);
    $name = $array['Name'];
    $model = $array['Model'];
    $serial = $array['Serial'];
    $mac = $array['MAC'];
    $type = $array['Type'];
    $notes = $array['Notes'];
    $cisconotes = $array['CiscoNotes'];
    $location = $array['Location'];
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
        <form class="form" method="post" action="edit.php?id=<?php echo $id ?>">
            <h3>Edit Inventory Item</h3>
            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name ?>">
            </div>
            <div class="input-group">
                <label>Model</label>
                <input type="text" name="model" value="<?php echo $model ?>">
            </div>
            <div class="input-group">
                <label>Serial</label>
                <input type="text" name="serial" value="<?php echo $serial ?>">
            </div>
            <div class="input-group">
                <label>MAC</label>
                <input type="text" name="mac" value="<?php echo $mac ?>">
            </div>
            <div class="input-group">
                <label>Type</label>
                <input type="text" name="type" value="<?php echo $type ?>">
            </div>
            <div class="input-group">
                <label>Notes</label>
                <input type="text" name="notes" value="<?php echo $notes ?>">
            </div>
            <div class="input-group">
                <label>Cisco Notes</label>
                <input type="text" name="cisconotes" value="<?php echo $cisconotes ?>">
            </div>
            <div class="input-group">
                <label>Location</label>
                <input type="text" name="location" value="<?php echo $location ?>">
            </div>
            <div class="input-group">
                <input type="hidden" name="id" value="<?php echo $id ?>">
            </div>
            <div class="input-group">
                <button type="submit" name="editrow">Submit</button>
            </div>
        </form>
    </div>
    </section>
</body>

</html>