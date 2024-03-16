<?php
    require("dbConnect.php");
    
    $query = "select * from LoaiSP";
    $type = $conn->query($query) or die($conn->error);
    
?>