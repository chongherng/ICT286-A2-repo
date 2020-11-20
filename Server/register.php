<?php

if(isset($_POST["submit"])){

    $email = $_POST["email"];
    $password = $_POST["password"];
    $firstName = $_POST["fName"];
    $lastName = $_POST["lName"];

    //Connect to database
    $local = 'localhost';
    $username = 'X33896239';
    $password = 'X33896239';
    $dbname = 'X33896239';

    $dbc = mysqli_connect($local, $username, $password, $dbname);

    if (mysqli_connect_errno() !== false) {
        die("Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>Error number:" . mysqli_connect_errno());
    }
    
    if(isInputEmpty($email,$password,$firstName,$lastName) !== false){
        $dbc->close();
        header("location: ../Server/index.php#register?error=emptyInput");
        exit();
    }
    if(isEmailInvalid($email) !== false) {
        $dbc->close();
        header("location: ../Server/index.php#register?error=invalidEmail");
        exit();
    }
    if(isNameValid($firstName,$lastName) !== false){
        $dbc->close();
        header("location: ../Server/index.php#register?error=invalidName");
        exit();
    }
    if(emailExists($dbc,$email) !== false) {
        $dbc->close();
        header("location: ../Server/index.php#register?error=emailTaken");
        exit();
    }

    createUser($dbc, $email, $password, $firstName, $lastName);

} else {
    header("location: ../Server/index.php#register");
    exit();
}


function isInputEmpty($email,$password,$firstName,$lastName){
    if(empty($email) || empty($password) || empty($firstName) || empty($lastName)) {
        return true;
    } else{
        return false;
    }
}

function isEmailInvalid($email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) ){
        return true;
    } else {
        return false;
    }
}

function isNameValid($firstName,$lastName){
    if(!preg_match(("/^[a-zA-Z]*$/"), $firstName) || !preg_match(("/^[a-zA-Z]*$/"), $lastName)){
        return true;
    } else {
        return false;
    }
}

function emailExists($dbc,$email){
    $query = $dbc->real_escape_string($email);
    $sql = "SELECT * FROM users WHERE userEmail = $query";
    $result = mysqli_query($dbc,$sql);
    if($result->num_rows > 0) {
        return true;
    } else{
        return false;
    }
}

function createUser($dbc, $email, $password, $firstName, $lastName){
    $email = $dbc->real_escape_string($email);
    $password = $dbc->real_escape_string($password);
    $firstName = $dbc->real_escape_string($firstName);
    $lastName = $dbc->real_escape_string($lastName);

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (userEmail,userFName,userLName,userPwd) VALUES ($email,$firstName,$lastName,$hashedPwd)";
    mysqli_query($dbc,$sql);
    header("location: ../Server/index.php#register?error=none");
}


?>