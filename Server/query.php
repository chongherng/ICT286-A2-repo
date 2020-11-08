<?php
    $local = 'localhost';
    $username = 'X33896239';
    $password = 'X33896239';
    $dbname = 'X33896239';

    $dbc = mysqli_connect($local,$username,$password,$dbname);

    if(mysqli_connect_errno()) {
        die("Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>Error number:" . mysqli_connect_errno());    
    }

    $sql = "sELECT & FROM product";
    $result = mysqli_query($dbc,$sql);

    $dbc->close();
?>