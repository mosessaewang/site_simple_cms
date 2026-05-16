<?php
    session_start();
    include('connect_db.php');
    $c_id = $_GET['c_id'];
    
    $sql = "SELECT tb_post.*, tb_member.m_user, tb_category.c_name
            FROM tb_post
            INNER JOIN tb_member ON tb_post.m_id = tb_member.m_id
            INNER JOIN tb_category ON tb_post.c_id = tb_category.c_id
            WHERE tb_post.c_id = '$c_id'
            ORDER BY tb_post.p_time DESC";
            
    $query = mysqli_query($conn, $sql) or die("SQL Error: " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>หมวดหมู่บทความ</title>
    <style>
    /* 1. แก้ไขคอนเทนเนอร์หลัก: จำกัดความกว้างเพื่อให้อ่านง่ายและรูปไม่ใหญ่เกิน */
    .category-container {
        max-width: 800px; /* จำกัดความกว้างสูงสุดแค่นี้พอ */
        margin: 40px auto; /* จัดกึ่งกลางหน้าจอ */
        padding: 0 20px; /* เว้นระยะจากขอบจอเวลาดูผ่านมือถือ */
        font-family: 'Sarabun', sans-serif;
    }

    /* 2. จัดการระยะห่างระหว่างแต่ละบทความ */
    .post-item {
        margin-bottom: 60px; /* เว้นระยะห่างด้านล่างเยอะๆ เพื่อไม่ให้รก */
        padding-bottom: 30px;
        border-bottom: 1px solid #eee; /* เส้นคั่นบางๆ */
    }

    /* 3. จัดการรูปภาพ (img) ให้ขนาดพอดี */
    .post-item img {
        width: 100%; /* ให้รูปขยายเต็มพื้นที่ 800px ที่เราจำกัดไว้ */
        max-height: 450px; /* จำกัดความสูงไม่ให้รูปยืดจนเบี้ยว */
        object-fit: cover; /* ตัดรูปให้พอดีกรอบอย่างสวยงาม */
        border-radius: 12px; /* ทำมุมมนให้ดูนุ่มนวล */
        margin-bottom: 20px; /* เว้นระยะใต้รูป */
        display: block; /* แก้ปัญหาช่องว่างเล็กๆ ใต้รูป */
    }

    /* 4. ปรับหัวข้อ (b) และรายละเอียด (small, span) */
    .post-item b {
        font-size: 28px; /* ขยายขนาดหัวข้อ */
        display: block;
        margin-bottom: 5px;
    }

    .post-item small {
        font-size: 14px;
        color: #4481eb; /* ใส่สีฟ้าให้หมวดหมู่ดูเด่น */
        display: block;
        margin-bottom: 15px;
    }

    .post-content-text {
        font-size: 18px; /* ขยายขนาดฟอนต์เนื้อหา */
        line-height: 1.8; /* เว้นวรรคให้อ่านง่าย */
        color: #444;
        display: block;
        white-space: pre-wrap; /* รักษาการขึ้นบรรทัดใหม่จากฐานข้อมูล */
    }
</style>
</head>
<body>
   <div class="category-container">
            <div class="post-grid">
                <?php 
                // วนลูปข้อมูลที่ query ได้ (โครงสร้างเดิมของคุณเป๊ะๆ)
                while($r = mysqli_fetch_object($query)) { 
                ?>
                    <div class="post-item"> <img src="admin/img_post/<?= $r->p_img; ?>"><br>
                        <b>หัวข้อ: <?= $r->p_title; ?></b> 
                        <small>(หมวดหมู่: <?= $r->c_name; ?>)</small>
                        <br>
                        <span class="post-content-text">เนื้อหา: <?= strip_tags($r->p_content); ?></span>
                    </div>
                <?php } ?>
            </div>

            <?php if(mysqli_num_rows($query) == 0): ?>
                <p style="text-align:center; color:#999; margin-top:50px;">ยังไม่มีบทความในหมวดหมู่นี้</p>
            <?php endif; ?>
    </div>
</body>
</html>