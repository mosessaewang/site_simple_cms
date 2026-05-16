<?php
    session_start();
    include('connect_db.php');

    $c_id = $_GET['c_id'];

    $sql = "DELETE FROM tb_category WHERE c_id = '$c_id'";
    $rs = $conn->query($sql);

    if($rs) { ?>
        <script>
            alert("ลบเรียบร้อยครับ");
            window.location = "category.php";
        </script>
        <?php
    }else {
        echo "<script> alert = ('ไม่สามารถลบได้ครับ') 
        window.location ='category.php'; </script>";
    }
?>