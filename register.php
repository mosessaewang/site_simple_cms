<?php
    session_start();
    include('connect_db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครเข้าใช้</title>
    <style>
    /* ใช้สไตล์พื้นฐานเดียวกันกับหน้า Login */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Sarabun', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .container {
        background: #fff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 450px; /* กว้างกว่าหน้า Login เล็กน้อย */
    }

    .h {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
        font-size: 26px;
        font-weight: bold;
    }

    form div {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #555;
        font-size: 14px;
        font-weight: 600;
    }

    /* ตกแต่ง Input และ File Upload */
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="file"] {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        outline: none;
        transition: 0.3s;
    }

    /* พิเศษสำหรับ input file */
    input[type="file"] {
        padding: 8px;
        background: #f8f9fa;
        cursor: pointer;
    }

    input:focus {
        border-color: #4481eb;
        box-shadow: 0 0 0 3px rgba(68, 129, 235, 0.1);
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
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
        font-size: 16px;
    }

    button[type="submit"] {
        background: #4481eb;
        color: #fff;
    }

    button[type="submit"]:hover {
        background: #3367d6;
        transform: translateY(-2px);
    }

    button[type="reset"] {
        background: #f1f3f5;
        color: #666;
    }

    button[type="reset"]:hover {
        background: #e9ecef;
    }

    p {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #888;
    }

    p a {
        color: #4481eb;
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
        <h2 class="h">สมัครเข้าใช้งาน</h2>
        <form action="register_m.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div>
                <label for="m_user">ชื่อเข้าใช้งาน :</label>
                <input type="text" name="m_user" id="m_user" placeholder="ชื่อ-นามสกุล" required>
            </div>
            <div>
                <label for="m_email">อีเมล :</label>
                <input type="email" name="m_email" id="m_email" placeholder="gmail.com" required>
            </div>
            <div>
                <label for="m_pass">รหัสผ่าน :</label>
                <input type="password" name="m_pass" id="m_pass" placeholder="รหัสผ่าน" required>
            </div>
            <div>
                <label for="m_img">รูปโปรไฟล์ :</label>
                <input type="file" name="m_img" id="m_img" accept="image/*" required>
            </div>
            
            <div class="btn-group">
                <button type="submit">สมัครสมาชิก</button>
                <button type="reset">ยกเลิก</button>
            </div>
            
            <p>เป็นสมาชิกอยู่แล้ว? <a href="login.php">เข้าสู่ระบบ</a></p>
        </form>
    </div>
</body>
</html>