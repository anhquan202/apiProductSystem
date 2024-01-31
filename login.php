<?php
    require 'dbConnect.php';
    if (isset($_POST['KH_Email']) && isset($_POST['KH_Password'])) {
        $email=$_POST['KH_Email'];
        $password=$_POST['KH_Password'];
        
        $checkUser="SELECT * FROM KhachHang WHERE KH_Email='$email' ";

        $result=mysqli_query($conn,$checkUser);
       
        if(mysqli_num_rows($result)>0){ 

            $checkUserquery="SELECT * FROM KhachHang WHERE KH_Email='$email' and KH_Password='$password'";
            $resultant=mysqli_query($conn,$checkUserquery);
            
            if(mysqli_num_rows($resultant)>0){

            while($row=$resultant->fetch_assoc())
                $response['user'] = $row;
                $response['error']="200";
                $response['message']="Login successfully";
            }else{
                $response['user']='';
                $response['error']="400";
                $response['message']="Wrong credentials";

            } 
            
        }else{
            $response['user']='';
            $response['error']="400";
            $response['message']="Your account is not exist!";
        }

        echo json_encode($response);
    }
?>
