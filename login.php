<?php
require 'dbConnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // Xử lý trường hợp người dùng không nhập dữ liệu
    if (empty($email) || empty($password)) {
        $errMessage = "Vui lòng nhập email và mật khẩu";
        $_SESSION['error'] = $errMessage;
        header("Location: ../frontend/login.php");
        exit();
    }

    // Sử dụng Prepared Statements để tránh SQL Injection
    $stmt = $conn->prepare("SELECT KH_HoTen FROM KhachHang WHERE KH_Email=? AND KH_Password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $row['KH_HoTen'];
        header("Location: ../frontend/index.php");
        exit();
    } else {
        // Sai thông tin đăng nhập
        $errMessage = "Thông tin đăng nhập không chính xác";
        $_SESSION['error'] = $errMessage;
        header("Location: ../frontend/login.php");
        exit();
    }
}
?>