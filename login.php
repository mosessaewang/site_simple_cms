<?php
    session_start();
    include('connect_db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <style>
    /* ตั้งค่าพื้นฐาน */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Sarabun', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); /* ไล่เฉดสีพื้นหลังให้ดูมีมิติ */
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* กล่องคอนเทนเนอร์หลัก */
    .container {
        background: #fff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px; /* จำกัดความกว้างกล่อง Login */
    }

    .h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
        font-size: 24px;
        font-weight: bold;
    }

    /* จัดระเบียบ Form Group */
    form div {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #666;
        font-size: 14px;
    }

    /* ตกแต่งช่อง Input */
    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        outline: none;
        transition: 0.3s;
    }

    input:focus {
        border-color: #4481eb;
        box-shadow: 0 0 0 3px rgba(68, 129, 235, 0.1);
    }

    /* จัดการกลุ่มปุ่ม */
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

    /* ส่วนท้าย (สมัครสมาชิก) */
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
        <h2 class="h2">เข้าสู่ระบบ</h2>
        <form action="login_m.php" method="POST" autocomplete="off">
            <div>
                <label for="m_user">ชื่อเข้าใช้งาน :</label>
                <input type="text" name="m_user" id="m_user" placeholder="กรอกชื่อผู้ใช้" required>
            </div>
            <div>
                <label for="m_pass">รหัสผ่าน :</label>
                <input type="password" name="m_pass" id="m_pass" placeholder="กรอกรหัสผ่าน" required>
            </div>
            
            <div class="btn-group">
                <button type="submit">เข้าสู่ระบบ</button>
                <button type="reset">ยกเลิก</button>
            </div>

            <p>ยังไม่ได้สมัครสมาชิก? <a href="register.php">สมัครเลย</a></p>
        </form>
    </div>
</body>
</html>