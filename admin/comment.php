<?php
    session_start();
    include('connect_db.php');

    if (isset($_SESSION['a_id'])) {
        $a_id = $_SESSION['a_id'];
        $sql = "SELECT a_img FROM tb_admin WHERE a_id = $a_id";
        $rs = $conn->query($sql);
        $r = $rs->fetch_object();
    }

    // --- ส่วนที่เพิ่มสำหรับการค้นหา ---
    $search = "";
    $where_clause = "";

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $where_clause = " WHERE tb_comment.co_comment LIKE '%$search%' 
                          OR tb_member.m_user LIKE '%$search%' 
                          OR tb_post.p_title LIKE '%$search%' ";
    }
    // ----------------------------

    $sql = "SELECT tb_comment.*, tb_member.m_user, tb_post.p_title
            FROM tb_comment
            INNER JOIN tb_member ON tb_comment.m_id = tb_member.m_id
            INNER JOIN tb_post ON tb_comment.p_id = tb_post.p_id
            $where_clause
            ORDER BY tb_comment.co_id DESC";
            
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
    <title>หน้าคอมเม้น</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .comment-content {
            max-width: 100%;
            margin: 20px auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        h2 {
            font-family: 'Kanit', sans-serif;
            color: #333;
            margin-bottom: 20px;
            border-left: 5px solid #f6c23e; /* สีเหลืองแจ้งเตือน */
            padding-left: 15px;
        }

        /* ตกแต่งตาราง */
        .table-comment {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Sarabun', sans-serif;
            font-size: 14px;
        }

        .table-comment thead th {
            background-color: #f8f9fc;
            color: #6d6e6f;
            text-align: left;
            padding: 15px;
            border-bottom: 2px solid #e3e6f0;
            white-space: nowrap;
        }

        .table-comment tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #edf0f7;
            vertical-align: top; /* ให้ข้อความเริ่มจากด้านบน */
        }

        .table-comment tbody tr:hover {
            background-color: #fcfcfc;
        }

        /* ตกแต่งส่วนบทความและผู้ใช้ */
        .post-title {
            font-weight: 600;
            color: #2e59d9;
            font-size: 13px;
        }

        .user-name {
            color: #5a5c69;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ช่องความคิดเห็น */
        .comment-text {
            color: #333;
            line-height: 1.5;
            max-width: 400px; /* จำกัดความกว้างเพื่อให้อ่านง่าย */
            word-wrap: break-word; /* ตัดคำอัตโนมัติถ้าคำยาวเกิน */
        }

        .comment-time {
            font-size: 12px;
            color: #858796;
            white-space: nowrap;
        }

        /* ปุ่มลบ */
        .btn-delete-com {
            color: #e74a3b;
            text-decoration: none;
            padding: 5px 12px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 13px;
            transition: 0.3s;
        }

        .btn-delete-com:hover {
            background-color: #fff5f5;
            color: #e74a3b;
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
                        <li><a href="post.php">บทความ</a></li>
                        <li><a href="category.php">หมวดหมู่  </a></li>
                        <li><a href="comment.php">ความคิดเห็น</a></li>
                        <li><a href="logout.php">ออกจากระบบ</a></li>
                    </ul>
                </div>
            <div class="search">
                <form action="comment.php" method="GET" style="display: flex; gap: 5px;">
                    <input type="search" name="search" placeholder="ค้นหาความคิดเห็น..." class="srch" value="<?= htmlspecialchars($search); ?>">
                    <button type="submit" class="btn">ค้นหา</button>
                </form>
            </div>
            <div class="profile-container">
                <a href="profile_a.php"><img src="../img/<?= $r->a_img; ?>" alt="Profile Picture" class="profile-img"></a>
            </div>
        </div>

                <div class="comment-content">
                    <h2><i class="fas fa-comments"></i> จัดการความคิดเห็น</h2>
    
                <table class="table-comment">
                    <thead>
                        <tr>
                            <th width="20%">บทความ</th>
                            <th width="15%">ผู้ใช้</th>
                            <th width="40%">ความคิดเห็น</th>
                            <th width="15%">เวลาที่คอมเม้นต์</th>
                            <th width="10%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(mysqli_num_rows($query) > 0) { ?>
                            <?php while($r = mysqli_fetch_object($query)) { ?>
                            <tr>
                                <td><div class="post-title"><?= $r->p_title; ?></div></td>
                                <td><div class="user-name">👤 <?= $r->m_user; ?></div></td>
                                <td><div class="comment-text"><?= $r->co_comment; ?></div></td>
                                <td><div class="comment-time"><?= ThaiDate($r->co_time); ?></div></td>
                                <td style="text-align: center;">
                                    <a href="delete_comment.php?co_id=<?= $r->co_id; ?>" 
                                    class="btn-delete-com" 
                                    onclick="return confirm('ยืนยันการลบความคิดเห็นนี้?')">ลบ</a>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 50px; color: #999;">
                                    ไม่พบข้อมูลความคิดเห็นที่คุณค้นหา
                                </td>
                            </tr>
                        <?php } ?>
                </tbody>
                </table>
            </div>
        </div>
</body>
</html>