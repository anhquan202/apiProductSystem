<?php
    require("dbConnect.php");
    $mangsp = array();
    $tensp = $_GET["tensp"];
    $page = $_GET["page"];
    $limit = 10;
    $offset = ($page - 1)*$limit;
    $query = "select * from SanPham where SP_TenSP like N'%{$tensp}%' limit {$offset},{$limit}";
    $data = $conn->query($query) or die($conn->error);
    if($data->num_rows == 0){
        echo json_encode($mangsp);
    }
    else{
        while($row = $data->fetch_assoc()){
            array_push($mangsp, new SanPham(
                $row["SP_MaSP"],
                $row["SP_TenSP"],
                $row["SP_GiaSP"],
                $row["SP_AnhSP"],
                $row["SP_SoLuong"]));
        }
        echo json_encode($mangsp);
    }
    
    class SanPham{
        function __construct($pid, $tensp, $giasp, $anhsp, $soluong){
            $this->id = $pid;
            $this->tensp = $tensp;
            $this->giasp = $giasp;
            $this->anhsp = $anhsp;
            $this->soluong = $soluong;
        }
    }
?>