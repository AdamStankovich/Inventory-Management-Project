<?php
session_start();
$username = "";
$email    = "";
$db = mysqli_connect('localhost', 'phpmyadmin', '___PASSWORD___', '___DB-NAME__');

// login
if (isset($_POST['login_user'])) {
    if (strlen($_POST['login_user']) < 41) {
        $username = htmlentities(mysqli_real_escape_string($db, $_POST['username']));
        $password = htmlentities(mysqli_real_escape_string($db, $_POST['password']));
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: StatesboroSwitchActive.php');
        } else {
            echo ("Wrong username or password");
        }
    } else {
        echo "stop that...";
    }
}

// registration
if (isset($_POST['reg_user'])) {
    $username = htmlentities(mysqli_real_escape_string($db, $_POST['username']));
    $email = htmlentities(mysqli_real_escape_string($db, $_POST['email']));
    $password_1 = htmlentities(mysqli_real_escape_string($db, $_POST['password_1']));
    $password_2 = htmlentities(mysqli_real_escape_string($db, $_POST['password_2']));
    $securityquestion = htmlentities(mysqli_real_escape_string($db, $_POST['securityquestion']));

    // check if user exists
    $sql = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $getData = mysqli_fetch_assoc($result);
    }

    if (count($getData) == 0) {
        $password = htmlentities($password_1);

        $sql = "INSERT INTO users (username, email, password, securityquestion, admin)
                    VALUES(?, ?, ?, ?, '0')";

        if ($stmt = mysqli_prepare($db, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $password, $securityquestion);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $getData = mysqli_fetch_assoc($result);
        }

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    } else {
        echo "Username or email already exists";
    }
}

// reset password
if (isset($_POST['resetpw'])) {
    $usernamecheck = htmlentities(mysqli_real_escape_string($db, $_POST['usernamecheck']));
    $securitycheck = htmlentities(mysqli_real_escape_string($db, $_POST['securitycheck']));
    $newpassword = htmlentities(mysqli_real_escape_string($db, $_POST['newpassword']));

    $sql = "SELECT * FROM users WHERE username = ? AND securityquestion = ?";

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $usernamecheck, $securitycheck);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $getData = mysqli_fetch_assoc($result);
    }
    if (mysqli_num_rows($result) == 1) {
        $sql = "UPDATE users SET password = ? WHERE username = ? AND securityquestion = ?";

        if ($stmt = mysqli_prepare($db, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $newpassword, $usernamecheck, $securitycheck);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $getData = mysqli_fetch_assoc($result);
        }
        header('location: login.php');
    } else {
        echo ("Wrong username or security answer.");
    }
}

//admin promote
if (isset($_POST['promote'])) {

    $promoteuser = htmlentities(mysqli_real_escape_string($db, $_POST['promoteuser']));

    $sql = "UPDATE users SET admin = '1' WHERE username = ?";

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $promoteuser);
        mysqli_stmt_execute($stmt);
    }
}

//admin demote
if (isset($_POST['demote'])) {

    $demoteuser = htmlentities(mysqli_real_escape_string($db, $_POST['demoteuser']));

    $sql = "UPDATE users SET admin = '0' WHERE username = ?";

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $demoteuser);
        mysqli_stmt_execute($stmt);
    }
}

//editrow Switch Active
if (isset($_POST['editrow'])) {
    $query = "UPDATE StatesboroSwitchActive SET Name = '{$_POST['name']}', Model = '{$_POST['model']}', Serial = '{$_POST['serial']}', MAC = '{$_POST['mac']}', Type = '{$_POST['type']}', Decal = '{$_POST['decal']}', Building = '{$_POST['building']}', Notes = '{$_POST['notes']}', CiscoNotes = '{$_POST['cisconotes']}' WHERE id = {$_POST['id']}";
    $results = mysqli_query($db, $query);
    header('location: StatesboroSwitchActive.php');
}

