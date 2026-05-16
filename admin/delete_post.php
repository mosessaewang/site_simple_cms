<?php
    session_start();
    include('connect_db.php');

    $p_id = $_GET['p_id'];
    

    $sql = "DELETE FROM  tb_post WHERE p_id = '$p_id'";
    $rs = $conn->query($sql);

    if($rs) { ?>
        <script>
            alert("ลบเรียบร้อยแล้วครับ");
            window.location = "post.php";
        </script>
        <?php
    }else {
        echo "<script> alert='ไม่สามารถลบได้: " . $conn->error . "'; window.location = 'post.php'; </script>";
    }
?>