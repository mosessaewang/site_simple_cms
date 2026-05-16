<?php
    session_start();
    include('connect_db.php');


    if (isset($_SESSION['m_id'])) {
        $m_id = $_SESSION['m_id'];
        $sql = "SELECT m_img FROM tb_member WHERE m_id = $m_id";
        $rs = $conn->query($sql);
        $row = $rs->fetch_object();
    }

    $q = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';

    $sql = "SELECT tb_post.*, tb_member.m_user 
                 FROM tb_post 
                 INNER JOIN tb_member ON tb_post.m_id = tb_member.m_id ";
    
    if ($q != '') {
        $sql .= " WHERE tb_post.p_title LIKE '%$q%' OR tb_post.p_content LIKE '%$q%'";
    }

    $sql .= "ORDER BY tb_post.p_time DESC";
    
   $query = mysqli_query($conn, $sql) or die("SQL Error: " . mysqli_error($conn));


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
    <link rel="stylesheet" href="style.css">
    <title>หน้าหลัก</title>
    <style>
        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .h{
            font-size: 28px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-bottom: 20px;
            color: #333;
        }

        .post-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            align-items: stretch;
        }

        .post-card {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: 0.3s;
            height: 100%; 
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .post-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .post-card-content {
            padding: 15px;
            display: flex;
            flex-direction: column;
            height: calc(100% - 200px);
        }

        .post-card-content h3 {
            font-size: 18px;
            margin-bottom: 10px;
            min-height: 44px;
        }

        .post-card-content p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .post-date {
            margin-bottom: 10px;
            font-size: 13px;
            color: #888;
        }

        .btn-read {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            width: fit-content;
            margin-top: auto;
        }

        .btn-read:hover {
            background: #0056b3;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
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
                <form action="index.php" method="GET">
                    <input type="search" name="q" placeholder="search" class="srch">
                    <button type="submit" class="btn">ค้นหา</button>
                </form>
            </div>
            <div class="profile-container">
                <a href="profile.php"><img src="img/<?= $row->m_img; ?>" alt="Profile Picture" class="profile-img"></a>
            </div>
        </div>

            <div class="content">
                <h2 class="h">บทความล่าสุด</h2>
                <br>
                <div class="post-grid">
                    <?php while($r = mysqli_fetch_object($query)) { ?>
                        
                        <div class="post-card">
                            <img src="admin/img_post/<?= $r->p_img; ?>" alt="<?= $r->p_title; ?>" width="200px"> 
                            
                            <div class="post-card-content">
                                <h3><?= $r->p_title; ?></h3>
                                
                                <p>
                                    <?php 
                                        echo mb_strimwidth($r->p_content, 0, 60, "..."); 
                                    ?>
                                </p>
                                
                                <div class="post-date">
                                    <?= ThaiDate($r->p_time); ?>
                                </div>
                                
                                <a href="view_post.php?p_id=<?= $r->p_id; ?>" class="btn-read">อ่านต่อ</a>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
    </div>
</body>
</html>
<tr>
                                    