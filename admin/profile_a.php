<?php
    session_start();
    include('connect_db.php');

    // ขั้นตอนที่ 1: เช็คว่า Session ส่งมาถึงหน้านี้จริงไหม
    if (!isset($_SESSION['a_id'])) {
        echo "Error: Session 'a_id' ไม่มา! (คุณต้อง Login ใหม่ หรือหน้า Login ไม่ได้สร้าง Session)";
        exit();
    }

    $a_id = $_SESSION['a_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>หน้าโปรไฟล์</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    background-color: #FFFBEB;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    padding: 20px;
}

.profile-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    overflow: hidden;
    padding: 20px;
}

.profile-card h2 {
    text-align: center;
    padding-bottom: 10px;
}

.profile-img-box {
    text-align: center;
    margin-bottom: 20px;
}

.profile-img-box img{
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #764ba2;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.profile-details {
    padding: 20px;
}

.detail-item {
    padding-bottom: 5px;
}

.value {
    background-color: #D4D4D8;
    color: #0A0A0A;
    padding: 5px 12px;
    font-size: 12px;
    border-radius: 50px;
}

.btn-group {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

a {
    text-decoration: none;
}

.btn-edit {
    color: #ffc107;
    font-weight: 600px;
    transition: 0.5;
    border-radius: 8px;
}

.btn-edit:hover {
    background-color: #fff9e6;
    color: #d39e00;
}

.btn-back {
    color: #51A2FF;
    font-weight: 600px;
    transition: 0.5;
    border-radius: 8px;
}

.btn-back:hover {
    background: #DBEAFE;
    color: #8EC5FF;
}

    </style>
</head>
<body>
    <?php
        $sql = "SELECT * FROM tb_admin WHERE a_id = '$a_id'";
        $rs = $conn->query($sql);

        if (!$rs) {
            echo "Error SQL: " . $conn->error; // เช็คว่า SQL เขียนผิดไหม
            exit();
        }

        $r = $rs->fetch_object();

        if (!$r) {
            echo "หาข้อมูลไม่เจอ: ในฐานข้อมูลไม่มี a_id เลขที่ " . $a_id;
            exit();
        }
    ?>
    <div class="container">
        <div class="profile-card">
            <h2>โปรไฟล์ส่วนตัว</h2>
            
                <div class="profile-img-box">
                    <img src="../img/<?= $r->a_img ?>" alt="Profile" width="100px">
                </div>

                <div class="profile-details">
                    <div class="detail-item">
                            <span class="label">ไอดี :</span>
                            <span class="value"><?= $a_id ?></span>
                    </div>
                    <div class="detail-item">
                            <span class="label">ชื่อผู้ใช้งาน :</span>
                            <span class="value"><?= $r->a_name; ?></span>
                    </div>
                    <div class="detail-item">
                            <span class="label">อีเมล :</span>
                            <span class="value"><?= $r->a_email; ?></span>
                    </div>
                    <div class="detail-item">
                            <span class="label">รหัสผ่าน :</span>
                            <span class="value"><?= $r->a_pass; ?></span> </div>
                    </div>

                    <div class="btn-group">
                        <a href="edit_profile.php" class="btn-edit">แก้ไขข้อมูล</a>
                        <a href="index.php" class="btn-back">ย้อนกลับ</a>
                    </div>
                </div>
</div>
</body>
</html>