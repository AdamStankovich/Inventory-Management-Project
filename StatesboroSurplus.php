<?php
include('server.php');

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
    $decal = $array['Decal'];
    $building = $array['Building'];
    $notes = $array['Notes'];
    $cisconotes = $array['CiscoNotes'];

    // delete said row from active inventory table
    $sql = "DELETE FROM StatesboroSwitchActive WHERE ID='$id'";
    $result = mysqli_query($db, $sql);

    // insert new row containing data from selected row into RMA table
    $sqlinsert = "INSERT INTO StatesboroSurplus (`Name`, `Model`, `Serial`, `MAC`, `Type`, `Decal`, `Building`, `Notes`, `CiscoNotes`, `ID`)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($db, $sqlinsert)) {
        mysqli_stmt_bind_param($stmt, "ssssssssss", $name, $model, $serial, $mac, $type, $decal, $building, $notes, $cisconotes, $id);
        mysqli_stmt_execute($stmt);
    } else {
        echo 'Failed.';
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <!------------------------------------------ NAV BOX ------------------------------------------>
    <form class="boxleft">
        <h2>Statesboro Inventory</h2>
        <nav>
            <ul>
                <li><a id='nava' href="StatesboroSwitchActive.php">Statesboro Switch Active</a></li>
                <li><a id='nava' href="StatesboroSwitchPassive.php">Statesboro Switch Passive</a></li>
                <li><a id='nava' href="StatesboroAPPassive.php">Statesboro AP Passive</a></li>
                <li><a id='nava' href="StatesboroCablingOptics.php">Statesboro Cabling and Optics</a></li>
                <li><a id='nava' href="StatesboroAccessories.php">Statesboro Accessories</a></li>
                <li><a id='nava' href="RMAInventory.php">Statesboro RMA</a></li>
                <li><a id='nava' href="StatesboroSurplus.php">Statesboro Surplus</a></li>
            </ul>
        </nav>
    </form>

    <!-------------------------------------------------------------------- MAIN FORM ----------------------------------------------------------->

    <form class="form2">
        <h1 id='title'>Statesboro Surplus</h1>
        <hr>

        <form action="StatesboroSurplus.php">
            <input type="text" id="search" name='search' placeholder="Search..">

            <table>
                <!------------------------------------------------------- INVENTORY TABLE ------------------------------------------------------->
                <?php
                // ---------------------------------------------------------- SEARCH -------------------------------------------------------------
                if (!empty($_GET["search"])) {
                    $search = $_GET["search"];
                    $query = "SELECT * FROM StatesboroSurplus WHERE Name LIKE '%$search%'
        OR Model LIKE '%$search%'
        OR Serial LIKE '%$search%'
        OR MAC LIKE '%$search%'
        OR Type LIKE '%$search%'
        ";
                    $result = mysqli_query($db, $query);
                    $count = 0;

                    echo "<i>Contains: " . $search . "</i>";

                    echo "
        <tr>
        <th></th>
        <th>Name</th>
        <th>Model</th>
        <th>Serial</th>
        <th>MAC</th>
        <th>Type</th>
        <th>Decal</th>
        <th>Building</th>
        <th>Notes</th>
        <th>Cisco Notes</th>
        </tr>";
                    while ($row = mysqli_fetch_array($result)) {
                        $count++;
                        $id = $row['ID'];
                        echo "<tr><td>" . "<button onclick='onButtonClick(" . $id . ")' type='button' id='rma'>Edit</button>" .
                            "</td><td>" . $row['Name'] .
                            "</td><td>" . $row['Model'] .
                            "</td><td>" . $row['Serial'] .
                            "</td><td>" . $row['MAC']  .
                            "</td><td>" . $row['Type']  .
                            "</td><td>" . $row['Decal']  .
                            "</td><td>" . $row['Building']  .
                            "</td><td>" . $row['Notes']  .
                            "</td><td>" . $row['CiscoNotes']  . "</td></tr>";
                    }
                    echo "<h3 id='total'>Total: " . $count . "</h3>";
                }

                // ------------------------------------------------------- NO SEARCH --------------------------------------------------------------------
                else {
                    $query = "SELECT * FROM StatesboroSurplus";
                    $result = mysqli_query($db, $query);
                    $count = 0;

                    echo "
                    <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Serial</th>
                    <th>MAC</th>
                    <th>Type</th>
                    <th>Decal</th>
                    <th>Building</th>
                    <th>Notes</th>
                    <th>Cisco Notes</th>
                    </tr>";
                    while ($row = mysqli_fetch_array($result)) {
                        $count++;
                        $id = $row['ID'];
                        echo "<tr><td>" . "<button onclick='onButtonClick(" . $id . ")' type='button' id='rma'>Edit</button>" .
                            "</td><td>" . $row['Name'] .
                            "</td><td>" . $row['Model'] .
                            "</td><td>" . $row['Serial'] .
                            "</td><td>" . $row['MAC']  .
                            "</td><td>" . $row['Type']  .
                            "</td><td>" . $row['Decal']  .
                            "</td><td>" . $row['Building']  .
                            "</td><td>" . $row['Notes']  .
                            "</td><td>" . $row['CiscoNotes']  . "</td></tr>";
                    }
                    echo "<h3 id='total'>Total: " . $count . "</h3>";
                }
                ?>
        </form>


        <!------------------------------------------ MODAL ------------------------------------------>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Select an option from the list</h2>
                <button id='modallist'><a class='nounderlineedit' id='modallink3' href='edit.php'>Edit</a></button>
                <br>
                <button id='modallist'><a class='nounderlinerma' id='modallink' href='StatesboroRMA.php'>Send to
                        RMA</a></button>
                <br>
                <button id='modallist'><a class='nounderlinesurplus' id='modallink2' href='StatesboroSurplus.php'>Send
                        to Surplus</a></button>

            </div>
        </div>

        <script src="js/script.js"></script>

        <script>
        // ------------------------------------ MODAL SCRIPT ----------------------------------------

        var modal = document.getElementById("myModal");
        var btn = document.getElementById("rma");
        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>

        <script>
        function onButtonClick(id) {
            var a = document.getElementById('modallink');
            a.href = 'StatesboroRMA.php?id=' + id;
            var modal = document.getElementById("myModal");
            modal.style.display = 'block';
            var a = document.getElementById('modallink2');
            a.href = 'StatesboroSurplus.php?id=' + id;
            var a = document.getElementById('modallink3');
            a.href = 'edit.php?id=' + id;
        }
        </script>
</body>

</html>