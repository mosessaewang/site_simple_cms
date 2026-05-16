<?php
    session_start();
    include('connect_db.php');
    $m_id = $_SESSION['m_id'];

    $co_comment = $_POST['co_comment'];
    $p_id = $_POST['p_id'];

    $sql = "INSERT INTO tb_comment(co_comment, co_time, p_id, m_id)
            VALUES('$co_comment', NOW(), '$p_id', '$m_id')";

    $rs = $conn->query($sql);

    if($rs) { 
        echo "<script>
                alert('แสดงความคิดเห็นแล้ว');
                window.location = 'view_post.php'; 
              </script>";
    } else {
        echo "<script>
                alert('ไม่สามารถแสดงความคิดเห็นได้ครับ: " . $conn->error . "');
                window.location = 'view_post.php';
              </script>";
    }
?>