//editrow Switch passive
if (isset($_POST['editrowpassive'])) {
    $query = "UPDATE StatesboroSwitchPassive SET Decal = '{$_POST['decal']}', Model = '{$_POST['model']}', Serial = '{$_POST['serial']}', PIDVID = '{$_POST['pidvid']}', MAC = '{$_POST['mac']}', Type = '{$_POST['type']}', ReadyToDeploy = '{$_POST['readytodeploy']}', Location = '{$_POST['location']}', Notes = '{$_POST['notes']}' WHERE id = {$_POST['id']}";
    $results = mysqli_query($db, $query);
    header('location: StatesboroSwitchPassive.php');
}

//editrow AP passive
if (isset($_POST['editrowappassive'])) {
    $query = "UPDATE StatesboroAPPassive SET Make = '{$_POST['make']}', Model = '{$_POST['model']}', Serial = '{$_POST['serial']}', MAC = '{$_POST['mac']}', Type = '{$_POST['type']}', ReadyToDeploy = '{$_POST['readytodeploy']}', Location = '{$_POST['location']}', Notes = '{$_POST['notes']}' WHERE id = {$_POST['id']}";
    $results = mysqli_query($db, $query);
    header('location: StatesboroAPPassive.php');
}

//editrow Cabling Optics
if (isset($_POST['editrowcablingoptics'])) {
    $query = "UPDATE StatesboroCablingOptics SET Type = '{$_POST['type']}', Length = '{$_POST['length']}', Color = '{$_POST['color']}', Connectors = '{$_POST['connectors']}', Quantity = '{$_POST['quantity']}', Description = '{$_POST['description']}', Notes = '{$_POST['notes']}' WHERE id = {$_POST['id']}";
    $results = mysqli_query($db, $query);
    header('location: StatesboroCablingOptics.php');
}

//editrow Accessories
if (isset($_POST['editrowaccessories'])) {
    $query = "UPDATE StatesboroAccessories SET Make = '{$_POST['make']}', Model = '{$_POST['model']}', Location = '{$_POST['location']}', Notes = '{$_POST['notes']}' WHERE id = {$_POST['id']}";
    $results = mysqli_query($db, $query);
    header('location: StatesboroAccessories.php');
}

//addrow switch active
if (isset($_POST['addrow'])) {
    $sql = "INSERT INTO StatesboroSwitchActive (Name, Model, Serial, MAC, Type, Decal, Building, Notes, CiscoNotes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssssss", $_POST['name'], $_POST['model'], $_POST['serial'], $_POST['mac'], $_POST['type'], $_POST['decal'], $_POST['building'], $_POST['notes'], $_POST['cisconotes']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $getData = mysqli_fetch_assoc($result);
    }
}

//addrow switch passive
if (isset($_POST['addrowswitchpassive'])) {
    $sql = "INSERT INTO StatesboroSwitchPassive (Decal, Model, Serial, PIDVID, MAC, Type, ReadyToDeploy, Location, Notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssssss", $_POST['decal'], $_POST['model'], $_POST['serial'], $_POST['pidvid'], $_POST['mac'], $_POST['type'], $_POST['readytodeploy'], $_POST['location'], $_POST['notes']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $getData = mysqli_fetch_assoc($result);
    }
}

//addrow ap passive
if (isset($_POST['addrowappassive'])) {
    $sql = "INSERT INTO StatesboroAPPassive (Make, Model, Serial, MAC, Type, ReadyToDeploy, Location, Notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssssss", $_POST['make'], $_POST['model'], $_POST['serial'], $_POST['mac'], $_POST['type'], $_POST['readytodeploy'], $_POST['location'], $_POST['notes']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $getData = mysqli_fetch_assoc($result);
    }
}

//addrow cabling optics
if (isset($_POST['addrowcablingoptics'])) {
    $sql = "INSERT INTO StatesboroCablingOptics (Type, Length, Color, Connectors, Quantity, Description, Notes) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssss", $_POST['type'], $_POST['length'], $_POST['color'], $_POST['connectors'], $_POST['quantity'], $_POST['description'], $_POST['notes']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $getData = mysqli_fetch_assoc($result);
    }
}

//addrow accessories
if (isset($_POST['addrowaccessories'])) {
    $sql = "INSERT INTO StatesboroAccessories (Make, Model, Location, Notes) VALUES (?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $_POST['make'], $_POST['model'], $_POST['location'], $_POST['notes']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $getData = mysqli_fetch_assoc($result);
    }
}
