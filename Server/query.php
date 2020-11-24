<?php

    $query = $_POST["search"];
    queryProduct($query);
    
    function queryProduct($query)
    {
        $local = 'localhost';
        $dbusername = 'X33896239';
        $dbpassword = 'X33896239';
        $dbname = 'X33896239';

        $dbc = mysqli_connect($local, $dbusername, $dbpassword, $dbname);

        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error() . "<br/>Error number:" . mysqli_connect_errno());
        }
        $query = $dbc->real_escape_string($query);
        $sql = "SELECT * FROM product WHERE UPPER(ProductName) LIKE UPPER('%" . $query . "%') OR UPPER(Material) LIKE UPPER('%" . $query . "%') OR UPPER(Color) LIKE UPPER('%" . $query . "%')" ;
        $result = mysqli_query($dbc, $sql);
        $dataObjArr = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dataObj = (object) ['ID' => $row["ProductID"], 'Name' => $row["ProductName"], 'Type' => $row["Type"], 'Material' => $row["Material"], 'Color' => $row["Color"], 'Price' => $row["Price"], 'StockXS' => $row["StockXS"], 'StockS' => $row["StockS"], 'StockM' => $row["StockM"], 'StockL' => $row["StockL"], 'StockXL' => $row["StockXL"], 'ImgSrc' => $row["ImgSrc"]];
                array_push($dataObjArr, $dataObj);
            }
            $dataJSON = json_encode($dataObjArr);
            echo $dataJSON;
            $dbc->close();
        } else {
            echo "No Result Found";
        }

    }

?>