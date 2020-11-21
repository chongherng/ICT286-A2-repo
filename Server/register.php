<?php

if(isset($_POST["submit"])){

    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstName = $_POST["fname"];
    $lastName = $_POST["lname"];

    //Connect to database
    $local = 'localhost';
    $dbusername = 'X33896239';
    $dbpassword = 'X33896239';
    $dbname = 'X33896239';

    $dbc = mysqli_connect($local, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_errno()) {
        die("Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>Error number:" . mysqli_connect_errno());
    }
    
    if(isInputEmpty($username,$password,$firstName,$lastName) !== false){
        $dbc->close();
        header("location: ../WebClient/index.php?error=emptyInput#register");
        exit();
    }
    if(isUsernameInvalid($username) !== false) {
        $dbc->close();
        header("location: ../WebClient/index.php?error=InvalidUsername#register");
        exit();
    }
    if(isNameValid($firstName,$lastName) !== false){
        $dbc->close();
        header("location: ../WebClient/index.php?error=invalidName#register");
        exit();
    }
    if(usernameExists($dbc,$username)) {
        $dbc->close();
        header("location: ../WebClient/index.php?error=usernameTaken#register");
        exit();
    }

    createUser($dbc, $username, $password, $firstName, $lastName);

} else {
    header("location: ../WebClient/index.php#register");
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
    if(!preg_match(("/^[a-zA-Z \s]*$/"), $firstName) || !preg_match(("/^[a-zA-Z \s]*$/"), $lastName)){
        return true;
    } else {
        return false;
    }
}

function usernameExists($dbc,$username){
    $query = $dbc->real_escape_string($username);
    $sql = "SELECT * FROM users WHERE username ='".$query."'";
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
	$userType = "Member";

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
	$input = "'" . $userType . "', '" . $username . "', '" . $firstName . "', '" . $lastName . "', '" . $hashedPwd . "'";
    $sql = "INSERT INTO users (userType,username,userFName,userLName,userPwd) VALUES (" . $input . ")";
    mysqli_query($dbc,$sql);
	header("location: ../WebClient/index.php?error=none#register");


	exit();
}
?>