<?php

getProduct();

    function getProduct() {
        $local = 'localhost';
        $username = 'X33896239';
        $password = 'X33896239';
        $dbname = 'X33896239';

        $dbc = mysqli_connect($local, $username, $password, $dbname);

        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>Error number:" . mysqli_connect_errno());
        }

        $sql = "SELECT * FROM product";
        $result = mysqli_query($dbc, $sql);
        $dataObjArr = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dataObj = (object) ['ID' => $row["ProductID"], 'Name' => $row["ProductName"], 'Type' => $row["Type"],'Material' => $row["Material"], 'Color' => $row["Color"], 'Price' => '$' . $row["Price"], 'StockXS' => ["StockXS"], 'StockS' => ["StockS"],'StockM' => ["StockM"], 'StockL' => ["StockL"], 'StockXL' => ["StockXL"],'ImgSrc' => ["ImgSrc"]];
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