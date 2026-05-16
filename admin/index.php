<?php
    session_start();
    include('connect_db.php');

    if (isset($_SESSION['a_id'])) {
        $a_id = $_SESSION['a_id'];
        $sql = "SELECT a_img FROM tb_admin WHERE a_id = $a_id";
        $rs = $conn->query($sql);
        $r = $rs->fetch_object();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
    .content-admin {
        display: flex;            
        justify-content: center;   
        align-items: center;       
        padding: 30px;
        text-align: center;
        color: black;
    }
    .content-admin h1 {
        margin: 0;
        font-size: 2rem;
        letter-spacing: 1px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    </style>
    <title>หน้าหลัก</title>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="logo">SMP-CMS</div>
                <div class="menu">
                    <ul>
                        <li><a href="">หน้าหลัก</a></li>
                        <li><a href="post.php">บทความ</a></li>
                        <li><a href="category.php">หมวดหมู่  </a></li>
                        <li><a href="comment.php">ความคิดเห็น</a></li>
                        <li><a href="logout.php">ออกจากระบบ</a></li>
                    </ul>
                </div>
            <div class="search">
                <input type="search" placeholder="search" class="srch">
                <button type="submit" class="btn">ค้นหา</button>
            </div>
            <div class="profile-container">
                <a href="profile_a.php"><img src="../img/<?= $r->a_img; ?>" alt="Profile Picture" class="profile-img"></a>
            </div>
        </div>
        <div class="content-admin">
            <h1>Hello, Welcome Admin 👋</h1>
        </div>
    </div>
</body>
</html>