<?php

if(isset($_POST["submit"])){

    $username = $_POST["username"];
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
    
    if(isInputEmpty($username,$password,$firstName,$lastName) !== false){
        $dbc->close();
        header("location: ../Server/index.php#register?error=emptyInput");
        exit();
    }
    if(isusernameInvalid($username) !== false) {
        $dbc->close();
        header("location: ../Server/index.php#register?error=InvalidUsername");
        exit();
    }
    if(isNameValid($firstName,$lastName) !== false){
        $dbc->close();
        header("location: ../Server/index.php#register?error=invalidName");
        exit();
    }
    if(usernameExists($dbc,$username) !== false) {
        $dbc->close();
        header("location: ../Server/index.php#register?error=usernameTaken");
        exit();
    }

    createUser($dbc, $username, $password, $firstName, $lastName);

} else {
    header("location: ../Server/index.php#register");
    exit();
}


function isInputEmpty($username,$password,$firstName,$lastName){
    if(empty($username) || empty($password) || empty($firstName) || empty($lastName)) {
        return true;
    } else{
        return false;
    }
}

function isUsernameInvalid($username) {
    if(!preg_match(("/^[a-zA-Z0-9]*$/"), $username) ){
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

function usernameExists($dbc,$username){
    $query = $dbc->real_escape_string($username);
    $sql = "SELECT * FROM users WHERE username = $query";
    $result = mysqli_query($dbc,$sql);
    if($result->num_rows > 0) {
        return true;
    } else{
        return false;
    }
}

function createUser($dbc, $username, $password, $firstName, $lastName){
    $username = $dbc->real_escape_string($username);
    $password = $dbc->real_escape_string($password);
    $firstName = $dbc->real_escape_string($firstName);
    $lastName = $dbc->real_escape_string($lastName);

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (userType,username,userFName,userLName,userPwd) VALUES ('Member',$username,$firstName,$lastName,$hashedPwd)";
    mysqli_query($dbc,$sql);
    $dbc->close();
    header("location: ../Server/index.php#register?error=none");
}


?>