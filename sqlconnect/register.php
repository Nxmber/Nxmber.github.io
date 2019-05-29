<?php

    $con = mysqli_connect('localhost', 'id9358295_admin', 'admin', 'id9358295_colors'); //premier paramètre va être remplacé par l'url de la base de donnée

    //vérification que la connexion existe
    if(mysqli_connect_errno())
    {
        echo "1: conection failed"; //code d'erreur #1 = connexion ratée
        exit();
    }

    $username = $_POST["name"];
    $password = $_POST["password"];

    //vérification que le name existe
    $namecheckquery = "SELECT username FROM players WHERE username='" . $username . "';";

    $namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); //code d'erreur #2 - requete de verification du nom ratee

    if(mysqli_num_rows($namecheck) > 0)
    {
        echo "3: Name already exists"; //code d'erreur #3 - le nom existe, impossible de s'enregistrer
        exit();
    }

    //ajout de l'utilisateur a notre base de donnée
    $salt = "\$5\$rounds=5000\$" . "zouglou" . $username . "\$";
    $hash = crypt($password, $salt);
    $insertuserquery = "INSERT INTO players (username, hash, salt) VALUES ('" . $username . "','" . $hash . "', '" . $salt . "');";
    mysqli_query($con, $insertuserquery) or die("4: Insert player query failed"); //code d'erreur #4 - requete d'insertion ratee

    echo("0");


?>
