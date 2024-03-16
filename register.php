<?php
require 'dbConnect.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $checkUser = "SELECT KH_HoTen from KhachHang WHERE KH_Email='$email'";
    $checkQuery = mysqli_query($conn, $checkUser);
    if (empty($password)) {
        $errMessage = "Vui lòng nhập mật khẩu";
        $_SESSION['password_err'] = $errMessage;
        header("Location: ../frontend/register.php");

    }
    if (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$/", $username)) {
        $name_err = "Username is only characters and spaces are allowed";
        $_SESSION['name_err'] = $name_err;
        header("Location: ../frontend/register.php");
    }
    if (!preg_match("/(84|0[3|5|7|8|9])+([0-9]{8})\b/", $phone)) {
        $phone_err = "Numberphone format is belong to VietNam";
        $_SESSION['phone_err'] = $phone_err;
        header("Location: ../frontend/register.php");


    } if (filter_var($email, FILTER_VALIDATE_EMAIL) === false || empty($email)) {
        $_SESSION['email_err'] = 'Email is incorrect format';
        header("Location: ../frontend/register.php");

    } else {
        if (mysqli_num_rows($checkQuery) > 0) {
            $_SESSION['error'] = 'User exist';
            header("Location: ../frontend/register.php");

        } else {
            $insertQuery = "INSERT INTO KhachHang(KH_HoTen, KH_SDT, KH_GioiTinh, KH_Email, KH_Password) 
                                VALUES('$username','$phone','$gender', '$email', '$password')";
            $result = mysqli_query($conn, $insertQuery);

            if ($result) {
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;
                header("Location: ../frontend/index.php");
                exit();
            } else {
                $_SESSION['error'] = 'Registeration failed!';
                header("Location: ../frontend/register.php");
                exit();
            }
        }
    }
}
?>