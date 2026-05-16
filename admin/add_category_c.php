<?php
    session_start();
    include('connect_db.php');

    $c_name = $_POST['c_name'];
    $m_id = $_SESSION['m_id'];

    $sql = "INSERT INTO tb_category(c_name, m_id)
            VALUES('$c_name', '$m_id')";
    
    $rs = $conn->query($sql);

    if($rs) { ?>
        <script>
            alert("เพิ่มหมวดหมู่เรียบร้อยครับ");
            window.location = "category.php";
        </script>
            <?php
    }else { ?>
        <script>
            alert("การเพิ่มล้มเหลว");
            window.location = "add_category.php";
        </script>
            <?php
    }
?>