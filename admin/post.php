<?php
    session_start();
    include('connect_db.php');
    $a_id = $_SESSION['a_id'];

    if (isset($_SESSION['a_id'])) {
        $a_id = $_SESSION['a_id'];
        $sql_profile = "SELECT a_img FROM tb_admin WHERE a_id = $a_id";
        $rs_profile = $conn->query($sql_profile);
        $r = $rs_profile->fetch_object();
    }

    $search = "";
    $where_clause = "";

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        // ค้นหาจาก หัวข้อบทความ (p_title) หรือ ชื่อหมวดหมู่ (c_name)
        $where_clause = " WHERE tb_post.p_title LIKE '%$search%' OR tb_category.c_name LIKE '%$search%' ";
    }
    // ----------------------------

    $sql = "SELECT tb_post.*, tb_category.c_name, tb_admin.a_name, tb_member.m_user 
            FROM tb_post 
            INNER JOIN tb_category ON tb_post.c_id = tb_category.c_id 
            INNER JOIN tb_admin ON tb_post.a_id = tb_admin.a_id 
            LEFT JOIN tb_member ON tb_post.m_id = tb_member.m_id 
            $where_clause
            ORDER BY tb_post.p_id DESC";          
              
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
    <title>หน้าจัดการบทความ</title>
    <link rel="stylesheet" href="style.css">
    <style>
            /* ส่วนหัวของเนื้อหา */
.header-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f2f5;
    padding: 20px;
}

.header-flex h2 {
    font-family: 'Kanit', sans-serif;
    color: #333;
    margin-bottom: 20px;
    border-left: 5px solid #e75609; /* สีเหลืองแจ้งเตือน */
    padding-left: 15px;
}

/* ปุ่มเพิ่มบทความ */
.btn-add {
    background-color: #28a745;
    color: #fff;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(40, 167, 69, 0.2);
}

.btn-add:hover {
    background-color: #218838;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
}

/* การจัดการตาราง */
.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0,0,0,0.05);
}

.table thead th {
    background-color: #f8f9fa;
    color: #495057;
    text-align: left;
    padding: 15px;
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 0.5px;
}

.table tbody td {
    padding: 15px;
    border-bottom: 1px solid #f1f1f1;
    vertical-align: middle;
    transition: background 0.2s;
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.table tbody tr:hover {
    background-color: #fcfcfc;
}

/* ตกแต่ง Badge หมวดหมู่ */
.badge-category {
    background-color: #e7f3ff;
    color: #007bff;
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 500;
}

/* ตกแต่งส่วนชื่อผู้ใช้และวันที่ */
.table td strong {
    color: #2c3e50;
    display: block;
    margin-bottom: 4px;
}

.table td small {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #7f8c8d;
}

/* ปุ่มแก้ไข-ลบ */
.btn-edit {
    color: #ffc107;
    text-decoration: none;
    font-weight: 600;
    padding: 5px 10px;
    border-radius: 4px;
    transition: 0.2s;
}

.btn-edit:hover {
    background-color: #fff9e6;
    color: #d39e00;
}

.btn-delete {
    color: #dc3545;
    text-decoration: none;
    font-weight: 600;
    padding: 5px 10px;
    border-radius: 4px;
    transition: 0.2s;
}

.btn-delete:hover {
    background-color: #fff5f5;
    color: #a71d2a;
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
                    <form action="post.php" method="GET" style="display: flex; gap: 5px;">
                        <input type="search" name="search" placeholder="ค้นหาชื่อบทความ..." class="srch" value="<?= htmlspecialchars($search); ?>">
                        <button type="submit" class="btn">ค้นหา</button>
                    </form>
                </div>
            <div class="profile-container">
                <a href="profile_a.php"><img src="../img/<?= $r->a_img; ?>" alt="Profile Picture" class="profile-img"></a>
            </div>
        </div>


        <div class="header-flex">
        <h2><i class="fas fa-category"></i>จัดการบทความ</h2>
        <a href="add_post.php" class="btn-add">+ เพิ่มบทความใหม่</a>
    </div>
    
    <br>
    
    <table class="table">
        <thead>
            <tr>
                <th width="35%">หัวข้อ</th>
                <th width="15%">หมวดหมู่</th>
                <th width="20%">วันที่</th>
                <th width="15%">เพิ่มโดย</th>
                <th width="15%">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php while($res = mysqli_fetch_object($query)) { ?>
                <tr>
                    <td><strong><?= $res->p_title; ?></strong></td>
                    <td><span class="badge-category"><?= $res->c_name; ?></span></td>
                    <td style="font-size: 13px; color: #666;">
                        <?= ThaiDate($res->p_time); ?>
                    </td>
                    <td>
                        <small>👤 <?= $res->a_name; ?></small>
                    </td>
                    <td>
                        <a href="edit_post.php?p_id=<?= $res->p_id; ?>" class="btn-edit">แก้ไข</a> 
                        <span style="color: #ccc;">|</span>
                        <a href="delete_post.php?p_id=<?= $res->p_id; ?>" class="btn-delete" onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
</body>
</html>