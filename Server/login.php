<?php

    if(isset($_POST["submit"])) {

        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $local = 'localhost';
        $username = 'X33896239';
        $password = 'X33896239';
        $dbname = 'X33896239';
    
        $dbc = mysqli_connect($local, $username, $password, $dbname);
    
        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>Error number:" . mysqli_connect_errno());
        } else {
            echo "Error: No result found";
        }

        if (isInputEmpty($username, $password) !== false) {
            $dbc->close();
            header("location: ../Server/index.php#register?error=emptyInput");
            exit();
        }
        if (isUsernameInvalid($username) !== false) {
            $dbc->close();
            header("location: ../Server/index.php#register?error=invalidUsername");
            exit();
        }

        loginUser($dbc, $username, $password); 

    } else{
        $dbc->close();
        header("location: ../Server/index.php#login");
        exit();
    }



function isInputEmpty($username, $password)
{
    if (empty($username) || empty($password)) {
        return true;
    } else {
        return false;
    }
}

function isUsernameInvalid($username)
{
    if (!preg_match(("/^[a-zA-Z0-9]*$/"), $username)) {
        return true;
    } else {
        return false;
    }
}

function usernameExists($dbc, $username)
{
    $query = $dbc->real_escape_string($username);
    $sql = "SELECT * FROM users WHERE username = $query";
    $result = mysqli_query($dbc, $sql);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function loginUser($dbc, $username, $password){
    $userExists = usernameExists($dbc, $username);

    if($userExists === false) {
        $dbc->close();
        header("location: ../Server/index.php#login?error=invalidLogin");
        exit();
    }

    $password = $dbc->real_escape_string($password);
    $query = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM users WHERE userPwd = $query";
    $result = mysqli_query($dbc,$sql);
    if($result->num_rows > 0) {
        session_start();
        while($row = $result->fetch_assoc()) {
            $_SESSION["userID"] = $row["userID"];         
            $_SESSION["userType"] = $row["userType"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["userFName"] = $row["userFName"];
            $_SESSION["userLName"] = $row["userLName"];
            $_SESSION["userEmail"] = $row["userEmail"];
            $_SESSION["userAddress"] = $row["userAddress"];
            $_SESSION["userGender"] = $row["userGender"];
            $_SESSION["userContact"] = $row["userContact"];
            $dbc->close();
            header("location: ../Server/index.php");
            exit();
        }
    } else{
        $dbc->close();
        header("location: ../Server/index.php#login?error=invalidLogin");
        exit();
    }
}
    
?>