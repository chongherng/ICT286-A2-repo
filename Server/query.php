<?php
$query = $_POST["query"];
queryProduct($query);


    function queryProduct($query)
    {
        $local = 'localhost';
        $username = 'X33896239';
        $password = 'X33896239';
        $dbname = 'X33896239';

        $dbc = mysqli_connect($local, $username, $password, $dbname);

        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>Error number:" . mysqli_connect_errno());
        }

        $sql = "SELECT * FROM product WHERE Description LIKE '$query'" ;
        $result = mysqli_query($dbc, $sql);
        $dataObjArr = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dataObj = (object) ['ID' => $row["ProductID"], 'Name' => $row["ProductName"], 'Description' => $row["Description"], 'Price' => "$" . $row["Price"], "ImgSrc" => $row["ImgSrc"]];
                array_push($dataObjArr, $dataObj);
            }
        } else {
            echo "Error: No result found";
        }

        $dataJSON = json_encode($dataObjArr);
        echo $dataJSON;
        $dbc->close();
    }

?>