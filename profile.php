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
    <title>หน้าโปรไฟล์</title>
    <link rel="stylesheet" href="profile.css">
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
        <div class="profile-card">
            <h2>โปรไฟล์ส่วนตัว</h2>
            
                <div class="profile-img-box">
                    <img src="img/<?= $r->m_img ?>" alt="Profile">
                </div>

                <div class="profile-details">
                    <div class="detail-item">
                            <span class="label">ไอดี :</span>
                            <span class="value"><?= $m_id ?></span>
                    </div>
                    <div class="detail-item">
                            <span class="label">ชื่อผู้ใช้งาน :</span>
                            <span class="value"><?= $r->m_user; ?></span>
                    </div>
                    <div class="detail-item">
                            <span class="label">อีเมล :</span>
                            <span class="value"><?= $r->m_email; ?></span>
                    </div>
                    <div class="detail-item">
                            <span class="label">รหัสผ่าน :</span>
                            <span class="value"><?= $r->m_pass; ?></span> </div>
                    </div>

                    <div class="btn-group">
                        <a href="edit_profile.php" class="btn btn-edit">แก้ไขข้อมูล</a>
                        <a href="index.php" class="btn btn-back">ย้อนกลับ</a>
                    </div>
                </div>
</div>
</body>
</html>