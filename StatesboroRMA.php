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
  $sqlinsert = "INSERT INTO StatesboroRMA (`Name`, `Model`, `Serial`, `MAC`, `Type`, `Decal`, `Building`, `Notes`, `CiscoNotes`, `ID`)
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

    </form>

    <form class="form2">

        <h1 id='rmatitle'>Choose replacement (Statesboro Passive)</h1>
        <h2> <a href='StatesboroSwitchActive.php'>No replacement?</a></h2>

        <form action="StatesboroSwitchActive.php" method="post">
            <input type="text" id="searchrma" name='search' placeholder="Search..">

            <table>
                <!-- INVENTORY TABLE -->
                <?php
        if (!empty($_GET["search"])) {
          $search = $_GET["search"];
          $query = "SELECT * FROM StatesboroSwitchPassive WHERE Decal LIKE '%$search%'
            OR Type LIKE '%$search%'
            OR Location LIKE '%$search%'
            OR Notes LIKE '%$search%'
            OR Model LIKE '%$search%'
            OR Serial LIKE '%$search%'
            OR MAC LIKE '%$search%'
            ";
          $result = mysqli_query($db, $query);
          $count = 0;

          echo "<i>Contains: " . $search . "</i>";

          echo "
                <tr>
                <th></th>
                <th>Decal</th>
                <th>Model</th>
                <th>Serial</th>
                <th>PID VID</th>
                <th>MAC</th>
                <th>Type</th>
                <th>Ready to Deploy?</th>
                <th>Location</th>
                <th>Notes</th>
                </tr>";
          while ($row = mysqli_fetch_array($result)) {
            $count++;
            echo "<tr><td>" . "<a href='StatesboroSwitchActive.php'><button type='button' id='select'>SELECT</button></a>" .
              "</td><td>" . $row['Decal'] .
              "</td><td>" . $row['Model'] .
              "</td><td>" . $row['Serial'] .
              "</td><td>" . $row['PID VID'] .
              "</td><td>" . $row['MAC']  .
              "</td><td>" . $row['Type']  .
              "</td><td>" . $row['Ready to Deploy?']  .
              "</td><td>" . $row['Location']  .
              "</td><td>" . $row['Notes']  . "</td></tr>";
          }
          echo "<h3>Total: " . $count . "</h3>";
        } else {
          $query = "SELECT * FROM StatesboroSwitchPassive";
          $result = mysqli_query($db, $query);
          $count = 0;

          echo "
        <tr>
        <th></th>
        <th>Decal</th>
        <th>Model</th>
        <th>Serial</th>
        <th>PID VID</th>
        <th>MAC</th>
        <th>Type</th>
        <th>Ready to Deploy?</th>
        <th>Location</th>
        <th>Notes</th>
        </tr>";
          while ($row = mysqli_fetch_array($result)) {
            $count++;
            echo "<tr><td>" . "<a href='StatesboroSwitchActive.php'><button type='button' id='select'>SELECT</button></a>" .
              "</td><td>" . $row['Decal'] .
              "</td><td>" . $row['Model'] .
              "</td><td>" . $row['Serial'] .
              "</td><td>" . $row['PID VID'] .
              "</td><td>" . $row['MAC']  .
              "</td><td>" . $row['Type']  .
              "</td><td>" . $row['Ready to Deploy?']  .
              "</td><td>" . $row['Location']  .
              "</td><td>" . $row['Notes']  . "</td></tr>";
          }
          echo "<h3>Total: " . $count . "</h3>";
        }

        ?>

        </form>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>How do you want to RMA this item?</h2>
                <button action='rmaSQL' id='rma2'>Send to RMA'd inventory</button>
                <br>
                <button id='swap'><a href='rma.php'>RMA and Swap with an item from the Passive inventory</a></button>
            </div>
        </div>

        <script src="js/script.js"></script>

        <script>
        // ------------------------------------ MODAL SCRIPT ----------------------------------------
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("rma");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
</body>

</html>