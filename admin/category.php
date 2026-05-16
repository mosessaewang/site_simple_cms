<?php
    session_start();
    include('connect_db.php');

    if (isset($_SESSION['a_id'])) {
        $a_id = $_SESSION['a_id'];
        $sql = "SELECT a_img FROM tb_admin WHERE a_id = $a_id";
        $rs = $conn->query($sql);
        $r = $rs->fetch_object(); // ใช้ r_profile เพื่อไม่ให้ซ้ำกับใน loop
    }

    // --- ส่วนที่เพิ่มสำหรับการค้นหา ---
    $search = "";
    $where_clause = "";

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $where_clause = " WHERE c_name LIKE '%$search%' ";
    }
    // ----------------------------

    $sql = "SELECT * FROM tb_category $where_clause ORDER BY c_id DESC";
    $query = mysqli_query($conn, $sql) or die("SQL Error: " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหมวดหมู่</title>
    <link rel="stylesheet" href="style.css">
    <style>

        .header-category {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 20px;
        }

        .header-category h2 {
            font-family: 'Kanit', sans-serif;
            color: #333;
            margin-bottom: 20px;
            border-left: 5px solid #01ba08; /* สีเหลืองแจ้งเตือน */
            padding-left: 15px;
        }

        .btn-add-cat {
            background-color: #4e73df;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-add-cat:hover {
            background-color: #224abe;
            box-shadow: 0 4px 8px rgba(78, 115, 223, 0.3);
        }

        /* ตกแต่งตาราง */
        .table-cat {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        .table-cat thead th {
            background-color: #f8f9fc;
            color: #4e73df;
            text-align: left;
            padding: 15px;
            font-weight: 600;
            border-bottom: 2px solid #e3e6f0;
        }

        .table-cat tbody td {
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
            color: #5a5c69;
        }

        .table-cat tbody tr:hover {
            background-color: #fcfcfc;
        }

        /* ปุ่มลบ */
        .btn-del-cat {
            color: #e74a3b;
            text-decoration: none;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 4px;
            transition: 0.2s;
        }

        .btn-del-cat:hover {
            background-color: #fff5f5;
        }

        /* ปรับความกว้างคอลัมน์ลบให้พอดี */
        .text-center {
            text-align: center;
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
                <form action="category.php" method="GET" style="display: flex; gap: 5px;">
                    <input type="search" name="search" placeholder="ค้นหาหมวดหมู่..." class="srch" value="<?= htmlspecialchars($search); ?>">
                    <button type="submit" class="btn">ค้นหา</button>
                </form>
            </div>
            <div class="profile-container">
                <a href="profile_a.php"><img src="../img/<?= $r->a_img; ?>" alt="Profile Picture" class="profile-img"></a>
            </div>
        </div>



        <div class="header-category">
            <h2><i class="fas fa-category"></i>หมวดหมู่</h2>
            <a href="add_category.php" class="btn-add-cat">+ เพิ่มหมวดหมู่</a>
        </div>

        <table class="table-cat">
            <thead>
                <tr>
                    <th>ชื่อหมวดหมู่</th>
                    <th width="10%" class="text-center">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php while($r = mysqli_fetch_object($query)) { ?>
                <tr>
                    <td>
                        <strong><?= $r->c_name; ?></strong>
                    </td>
                    <td class="text-center">
                        <a href="delete_category.php?c_id=<?= $r->c_id; ?>" 
                        class="btn-del-cat" 
                        onclick="return confirm('ยืนยันการลบหมวดหมู่: <?= $r->c_name; ?>?')">
                        ลบ
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>