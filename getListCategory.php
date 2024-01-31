<?php
    require("dbConnect.php");
    $mangCategory = array();
    
    $query = "select * from LoaiSP";
    $data = $conn->query($query) or die($conn->error);
    if($data->num_rows == 0){
        echo json_encode($mangCategory);
    }
    else{
        while($row = $data->fetch_assoc()){
            array_push($mangCategory, new Category(
                $row["LSP_MaLoai"],
                $row["LSP_TenLoai"],
                $row["LSP_AnhLoai"]));
        }
        echo json_encode($mangCategory);
    }
    
    class Category{
        function __construct($id, $tenLoaiSP, $anhLoaiSP){
            $this->id = $id;
            $this->tenLoaiSP = $tenLoaiSP;
            $this->anhLoaiSP = $anhLoaiSP;
        }
    }
?>