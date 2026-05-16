<?php
    session_start();
    include('connect_db.php');

    // ขั้นตอนที่ 1: เช็คว่า Session ส่งมาถึงหน้านี้จริงไหม
    if (!isset($_SESSION['m_id'])) {
        echo "Error: Session 'm_id' ไม่มา! (คุณต้อง Login ใหม่ หรือหน้า Login ไม่ได้สร้าง Session)";
        exit();
    }

    $m_id = $_SESSION['m_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #FEFCE8;
        }

        .container {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            padding-bottom: 10px;
        }

        .profile-img-box {
            text-align: center;
            margin-bottom: 5px;
        }

        .profile-img-box img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #2B7FFF;
        }

        /* จัดการแถวแต่ละแถวให้เป็น Flex */
        .group-profile, .group-profile-img {
            display: flex;
            align-items: center; /* จัดให้อยู่กึ่งกลางแนวตั้ง */
            margin-bottom: 15px; /* เพิ่มระยะห่างระหว่างแถว */
        }

        /* กำหนดความกว้างคงที่ให้กับ Label */
        .group-profile label, .group-profile-img label {
            width: 120px; /* ปรับตัวเลขนี้ตามความเหมาะสมเพื่อให้พอดีกับข้อความ */
            text-align: right; /* จัดข้อความชิดขวาเพื่อให้ติดกับ input */
            margin-right: 15px; /* ระยะห่างระหว่าง label กับ input */
        }

        /* ปรับแต่ง input ให้ดูดีขึ้น */
        .group-profile input {
            flex: 1; /* ให้ input ยืดเต็มพื้นที่ที่เหลือ (ถ้าต้องการ) หรือกำหนด width คงที่ก็ได้ */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* จัดปุ่มให้ตรงกับแนว input */
        .group > div:last-child {
            margin-left: 70px; /* เท่ากับความกว้าง label + margin-right */
            margin-top: 20px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn-smb {
            padding: 10px 20px 10px 20px;
            background-color: #2B7FFF;
            color: #fff;
            border: none;
            border-radius: 8px;
        }

        .btn-rst {
            padding: 10px 20px 10px 20px;
            background-color: #71717B;
            color: #fff;
            border: none;
            border-radius: 8px;
        }

        a {
            padding: 10px 10px 10px 10px;
            border-radius: 2px;
            text-decoration: none;
            border: 1px solid #000;
            border-radius: 8px;
            font-size: 15px;
        }
    </style>
    <title>แก้ไขข้อมูล</title>
</head>
<body>
        <?php
            $sql = "SELECT * FROM tb_member WHERE m_id = '$m_id'";
            $rs = $conn->query($sql);

            if (!$rs) {
                echo "Error SQL: " . $conn->error; // เช็คว่า SQL เขียนผิดไหม
                exit();
            }

            $r = $rs->fetch_object();

            if (!$r) {
                echo "หาข้อมูลไม่เจอ: ในฐานข้อมูลไม่มี m_id เลขที่ " . $m_id;
                exit();
            }
        ?>

        <div class="container">
            <h2>แก้ไขข้อมูลส่วนตัว</h2>
            <form action="edit_profile_m.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="profile-img-box">
                    <img src="img/<?= $r->m_img; ?>" width="100px">
                </div>
                <div class="group">
                        <div class="group-profile">
                            <label for="m_id">ไอดีผู้ใช้งาน :</label>
                            <span><?= $r->m_id; ?></span>
                        </div>
                        <div class="group-profile">
                            <label for="m_user">ชื่อผู้ใช้งาน :</label>
                            <input type="text" name="m_user" value="<?= $r->m_user; ?>" required>
                        </div>
                        <div class="group-profile">
                            <label for="m_email">อีเมล :</label>
                            <input type="email" name="m_email" value="<?= $r->m_email; ?>" required>
                        </div>
                        <div class="group-profile">
                            <label for="m_pass">รหัสผ่าน :</label>
                            <input type="text" name="m_pass" value="<?= $r->m_pass; ?>" required>
                        </div>
                        <div class="group-profile-img">
                            <label for="m_img">รูปภาพ :</label>
                            <input type="file" name="m_img" required>
                        </div>
                        <div class="btn-group">
                            <button type="submit" class="btn-smb">บันทึก</button>
                            <button type="reset" class="btn-rst">ยกเลิก</button>
                            <a href="profile.php">ย้อนกลับ</a>
                        </div>
                </div>
            </form>
        </div>
</body>
</html>