<?php
    require("dbConnect.php");
    $mangsp = array();
    $KH_MaKH = $_GET['KH_MaKH'];
    $query = "select SP_AnhSP, SP_TenSP, SP_GiaSP, CTHD_SoLuong, HD_TrangThai 
            from HoaDon inner join CTHoaDon on HD_MaHD = CTHD_HD_MaHD inner join SanPham on CTHD_SP_MaSP = SP_MaSP 
            where HD_KH_MaKH = {$KH_MaKH}";
    
    $data = $conn->query($query) or die($conn->error);
    if($data->num_rows == 0){
        echo json_encode($mangsp);
    }
    else{
        while($row = $data->fetch_assoc()){
            array_push($mangsp, new SanPham(
                $row["SP_TenSP"],
                $row["SP_GiaSP"],
                $row["SP_AnhSP"],
                $row["CTHD_SoLuong"],
                $row["HD_TrangThai"]));
        }
        echo json_encode($mangsp);
    }
    
    class SanPham{
        function __construct($tensp, $giasp, $anhsp, $soluong, $trangthai){
            $this->tensp = $tensp;
            $this->giasp = $giasp;
            $this->anhsp = $anhsp;
            $this->soluong = $soluong;
            $this->trangthai = $trangthai;
        }
    }
?>