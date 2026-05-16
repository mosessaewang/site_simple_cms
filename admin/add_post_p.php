<?php
    session_start();
    include('connect_db.php');
    $a_id = $_SESSION['a_id'];
    $m_id = $_SESSION['m_id'];
    
    $p_title = $_POST['p_title'];
    $p_content = $_POST['p_content'];
    $c_id = $_POST['c_id'];
    $p_time = $_POST['p_time'];
    $p_img = $_FILES['p_img']['name'];
    $p_img_path = $_FILES['p_img']['tmp_name'];

    $sql = "INSERT INTO tb_post (p_title, p_content, p_img, c_id, a_id, m_id, p_time)
            VALUES('$p_title', '$p_content', '$p_img', '$c_id', '$a_id', '$m_id', NOW())";

    $rs = $conn->query($sql);

    if($rs) {
            move_uploaded_file($p_img_path, "img_post/" . $p_img);
        ?>
            <script>
                    alert("เพิ่มบทความเรียบร้อยครับ");
                    window.location = "post.php"
            </script>
        <?php

    }else { ?>
            <script>
                    alert("ล้มเหลวครับ");
                    window.location = "add_post.php";
            </script>
        <?php
    }
?>