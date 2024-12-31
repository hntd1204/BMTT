<?php
header('Content-Type: application/json');
session_start();

function isValidPhoneNumber($phone)
{
    // Kiểm tra định dạng số điện thoại Việt Nam (bắt đầu với 0 và có 10 chữ số)
    return preg_match('/^0[3|5|7|8|9][0-9]{8}$/', $phone);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $phone = $input['phone'] ?? '';

    if (!isValidPhoneNumber($phone)) {
        echo json_encode([
            'success' => false,
            'message' => 'Số điện thoại không đúng định dạng!'
        ]);
        exit;
    }

    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    error_log("OTP gửi tới số điện thoại $phone: $otp");

    echo json_encode([
        'success' => true,
        'message' => 'OTP đã được gửi tới số điện thoại của bạn!',
        'otp' => $otp
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Phương thức không được hỗ trợ!'
    ]);
}
