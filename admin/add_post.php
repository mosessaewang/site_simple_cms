<?php
    session_start();
    include('connect_db.php');
    $a_id = $_SESSION['a_id'];
    $p_id = $_SESSION['p_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มบทความ</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&family=Kanit:wght@400;500&display=swap');

        body {
        font-family: 'Sarabun', sans-serif;
        background-color: #f4f7f6;
        margin: 0;
        padding: 40px 20px;
        }

        .container {
        max-width: 800px; /* กว้างกว่าหน้าหมวดหมู่หน่อยเพื่อให้พิมพ์เนื้อหาได้สะดวก */
        margin: 0 auto;
        }

        .card {
        background: #fff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        h2 {
        font-family: 'Kanit', sans-serif;
        color: #333;
        margin-bottom: 30px;
        text-align: center;
        font-size: 26px;
        }

        /* การจัดวาง Form Group */
        .form-group {
        margin-bottom: 20px;
        }

        label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #444;
        }

        /* ตกแต่ง Input, Select และ Textarea */
        input[type="text"],
        select,
        textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        box-sizing: border-box;
        font-family: 'Sarabun', sans-serif;
        transition: 0.3s;
        }

        textarea {
        height: 200px; /* ความสูงเริ่มต้นของเนื้อหา */
        resize: vertical; /* ให้ Admin ปรับความสูงเองได้แค่แนวตั้ง */
        }

        input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: #4e73df;
        box-shadow: 0 0 8px rgba(78, 115, 223, 0.2);
        }

        /* ตกแต่งปุ่มกด */
        .button-group {
        display: flex;
        gap: 12px;
        margin-top: 30px;
        border-top: 1px solid #eee;
        padding-top: 25px;
        }

        .btn {
        padding: 10px 25px;
        border: none;
        border-radius: 6px;
        font-family: 'Kanit', sans-serif;
        font-size: 16px;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
        text-align: center;
        }

        .btn-submit {
        background-color: #4e73df;
        color: white;
        flex: 2; /* ให้ปุ่มส่งมีขนาดใหญ่กว่าเพื่อน */
        }

        .btn-submit:hover {
        background-color: #2e59d9;
        }

        .btn-reset {
        background-color: #eaecf4;
        color: #5a5c69;
        flex: 1;
        }

        .btn-back {
        background-color: #858796;
        color: white;
        flex: 1;
        }

        .btn-back:hover {
        background-color: #6e707e;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="card">
        <h2><i class="fas fa-plus-circle"></i> เขียนบทความใหม่</h2>
        
        <form action="add_post_p.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="p_title">หัวข้อเรื่อง :</label>
                <input type="text" name="p_title" id="p_title" placeholder="พิมพ์หัวข้อบทความ..." required>
            </div>

            <div class="form-group">
                <label for="p_content">เนื้อหาบทความ :</label>
                <textarea name="p_content" id="p_content" placeholder="เขียนรายละเอียดเนื้อหาที่นี่..." required></textarea>
            </div>

            <div class="form-group">
                <label for="c_id">เลือกหมวดหมู่ :</label>
                <select name="c_id" id="c_id" required>
                    <option value="">== เลือกหมวดหมู่ ==</option>
                    <?php
                        $sql = "SELECT * FROM tb_category";
                        $rs = $conn->query($sql);
                        while($r = $rs->fetch_object()) {
                            echo "<option value='$r->c_id'>$r->c_name</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="p_img">รูปภาพประกอบ :</label>
                <input type="file" name="p_img" id="p_img" accept="image/*" required>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-submit">บันทึกบทความ</button>
                <button type="reset" class="btn btn-reset">ล้างข้อมูล</button>
                <a href="post.php" class="btn btn-back">ย้อนกลับ</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>