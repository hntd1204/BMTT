<?php
header('Content-Type: application/json');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $otp = $input['otp'] ?? '';

    if (!isset($_SESSION['otp']) || $otp != $_SESSION['otp']) {
        echo json_encode([
            'success' => false,
            'message' => 'Mã OTP không hợp lệ hoặc đã hết hạn!',
        ]);
        exit;
    }

    unset($_SESSION['otp']);

    echo json_encode([
        'success' => true,
        'message' => 'Xác nhận OTP thành công!',
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Phương thức không được hỗ trợ!',
    ]);
}
