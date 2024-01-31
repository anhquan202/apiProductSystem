<?php
    require("dbConnect.php");
    
    $email = $_GET["KH_Email"];
    $query = "select * from Khachhang where KH_Email = '{$email}'";
    $data = $conn->query($query) or die($conn->error);
    if($data->num_rows == 0){
        echo "Khong co du lieu";
    }
    else{
        while($row = $data->fetch_assoc()){
            $thongTinKH = new KhachHang(
                $row["KH_MaKH"],
                $row["KH_HoTen"],
                $row["KH_SDT"],
                $row["KH_GioiTinh"],
                $row["KH_Email"],
                $row["KH_Password"]
            );
        }
        echo json_encode($thongTinKH);
    }
    
    class KhachHang{
        function __construct($MaKH, $HoTen, $SDT, $GioiTinh, $Email, $Password){
            $this->KH_MaKH = $MaKH;
            $this->KH_HoTen = $HoTen;
            $this->KH_SDT = $SDT;
            $this->KH_GioiTinh = $GioiTinh;
            $this->KH_Email = $Email;
            $this->KH_Password = $Password;
        }
    }
?>