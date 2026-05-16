<?php
    session_start();
    include('connect_db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าล็อกอิน</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Sarabun', sans-serif;
    }

    body {
        /* ใช้สีโทนเข้มขึ้นเพื่อให้ความรู้สึกถึงส่วนจัดการระบบ (Admin Panel) */
        background: #1a2a6c; 
        background: linear-gradient(to right, #b21f1f, #fdbb2d, #1a2a6c);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .container {
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        width: 100%;
        max-width: 380px;
    }

    .h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #1a2a6c;
        font-size: 26px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    form div {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-size: 14px;
        font-weight: 600;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #eee;
        border-radius: 6px;
        outline: none;
        transition: 0.3s;
    }

    input:focus {
        border-color: #1a2a6c; /* เปลี่ยนเป็นสีเข้มเวลาเลือก */
    }

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
        color: #b21f1f; /* สีแดงเข้มเพื่อให้ดูแตกต่าง */
        text-decoration: none;
        font-weight: bold;
    }
</style>
</head>
<body>
    <div class="container">
        <h2 class="h2">Admin Login</h2>
        <form action="login_a.php" method="POST" autocomplete="off">
            <div>
                <label for="a_name">ชื่อผู้ดูแลระบบ (Admin) :</label>
                <input type="text" name="a_name" id="a_name" placeholder="ระบุชื่อผู้ใช้งาน" required>
            </div>
            <div>
                <label for="a_pass">รหัสผ่าน :</label>
                <input type="password" name="a_pass" id="a_pass" placeholder="ระบุรหัสผ่าน" required>
            </div>
            
            <div class="btn-group">
                <button type="submit">เข้าสู่ระบบ</button>
                <button type="reset">ยกเลิก</button>
            </div>
            
            <p>กลับหน้าหลักสำหรับสมาชิก <a href="register.php">Sing register</a></p>
        </form>
    </div>
</body>
</html>