<?php
    session_start();
    include('connect_db.php');

        $m_id = $_SESSION['m_id'];
        $sql = "SELECT * FROM tb_member WHERE m_id = $m_id";
        $rs = $conn->query($sql);
        $r = $rs->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เกี่ยวกับ</title>
    <style>
        body {
            background-color: #f4f7f9;
            font-family: 'Sarabun', sans-serif;
            display: flex;
            justify-content: center;
            padding: 50px 20px;
        }

        .about-container {
            background: #fff;
            max-width: 1000px;
            width: 100%;
            display: flex;
            gap: 40px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .about-content {
            flex: 2;
        }

        .about-content h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .about-content p {
            line-height: 1.8;
            color: #555;
            margin-bottom: 20px;
        }

        .profile-card {
            flex: 1;
            border: 1px solid #eee;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            background: #fff;
            height: fit-content;
        }

        .profile-img-box img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .profile-info {
            padding: 20px;
        }

        .profile-info h2 {
            margin: 10px 0 5px;
            font-size: 22px;
        }

        .profile-info p {
            color: #888;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .social-icons a {
            background: #4481eb;
            color: white;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            font-size: 18px;
            transition: 0.3s;
            text-decoration: none;
        }

        .social-icons a:hover {
            background: #04befe;
            transform: translateY(-3px);
        }
</style>
</head>
<body>
    <div class="about-container">
    <div class="about-content">
        <h1>เกี่ยวกับเรา</h1>
        <p>ยินดีต้อนรับสู่ My Blog! บล็อกแห่งนี้ถูกสร้างขึ้นเพื่อแบ่งปันความรู้และประสบการณ์ที่น่าสนใจเกี่ยวกับเทคโนโลยี การพัฒนาเว็บไซต์ เช่น HTML, CSS, JavaScript และเทคโนโลยีต่าง ๆ</p>
        
        <h3>สวัสดีครับ ผมชื่อ <?= $r->m_user; ?></h3>
        <p>ผมเป็นนักพัฒนาเว็บมือใหม่ที่กำลังเรียนรู้และพัฒนาทักษะด้าน Programming และ Cybersecurity เว็บไซต์นี้เป็นส่วนหนึ่งของ Portfolio เพื่อแสดงผลงานและความสามารถของผม</p>
        <p>ขอบคุณที่แวะเข้ามาเยี่ยมชมบล็อกของผม! หากคุณมีข้อเสนอแนะหรือต้องการติดต่อ สามารถส่งข้อความผ่านโซเชียลมีเดียได้เลย</p>
    </div>

    <div class="profile-card">
        <div class="profile-img-box">
            <img src="img/<?= $r->m_img; ?>" alt="Moses Profile">
        </div>
        <div class="profile-info">
            <h2><?= $r->m_user; ?></h2>
            <p><?= $r->m_email; ?></p>
            <div class="social-icons">
                <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
                <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
                <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
            </div>
        </div>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>