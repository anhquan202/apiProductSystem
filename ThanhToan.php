<?php
    require("dbConnect.php");
    $MaHD = $_POST["MaHD"];
    $GioHang = $_POST["MangGioHang"];
    $data = json_decode($GioHang, true);
    foreach($data as $value){
        $MaSP = $value['id'];
        $TenSP = $value['tensp'];
        $SoLuong = $value['soluong'];
        $Gia = $value['giasp'];
        $query = "insert into CTHoaDon (CTHD_MaCTHD, CTHD_HD_MaHD, CTHD_SP_MaSP, CTHD_TenSP, CTHD_SoLuong, CTHD_Gia)
                values(null, {$MaHD}, {$MaSP}, '{$TenSP}', '{$SoLuong}', '{$Gia}')";
        $dt = $conn->query($query) or die($conn->error);
        if($dt){
            $query1 = "select SP_SoLuong from SanPham where SP_MaSP = {$value['id']}";
            $rs = $conn->query($query1) or die($conn->error);
            if($rs->num_rows == 0){
                echo "Khong co du lieu";
            }
            else{
                while($row = $rs->fetch_assoc()){
                    $sl = $row["SP_SoLuong"];
                }
            }
            $SoLuongSPConLai = $sl - $value["soluong"];
            $updateSLSanPham = $conn->query("update SanPham set SP_SoLuong = {$SoLuongSPConLai} where SP_MaSP = {$value['id']}");
        }
        
    }
    if($updateSLSanPham){
        echo json_encode("Thanh toán hóa đơn thành công");
    }else{
        echo json_encode("Thanh toán hóa đơn không thành công");
    }
?>
