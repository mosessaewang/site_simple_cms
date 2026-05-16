<?php
    session_start();
    include('connect_db.php');

    if (isset($_SESSION['m_id'])) {
        $m_id = $_SESSION['m_id'];
        $sql = "SELECT m_img FROM tb_member WHERE m_id = $m_id";
        $rs = $conn->query($sql);
        $r = $rs->fetch_object();
    }

    $sql = "SELECT tb_category.*, tb_member.m_user, COUNT(tb_post.p_id) AS total_posts
            FROM tb_category 
            INNER JOIN tb_member ON tb_category.m_id = tb_member.m_id
            LEFT JOIN tb_post ON tb_category.c_id = tb_post.c_id
            GROUP BY tb_category.c_id
            ORDER BY tb_category.c_id DESC";
                 
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
        .content {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h2 {
            font-size: 28px;
            color: #333;
            border-left: 5px solid #4481eb;
            padding-left: 15px;
            margin-bottom: 30px;
        }

        .category-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* แบ่งเป็นคอลัมน์อัตโนมัติ */
            gap: 20px;
        }

        .category-item {
            background: #fff;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }

        .category-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            border-color: #4481eb;
        }

        .category-item a {
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            color: #4481eb;
            margin-bottom: 8px;
        }

        .category-item h6 {
            margin: 0;
            font-size: 14px;
            color: #888;
            font-weight: normal;
        }

        .post-count {
            background: #f0f4ff;
            color: #4481eb;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 12px;
            margin-left: 5px;
            font-weight: bold;
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

                    <div class="content">
                        <h2>หมวดหมู่บทความ</h2>
                        
                        <div class="category-list">
                            <?php while ($row = mysqli_fetch_object($query)) { ?>
                                <div class="category-item">
                                    <a href="category_detail.php?c_id=<?= $row->c_id; ?>">
                                        <?= $row->c_name; ?> 
                                    </a>
                                    <h6>
                                        จำนวนบทความ: 
                                        <span class="post-count"><?= $row->total_posts; ?></span>
                                    </h6>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
        </div>
</body>
</html>