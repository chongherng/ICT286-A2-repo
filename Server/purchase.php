<?php
    $productID = $_POST["itemID"];
    $productQty = $_POST["itemQty"];
    $productSize = $_POST["itemSize"];
    
    if(validateData($productQty,$productSize)){
        $local = "localhost";
        $dbusername = "X33896239";
        $dbpassword = "X33896239";
        $dbname = "X33896239";
        $dbc = mysqli_connect($local,$dbusername,$dbpassword,$dbname);

        
        if(mysqli_connect_errno()) {
            die("Failed to connect to MySQL: ". mysqli_connect_error() . "<br/>Error number:" . mysqli_connect_errno());
        }
        
        for($i = 0; $i < count($productID); $i ++) {
            $dbProductSize = getSize($productSize[$i]);
            $productID[$i] = $dbc->real_escape_string($productID[$i]);
            $productQty[$i] = $dbc->real_escape_string($productQty[$i]);
            $dbProductSize = $dbc->real_escape_string($dbProductSize);

            $sql = "SELECT * FROM product WHERE ProductID = '" . $productID[$i] . "'";
            $result = mysqli_query($dbc,$sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    if($dbProductSize == "StockXS"){
                        $numberOfSize = $row['StockXS'];
                    }
                    if($dbProductSize == "StockS"){
                        $numberOfSize = $row['StockS'];
                    }
                    if($dbProductSize == "StockM"){
                        $numberOfSize = $row['StockM'];
                    }
                    if($dbProductSize == "StockL"){
                        $numberOfSize = $row['StockL'];
                    }
                    if($dbProductSize == "StockXL"){
                        $numberOfSize = $row['StockXL'];
                    }
                }
                if($numberOfSize >= $productQty[$i]) {
                    $numberOfSizeLeft = $numberOfSize - $productQty[$i];
                    $sql = "UPDATE product SET " . $dbProductSize . " = '" . $numberOfSizeLeft . "' WHERE ProductID = '" . $productID[$i] . "'";
                    mysqli_query($dbc,$sql);
                } else{
                    echo"Not Enough Stock";
                    exit();
                }
            } else{
                echo "0 results";
            }
        }
        $total = getTotal($productQty,$productID,$dbc);
        echo "</p>You have successfully made the purchase.</p>";
        echo "</p>Total Price is: $" . number_format($total, 2) . "</p>";
        $dbc->close();

    }

    function getTotal($productQty,$productID,$dbc){
        $total = 0;
        for($i = 0; $i < count($productID); $i++){
            $sql = "SELECT Price FROM product WHERE ProductID = '" . $productID[$i] . "'";
            $result = mysqli_query($dbc,$sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $price = $row["Price"];
                    $total += $price * $productQty[$i];
                }
            }
        }
        return $total;
    }


    function validateData($productQty,$productSize){
        for($i = 0; $i < count($productQty);$i++){
            if($productQty[$i] <= 0 || is_nan($productQty[$i])) {
                echo "Invalid Product Quantity";
                return false;
            }
            if($productSize[$i] == "XS" || $productSize[$i] == "S" || $productSize[$i] == "M" || $productSize[$i] == "L" || $productSize[$i] == "XL"){
                return true;
            } else {
                echo "Invalid Product Size";
            }
        }  

        return true;

    }

    function getSize($productSize){
            if($productSize == "XS"){
                return "StockXS";
            }
            if($productSize == "S"){
                return "StockS";
            }
            if($productSize == "M"){
                return "StockM";
            }
            if($productSize == "L"){
                return "StockL";
            }
            if($productSize == "XL"){
                return "StockXL";
            }
    }


?>