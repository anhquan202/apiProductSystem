<?php
    require("dbConnect.php");
    $query = "select * from SanPham";
    $data = $conn->query($query) or die($conn->error);
 
?>