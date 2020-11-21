<?php
session_start();
    if(isset($_POST["submit"])){

        $userID = $_SESSION["userID"];
        $username = $_SESSION["username"];
        $userType = $_SESSION["userType"];
        $password = $_POST["password"];
        $firstName = $_POST["fname"];
        $lastName = $_POST["lname"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $gender = $_POST["gender"];
        $contact = $_POST["contact"];
        

        //Connect to database
        $local = 'localhost';
        $dbusername = 'X33896239';
        $dbpassword = 'X33896239';
        $dbname = 'X33896239';

        $dbc = mysqli_connect($local, $dbusername, $dbpassword, $dbname);

        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>Error number:" . mysqli_connect_errno());
        }

        if (isInputEmpty($password, $firstName, $lastName) !== false) {
            $dbc->close();
            header("location: ../WebClient/index.php?error=emptyInput#profile");
            exit();
        }

        if (isNameValid($firstName, $lastName) !== false) {
            $dbc->close();
            header("location: ../WebClient/index.php?error=invalidName#profile");
            exit();
        }

        if(isEmailInvalid($email) !== false) {
            $dbc->close();
            header("location: ../WebClient/index.php?error=invalidEmail#profile");
            exit();
        }

        if(isContactValid($contact) !== false){
            $dbc->close();
            header("location: ../WebClient/index.php?error=invalidContact#profile");
            exit();
        }

        if(isGenderValid($gender) !== false) {
            $dbc->close();
            header("location: ../WebClient/index.php?error=invalidGender#profile");
            exit();
        }

        updateProfile($dbc, $userID, $userType, $username, $password, $firstName, $lastName, $email, $address, $gender, $contact);


    } else {
    header("location: ../WebClient/index.php#profile");
    exit();
}

function isInputEmpty($password, $firstName, $lastName)
{
    if (empty($password) || empty($firstName) || empty($lastName)) {
        return true;
    } else {
        return false;
    }
}


function isNameValid($firstName, $lastName)
{
    if (!preg_match(("/^[a-zA-Z \s]*$/"), $firstName) || !preg_match(("/^[a-zA-Z \s]*$/"), $lastName)) {
        return true;
    } else {
        return false;
    }
}

function isEmailInvalid($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL) || $email == ""){
        return false;
    }
    return true;
}

function isContactValid($contact){
    if(is_numeric($contact) || $contact == ""){
        return false;
    }
    return true;
}

function isGenderValid($gender){
    if($gender == "Male" || $gender == "Female"){
        return true;
    }

    return false;
}

function updateProfile($dbc, $userID, $userType, $username, $password, $firstName, $lastName, $email, $address, $gender, $contact){
    $password = $dbc->real_escape_string($password);
    $firstName = $dbc->real_escape_string($firstName);
    $lastName = $dbc->real_escape_string($lastName);
    $email = $dbc->real_escape_string($email);
    $address = $dbc->real_escape_string($address);
    $gender = $dbc->real_escape_string($gender);
    $contact = $dbc->real_escape_string($contact);

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET userFName = '" . $firstName . "', userLName = '" . $lastName . "', userEmail = '" . $email . "', userAddress = '" . $address . "', userGender = '" . $gender . "', userContact = '" . $contact . "',  userPwd = '" . $hashedPwd . "' WHERE userID = '" . $userID . "'"; 
    mysqli_query($dbc,$sql);
    $_SESSION["userID"] = $userID;
    $_SESSION["userType"] = $userType;
    $_SESSION["username"] = $username;
    $_SESSION["userFName"] = $firstName;
    $_SESSION["userLName"] = $lastName;
    $_SESSION["userEmail"] = $email;
    $_SESSION["userAddress"] = $address;
    $_SESSION["userGender"] = $gender;
    $_SESSION["userContact"] = $contact;
    $_SESSION["userPwd"] = $password;
    $dbc->close();
    header("location: ../WebClient/index.php?error=none#profile");
    exit();

}


?>