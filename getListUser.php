<?php
require("dbConnect.php");
$mangsp = array();

$query = "select * from KhachHang";
$data = $conn->query($query) or die($conn->error);
if($data->num_rows == 0){
    echo "Khong co du lieu";
}
else{
    while($row = $data->fetch_assoc()){
        array_push($mangsp, new SanPham(
            $row["KH_MaKH"],
            $row["KH_HoTen"],
            $row["KH_SDT"],
            $row["KH_GioiTinh"],
            $row["KH_Email"],
            $row["KH_Password"]));
    }
    echo json_encode($mangsp);
}

class SanPham{
    function __construct($pid, $username, $phone, $gender, $email, $password){
        $this->id = $pid;
        $this->username = $username;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->email = $email;
        $this->password = $password;
    }
}

?>