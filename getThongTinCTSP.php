<?php
    require("dbConnect.php");
    
    $maSP = $_GET["SP_MaSP"];
    $query = "select * from CTSanPham where CTSP_SP_MaSP = {$maSP}";
    $data = $conn->query($query) or die($conn->error);
    if($data->num_rows == 0){
        echo "Khong co du lieu";
    }
    else{
        while($row = $data->fetch_assoc()){
            $thongTinCTSP = new CTSanPham(
                $row["CTSP_MauSac"],
                $row["CTSP_ManHinh"],
                $row["CTSP_Camera"],
                $row["CTSP_HDH"],
                $row["CTSP_RAM"],
                $row["CTSP_TGianTaiNghe"],
                $row["CTSP_TGianHopSac"],
                $row["CTSP_MoTa"],
            );
        }
        echo json_encode($thongTinCTSP);
    }
    
    class CTSanPham{
        function __construct($MauSac, $ManHinh, $Camera, $HDH, $RAM, $TgTaiNghe, $TgHopSac, $MoTa){
            $this->MauSac = $MauSac;
            $this->ManHinh = $ManHinh;
            $this->Camera = $Camera;
            $this->HDH = $HDH;
            $this->RAM = $RAM;
            $this->TgTaiNghe = $TgTaiNghe;
            $this->TgHopSac = $TgHopSac;
            $this->MoTa = $MoTa;
        }
    }
?>