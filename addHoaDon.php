<?php
require("dbConnect.php");
$date=getdate();
$KH_MaKH = $_POST["KH_MaKH"];
$TenNguoiDat = $_POST["TenNguoiDat"];
$TenNguoiNhan = $_POST["TenNguoiNhan"];
$SDT = $_POST["SDT"];
$DiaChi = $_POST["DiaChi"];
$NgayDat = date("Y-m-d");
$TrangThai = "Chờ xác nhận";

$query = "insert into HoaDon (HD_MaHD, HD_KH_MaKH, HD_TenNguoiDat, HD_TenNguoiNhan, HD_SDT, HD_DiaChi, HD_NgayDat, HD_TrangThai) values(null, '{$KH_MaKH}', '{$TenNguoiDat}', '{$TenNguoiNhan}', '{$SDT}', '{$DiaChi}', '{$NgayDat}', '{$TrangThai}')";

$data = $conn->query($query) or die($conn->error);
if($data){
    $idDonHang = $conn->insert_id;
    echo json_encode($idDonHang);
}

?>