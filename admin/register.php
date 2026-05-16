<?php
    session_start();
    include('connect_db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าสมัคร</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Sarabun', sans-serif;
    }

    body {
        /* ใช้ Gradient โทนเดียวกับ Login Admin เพื่อความต่อเนื่อง */
        background: #1a2a6c; 
        background: linear-gradient(to right, #b21f1f, #fdbb2d, #1a2a6c);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .container {
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
        width: 100%;
        max-width: 450px;
    }

    .h {
        text-align: center;
        margin-bottom: 25px;
        color: #1a2a6c;
        font-size: 26px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    form div {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-size: 14px;
        font-weight: 600;
    }

    /* ตกแต่ง Input ต่างๆ */
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="file"] {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #eee;
        border-radius: 6px;
        outline: none;
        transition: 0.3s;
    }

    input[type="file"] {
        background: #f8f9fa;
        padding: 8px;
        font-size: 13px;
    }

    input:focus {
        border-color: #1a2a6c;
    }

    /* กลุ่มปุ่มกด */
    .btn-group {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    button {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        font-size: 15px;
        transition: 0.3s;
    }

    button[type="submit"] {
        background: #1a2a6c;
        color: #fff;
    }

    button[type="submit"]:hover {
        background: #0d1536;
        transform: translateY(-2px);
    }

    button[type="reset"] {
        background: #f8f9fa;
        color: #333;
        border: 1px solid #ddd;
    }

    button[type="reset"]:hover {
        background: #e9ecef;
    }

    p {
        text-align: center;
        margin-top: 20px;
        font-size: 13px;
        color: #777;
    }

    p a {
        color: #b21f1f;
        text-decoration: none;
        font-weight: bold;
    }

    p a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
    <div class="container">
        <h2 class="h">Admin Registration</h2>
        <form action="register_a.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div>
                <label for="a_name">ชื่อเข้าใช้งาน (Admin) :</label>
                <input type="text" name="a_name" id="a_name" placeholder="ระบุชื่อผู้ใช้งาน" required>
            </div>
            <div>
                <label for="a_email">อีเมลแอดมิน :</label>
                <input type="email" name="a_email" id="a_email" placeholder="admin@example.com" required>
            </div>
            <div>
                <label for="a_pass">รหัสผ่าน :</label>
                <input type="password" name="a_pass" id="a_pass" placeholder="กำหนดรหัสผ่าน" required>
            </div>
            <div>
                <label for="a_img">รูปภาพโปรไฟล์ :</label>
                <input type="file" name="a_img" id="a_img" accept="image/*" required>
            </div>
            
            <div class="btn-group">
                <button type="submit">สมัครสมาชิก</button>
                <button type="reset">ยกเลิก</button>
            </div>
            
            <p>มีบัญชีแอดมินอยู่แล้ว? <a href="login.php">Sign Login</a></p>
        </form>
    </div>
</body>
</html>