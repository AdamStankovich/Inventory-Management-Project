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
    <form class="form25" method="post" action="https://adamstan.me/phpmyadmin" target="_blank">
        <h4>To import a .csv, click the link and follow the instructions below.</h4>
        <button class="button-primary">IMPORT .CSV</button>
        <hr>
        <b>Step 1.</b> Login with admin credentials<br><br>
        <img src="img/step1.png">
        <hr>
        <b>Step 2.</b> On the left side of the screen, select the "networkinventory" database.<br><br>
        <img src="img/step2.png">
        <hr>
        <b>Step 3.</b> Select the table you want to add to. <b>Make sure the table headers are the same in your .csv as
            they are on the website.</b><br><br>
        <img src="img/step3.png">
        <hr>
        <b>Step 4.</b> On the top of the page, select "Import"<br><br>
        <img src="img/step4.png">
        <hr>
        <b>Step 5.</b> Choose your .csv file<br><br>
        <img src="img/step5.png">
        <hr>
        <b>Step 6.</b> Scroll down, and select CSV from the format dropdown.<br><br>
        <img src="img/step6.png">
        <hr>
        <b>Step 7.</b> Click Go.<br><br>
        <img src="img/step7.png">
    </form>
</body>

</html>