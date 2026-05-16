<?php
    session_start();
    include('connect_db.php');

    if (isset($_SESSION['m_id'])) {
        $m_id = $_SESSION['m_id'];
        $sql = "SELECT m_img FROM tb_member WHERE m_id = $m_id";
        $rs = $conn->query($sql);
        $r = $rs->fetch_object();
    }

    $sql = "SELECT tb_post.*, tb_member.m_user 
                 FROM tb_post 
                 INNER JOIN tb_member ON tb_post.m_id = tb_member.m_id
                 ORDER BY tb_post.p_time DESC";
                 
   $query = mysqli_query($conn, $sql) or die("SQL Error: " . mysqli_error($conn));


    if (!isset($_GET['p_id']) || empty($_GET['p_id'])) {
        header("Location: index.php");
        exit();
    }

    $p_id = mysqli_real_escape_string($conn, $_GET['p_id']);

    // --- ส่วนที่ 1: ดึงข้อมูลโพสต์ (ใช้ตัวแปร $query_p) ---
    $sql_p = "SELECT tb_post.*, tb_member.m_user
            FROM tb_post 
            INNER JOIN tb_member ON tb_post.m_id = tb_member.m_id 
            WHERE tb_post.p_id = '$p_id' 
            ORDER BY tb_post.p_time DESC";
    
    $query_p = mysqli_query($conn, $sql_p) or die("SQL Error (Post): " . mysqli_error($conn));
    
    // --- ส่วนที่ 2: ดึงข้อมูลคอมเมนต์ (ใช้ตัวแปร $query_c) ---
    $sql_c = "SELECT tb_comment.*, tb_member.m_user
               FROM tb_comment
               INNER JOIN tb_member ON tb_comment.m_id = tb_member.m_id
               WHERE tb_comment.p_id = '$p_id'
               ORDER BY tb_comment.co_id ASC"; 

    $query_c = mysqli_query($conn, $sql_c) or die("SQL Error (Comment): " . mysqli_error($conn));
    $num_rows = mysqli_num_rows($query_c);


    function ThaiDate($strDate) {
            if (empty($strDate) || $strDate == "0000-00-00 00:00:00") {
                return "ไม่ระบุวันที่";
            }

            $thai_month_arr = array(
                "0"=>"", "1"=>"มกราคม", "2"=>"กุมภาพันธ์", "3"=>"มีนาคม",
                "4"=>"เมษายน", "5"=>"พฤษภาคม", "6"=>"มิถุนายน", 
                "7"=>"กรกฎาคม", "8"=>"สิงหาคม", "9"=>"กันยายน", 
                "10"=>"ตุลาคม", "11"=>"พฤศจิกายน", "12"=>"ธันวาคม"                
            );
            
            $time = strtotime($strDate);
            
            // ถ้า strtotime แปลงไม่สำเร็จ ให้คืนค่าเดิมหรือข้อความแจ้งเตือน
            if (!$time) {
                return "รูปแบบวันที่ผิดพลาด";
            }

            $day = date("j", $time);
            $month = date("n", $time);
            $year = date("Y", $time) + 543; 
            $hour = date("H", $time);
            $minute = date("i", $time);

            return "$day " . $thai_month_arr[$month] . " $year ($hour:$minute น.)";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าบทความและคอมเม้น</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* คอนเทนเนอร์หลักของหน้า */
        .post-detail-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            font-family: 'Sarabun', sans-serif;
        }

        /* หัวข้อบทความ */
        .post-header h1 {
            font-size: 2rem;
            margin-bottom: 5px;
            color: #333;
        }

        .post-meta {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 20px;
        }

        /* รูปภาพบทความ */
        .post-image-box {
            width: 100%;
            margin-bottom: 25px;
        }

        .main-post-img {
            width: 100%; /* ให้รูปกว้างเต็มคอนเทนเนอร์ */
            max-height: 450px;
            object-fit: cover; /* ตัดรูปให้พอดีกรอบสวยๆ */
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* เนื้อหาบทความ */
        .post-body p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
        }

        /* รายการความคิดเห็น */
        .comment-section {
            margin-top: 50px;
            border-top: 1px solid #eee;
            padding-top: 30px;
        }

        .comment-item {
            background: #f8f9fa;
            padding: 15px 20px;
            margin-bottom: 12px;
            border-radius: 10px;
            border: 1px solid #efefef;
        }

        .comment-user {
            font-weight: bold;
            color: #333;
            margin-right: 10px;
        }

        .comment-user::after {
            content: " —";
            color: #ccc;
        }

        .comment-text {
            color: #555;
        }

        /* ฟอร์มส่งคอมเมนต์ */
        .comment-form {
            margin-top: 30px;
        }

        .input-group {
            display: flex;
            gap: 10px;
        }

        .comment-form input[type="text"] {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
        }

        .comment-form input[type="text"]:focus {
            border-color: #007bff;
        }

        .btn-send {
            padding: 10px 25px;
            background-color: #4481eb; /* สีน้ำเงินตามรูป */
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-send:hover {
            background-color: #04befe;
        }
    </style>
</head>
<body>
    <div class="container">
            <div class="navbar">
            <div class="logo">SMP-CMS</div>
                <div class="menu">
                    <ul>
                        <li><a href="index.php">หน้าหลัก</a></li>
                        <li><a href="category.php">หมวดหมู่</a></li>
                        <li><a href="about.php">เกี่ยวกับ</a></li>
                        <li><a href="logout.php">ออกจากระบบ</a></li>
                    </ul>
                </div>
            <div class="search">
                <input type="search" placeholder="search" class="srch">
                <button type="submit" class="btn">ค้นหา</button>
            </div>
            <div class="profile-container">
                <a href="profile.php"><img src="img/<?= $r->m_img; ?>" alt="Profile Picture" class="profile-img"></a>
            </div>
        </div>    

        <div class="post-detail-container">
            <?php while($r = mysqli_fetch_object($query_p)) { ?>
        <div class="post-header">
            <h1><?= $r->p_title; ?></h1>
            <div class="post-meta"><?= ThaiDate($r->p_time); ?></div>
        </div>
        
        <div class="post-image-box">
            <img src="admin/img_post/<?= $r->p_img; ?>" class="main-post-img">
        </div>
        
        <div class="post-body">
            <p><?= nl2br($r->p_content); ?></p>
        </div>
        <?php } ?>

        <div class="comment-section">
            <h3>ความคิดเห็น (<?= $num_rows; ?>)</h3>
            
            <div class="comment-list">
                <?php while($rc = mysqli_fetch_object($query_c)) { ?>
                    <div class="comment-item">
                        <span class="comment-user"><?= $rc->m_user; ?></span>
                        <span class="comment-text"><?= $rc->co_comment; ?></span>
                    </div>
                <?php } ?>
            </div>

            <form action="comment_save.php" method="post" class="comment-form">
                <input type="hidden" name="p_id" value="<?= $p_id; ?>">
                <div class="input-group">
                    <input type="text" name="co_comment" placeholder="เขียนความคิดเห็น..." required>
                    <button type="submit" class="btn-send">ส่งความคิดเห็น</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</body>
</html>