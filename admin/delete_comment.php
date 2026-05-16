<?php
    session_start();
    include('connect_db.php');

    $co_id = $_GET['co_id'];

    $sql = "DELETE FROM tb_comment WHERE co_id = '$co_id'";
    $rs = $conn->query($sql);

    if($rs) {  ?>
        <script>
            alert("ลบเรียบร้อยครับ");
            window.location = "comment.php";
        </script>
        <?php
    }else {
        echo "<script> alert= ('ไม่สามารถลบได้ครับ');
              window.location = 'comment.php'; </script>";
    }
?>