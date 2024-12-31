// Gửi yêu cầu OTP
document.getElementById("sendOtpButton").addEventListener("click", () => {
    const phone = document.getElementById("phone").value;

    if (!phone) {
        alert("Vui lòng nhập số điện thoại!");
        return;
    }

    // Gửi yêu cầu gửi OTP tới loginzalo.php
    fetch('loginzalo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ phone }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert(data.message);
                console.log("OTP (dev mode):", data.otp); // Hiển thị OTP trong môi trường phát triển

                // Hiển thị biểu mẫu nhập OTP
                document.getElementById("loginForm").style.display = "none";
                document.getElementById("otpForm").style.display = "block";
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error("Lỗi:", error);
        });
});

// Xác nhận OTP
document.getElementById("verifyOtpButton").addEventListener("click", () => {
    const otp = document.getElementById("otp").value;

    if (!otp) {
        alert("Vui lòng nhập mã OTP!");
        return;
    }

    // Gửi yêu cầu xác nhận OTP tới verifyzalo.php
    fetch('verifyzalo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ otp }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert(data.message);
                // Chuyển hướng sang index.html
                window.location.href = 'index.html';
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error("Lỗi:", error);
        });
});
