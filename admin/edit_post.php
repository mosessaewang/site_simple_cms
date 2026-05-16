<?php
    session_start();
    include('connect_db.php');
    $a_id = $_SESSION['a_id'];
    $p_id = $_GET['p_id'];

    if(!isset($_GET['p_id'])){
        echo "ไม่พบรหัสโพสต์";
        exit;
    }

        $sql = "SELECT tb_post.*, tb_category.c_name
                FROM tb_post
                INNER JOIN tb_category ON tb_post.c_id  = tb_category.c_id
                WHERE tb_post.p_id = '$p_id'";
        $rs = $conn->query($sql);
        $r = $rs->fetch_object();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขโพสต์ | SMP-CMS</title>
    <style>

        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
        }

        h2 {
            font-family: 'Kanit', sans-serif;
            color: #333;
            margin-top: 0;
            margin-bottom: 25px;
            border-left: 5px solid #4e73df;
            padding-left: 15px;
        }

        /* การจัดวาง Form */
        form div {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }

        /* ตกแต่ง Input และ Select */
        input[type="text"], 
        select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            box-sizing: border-box; /* สำคัญ: เพื่อให้ padding ไม่ทำให้ input ล้น */
            transition: border-color 0.3s, box-shadow 0.3s;
            font-family: 'Sarabun', sans-serif;
        }

        input[type="text"]:focus, 
        select:focus {
            outline: none;
            border-color: #4e73df;
            box-shadow: 0 0 8px rgba(78, 115, 223, 0.2);
        }

        /* ปุ่มกด */
        button {
            cursor: pointer;
            padding: 10px 25px;
            border-radius: 6px;
            font-weight: 600;
            font-family: 'Kanit', sans-serif;
            font-size: 15px;
            border: none;
            transition: 0.2s;
        }

        button[type="submit"] {
            background-color: #4e73df;
            color: white;
        }

        button[type="submit"]:hover {
            background-color: #2e59d9;
        }

        button[type="reset"] {
            background-color: #f8f9fc;
            color: #5a5c69;
            border: 1px solid #d1d3e2;
            margin-left: 10px;
        }

        button[type="reset"]:hover {
            background-color: #eaecf4;
        }

        /* ลิงก์ย้อนกลับ */
        a[href="post.php"] {
            display: inline-block;
            margin-left: 15px;
            text-decoration: none;
            color: #858796;
            font-size: 14px;
        }

        a[href="post.php"]:hover {
            color: #333;
            text-decoration: underline;
        }

        /* เพิ่มเติม: ถ้ามีการเพิ่มรูปภาพในอนาคต */
        input[type="file"] {
            font-size: 14px;
            color: #888;
        }
    </style>
    </head>
<body>
    <div class="container">
        <h2>แก้ไขโพสต์</h2>
        <form action="edit_post_p.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="p_id" value="<?= $p_id; ?>">
            
            <div>
                <label for="p_title">หัวข้อบทความ</label>
                <input type="text" name="p_title" id="p_title" value="<?= $r->p_title; ?>" placeholder="กรอกชื่อหัวข้อที่นี่...">
            </div>

            <div>
                <label for="c_name">หมวดหมู่</label>
                <select name="c_name" id="c_name">
                    <?php
                        $sql_cat = "SELECT * FROM tb_category";
                        $rs_cat = $conn->query($sql_cat);
                        while($row_cat = $rs_cat->fetch_object()){
                            $selected = ($row_cat->c_id == $r->c_id) ? "selected" : "";
                            echo "<option value='{$row_cat->c_id}' {$selected}>{$row_cat->c_name}</option>";
                        }
                    ?>
                </select>
            </div>

            <div style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;">
                <button type="submit">บันทึกการเปลี่ยนแปลง</button>
                <button type="reset">คืนค่าเดิม</button>
                <a href="post.php">ย้อนกลับ</a>
            </div>
        </form>
    </div>
</body>
</html>