<?php
    require("dbConnect.php");
    $mangsp = array();
    $maLoai = $_GET["LSP_MaLoai"];
    $query = "select * from SanPham where SP_LSP_MaLoai = {$maLoai}";
    $data = $conn->query($query) or die($conn->error);
    
?>