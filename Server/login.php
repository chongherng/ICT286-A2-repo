<?php

    if(isset($_POST["submit"])) {

        $email = $_POST["email"];
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

        if (isInputEmpty($email, $password) !== false) {
            $dbc->close();
            header("location: ../Server/index.php#register?error=emptyInput");
            exit();
        }
        if (isEmailInvalid($email) !== false) {
            $dbc->close();
            header("location: ../Server/index.php#register?error=invalidEmail");
            exit();
        }

        loginUser($dbc, $email, $password); 

    } else{
        $dbc->close();
        header("location: ../Server/index.php#login");
        exit();
    }



function isInputEmpty($email, $password)
{
    if (empty($email) || empty($password)) {
        return true;
    } else {
        return false;
    }
}

function isEmailInvalid($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function emailExists($dbc, $email)
{
    $query = $dbc->real_escape_string($email);
    $sql = "SELECT * FROM users WHERE userEmail = $query";
    $result = mysqli_query($dbc, $sql);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function loginUser($dbc, $email, $password){
    $userExists = emailExists($dbc, $email);

    if($userExists === false) {
        $dbc->close();
        header("location: ../index.php#login?error=invalidLogin");
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
            $userType = $row["userType"];
            $_SESSION["userEmail"] = $row["userEmail"];
            $_SESSION["userFName"] = $row["userFName"];
            $_SESSION["userLName"] = $row["userLName"];
            $_SESSION["userAddress"] = $row["userAddress"];
            $_SESSION["userGender"] = $row["userGender"];
            $_SESSION["userContact"] = $row["userContact"];
            if($userType === "Member"){
                $dbc->close();
                header("location: ../Server/member.php");
                exit();
            } else if($userType === "Staff") {
                $dbc->close();
                header("location: ../Server/staff.php");
                exit();
            }
        }
    } else{
        $dbc->close();
        header("location: ../index.php#login?error=invalidLogin");
        exit();
    }
}
    
?>