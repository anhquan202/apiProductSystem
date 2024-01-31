<?php
    require 'dbConnect.php';
    if (isset($_POST['KH_Email'])) {
        $username=$_POST['KH_HoTen'];
        $phone=$_POST['KH_SDT'];
        $gender=$_POST['KH_GioiTinh'];
        $email=$_POST['KH_Email'];
        $password=$_POST['KH_Password'];
        
        $checkUser="SELECT * from KhachHang WHERE KH_Email='$email'";
        $checkQuery=mysqli_query($conn,$checkUser);
        // if (filter_var($email,FILTER_VALIDATE_EMAIL)===false) {
        //     $response['error']="403";
        //     $response['message']="Email is incorrect format";
        //}
        if (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$/", $username)) {
            // $name_err = "Username is only characters and spaces are allowed";
            $response['error']="403";
            $response['message']="Username is only characters and spaces are allowed";
        }
        else if (!preg_match("/(84|0[3|5|7|8|9])+([0-9]{8})\b/", $phone)) {
            // $phone_err = "Numberphone format is belong to VietNam";
            $response['message']="Numberphone format is belong to VietNam";

        }else if (filter_var($email,FILTER_VALIDATE_EMAIL)===false) {
            $response['error']="403";
            $response['message']="Email is incorrect format";
        }
        else{
            if(mysqli_num_rows($checkQuery)>0){
                $response['error']="403";
                $response['message']="User exist";
            }else{
                $insertQuery="INSERT INTO KhachHang(KH_HoTen, KH_SDT, KH_GioiTinh, KH_Email, KH_Password) 
                                VALUES('$username','$phone','$gender', '$email', '$password')";
                $result=mysqli_query($conn,$insertQuery);
                
                if($result){
                    $response['error']="200";
                    $response['message']="Register successful!";
                }else{
                    $response['error']="400";
                    $response['message']="Registeration failed!";
                }
            }
        }
        echo json_encode($response);
    }
    

  
?>