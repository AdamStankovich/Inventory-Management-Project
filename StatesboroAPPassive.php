<?php
include('server.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GSU Networking Inventory</title>
    <meta name="description" content="GSU Networking Inventory">
    <meta name="author" content="Adam Stankovich">
    <link rel="stylesheet" href="css/index.css">

</head>

<body>

    <script>
    var selectedButton;
    </script>

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
        <h1 id='title'>Statesboro AP Passive</h1>
        <hr>

        <div id='add'>
            <a href='addappassive.php' style='margin-bottom: 50px;'>Add New Equipment</a><br>
        </div>

        <form action="StatesboroAPPassive.php">
            <input type="text" id="search" name='search' placeholder="Search..">

            <table>
                <!------------------------------------------------------- INVENTORY TABLE ------------------------------------------------------->
                <?php
                // ---------------------------------------------------------- SEARCH -------------------------------------------------------------
                if (!empty($_GET["search"])) {
                    $search = $_GET["search"];
                    $query = "SELECT * FROM StatesboroAPPassive WHERE Name LIKE '%$search%'
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
        <th>Make</th>
        <th>Model</th>
        <th>Serial</th>
        <th>MAC</th>
        <th>Type</th>
        <th>Ready to Deploy?</th>
        <th>Location</th>
        <th>Notes</th>
        </tr>";
                    while ($row = mysqli_fetch_array($result)) {
                        $count++;
                        $id = $row['ID'];
                        echo "<tr><td>" . "<button onclick='onButtonClick(" . $id . ")' type='button' id='rma'>Edit</button>" .
                            "</td><td>" . $row['Make'] .
                            "</td><td>" . $row['Model'] .
                            "</td><td>" . $row['Serial'] .
                            "</td><td>" . $row['MAC']  .
                            "</td><td>" . $row['Type']  .
                            "</td><td>" . $row['ReadyToDeploy']  .
                            "</td><td>" . $row['Location']  .
                            "</td><td>" . $row['Notes']  . "</td></tr>";
                    }
                    echo "<h3 id='total'>Total: " . $count . "</h3>";
                }

                // ------------------------------------------------------- NO SEARCH --------------------------------------------------------------------
                else {
                    $query = "SELECT * FROM StatesboroAPPassive";
                    $result = mysqli_query($db, $query);
                    $count = 0;

                    echo "
                    <tr>
                    <th></th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Serial</th>
                    <th>MAC</th>
                    <th>Type</th>
                    <th>Ready to Deploy?</th>
                    <th>Location</th>
                    <th>Notes</th>
                    </tr>";
                    while ($row = mysqli_fetch_array($result)) {
                        $count++;
                        $id = $row['ID'];
                        echo "<tr><td>" . "<button onclick='onButtonClick(" . $id . ")' type='button' id='rma'>Edit</button>" .
                            "</td><td>" . $row['Make'] .
                            "</td><td>" . $row['Model'] .
                            "</td><td>" . $row['Serial'] .
                            "</td><td>" . $row['MAC']  .
                            "</td><td>" . $row['Type']  .
                            "</td><td>" . $row['ReadyToDeploy']  .
                            "</td><td>" . $row['Location']  .
                            "</td><td>" . $row['Notes']  . "</td></tr>";
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
                <button id='modallist'><a class='nounderlineedit' id='modallink3'
                        href='editappassive.php'>Edit</a></button>
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
            a.href = 'editappassive.php?id=' + id;
        }
        </script>
</body>

</html>