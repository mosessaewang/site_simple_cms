<?php
    session_start();
    include('connect_db.php');
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มหมวดหมู่ | SMP-CMS</title>
    <style>
            body {
        font-family: 'Sarabun', sans-serif;
        background-color: #f4f7f6;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* จัดให้อยู่กึ่งกลางหน้าจอแนวตั้ง */
    }

    .container {
        width: 100%;
        max-width: 400px; /* ขนาดกะทัดรัด */
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    h2 {
        font-family: 'Kanit', sans-serif;
        color: #333;
        margin-top: 0;
        margin-bottom: 20px;
        text-align: center;
        font-size: 22px;
    }

    /* ตกแต่งฟอร์ม */
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
        font-size: 14px;
    }

    input[type="text"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        box-sizing: border-box; /* กัน input ล้นขอบ */
        transition: 0.3s;
        font-family: 'Sarabun', sans-serif;
    }

    input[type="text"]:focus {
        outline: none;
        border-color: #4e73df;
        box-shadow: 0 0 8px rgba(78, 115, 223, 0.2);
    }

    /* ส่วนของปุ่มกด */
    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .btn {
        flex: 1; /* ให้ปุ่มขยายเท่ากัน */
        padding: 10px;
        border: none;
        border-radius: 6px;
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
        cursor: pointer;
        transition: 0.2s;
        text-align: center;
        text-decoration: none;
    }

    .btn-submit {
        background-color: #4e73df;
        color: white;
    }

    .btn-submit:hover {
        background-color: #2e59d9;
    }

    .btn-reset {
        background-color: #f8f9fc;
        color: #5a5c69;
        border: 1px solid #d1d3e2;
    }

    .btn-reset:hover {
        background-color: #eaecf4;
    }

    .btn-back {
        background-color: #858796;
        color: white !important;
    }

    .btn-back:hover {
        background-color: #6e707e;
    }

    /* ล้างสไตล์เริ่มต้นของ <a> ในปุ่มย้อนกลับ */
    .btn-back a {
        color: inherit;
        text-decoration: none;
        display: block;
    }
    </style>
</head>
<body>
    <div class="container">
        <h2>เพิ่มหมวดหมู่ใหม่</h2>
        <form action="add_category_c.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div>
                <label for="c_name">ชื่อหมวดหมู่</label>
                <input type="text" name="c_name" id="c_name" placeholder="ระบุชื่อหมวดหมู่ที่นี่..." required>
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn btn-submit">บันทึก</button>
                <button type="reset" class="btn btn-reset">ล้างค่า</button>
                <a href="category.php" class="btn btn-back">ย้อนกลับ</a>
            </div>
        </form>
    </div>
</body>
</html>