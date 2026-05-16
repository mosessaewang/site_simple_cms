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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    background-color: #fff;
    border-radius: 8px;
}

h2 {
    text-align: center;
    padding-bottom: 8px;
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

.edit-profile {
    padding: 10px;
}

.group-edit {
    padding-bottom: 5px;
}

.ipt {
    padding: 5px;
    border-radius: 8px;
    border: 1px solid #364153;
}

.btn-group {
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 10px;
}

.btn-sbm {
    padding: 4px 8px;
    border-radius: 5px;
}

.btn-rst {
    padding: 4px 8px;
    border-radius: 5px;
}

a {
    text-decoration: none;
    border: 1px solid #000;
    padding: 4px 8px;
    border-radius: 5px;
}
    </style>
    <title>แก้ไขข้อมูล</title>
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
            <h2>แก้ไขข้อมูลส่วนตัว</h2>
            <form action="edit_profile_a.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="profile-img-box">
                    <img src="../img/<?= $r->a_img; ?>" width="100px">
                </div>
                <div class="edit-profile">
                    <div class="group-edit">
                        <label for="a_id">ไอดีผู้ใช้งาน :</label>
                        <?= $r->a_id; ?>
                    </div>
                    <div class="group-edit">
                        <label for="a_name">ชื่อผู้ใช้งาน :</label>
                        <input type="text" name="a_name" value="<?= $r->a_name; ?>" class="ipt" required>
                    </div>
                    <div class="group-edit">
                        <label for="a_email">อีเมล :</label>
                        <input type="email" name="a_email" value="<?= $r->a_email; ?>" class="ipt" required>
                    </div>
                    <div class="group-edit">
                        <label for="a_pass">รหัสผ่าน :</label>
                        <input type="text" name="a_pass" value="<?= $r->a_pass; ?>" class="ipt" required>
                    </div>
                    <div class="group-edit">
                        <label for="a_img">รูปภาพ :</label>
                        <input type="file" name="a_img" required>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn-sbm">บันทึก</button>
                        <button type="reset" class="btn-rst">ยกเลิก</button>
                        <a href="profile_a.php">ย้อนกลับ</a>
                    </div>
                </div>
            </form>
        </div>
</body>
</html>