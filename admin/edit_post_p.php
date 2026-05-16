<?php
    session_start();
    include('connect_db.php');

    $p_id = $_POST['p_id'];
    $p_title = $_POST['p_title'];
    $c_name = $_POST['c_name'];
    $p_time = $_POST['p_time'];

    if(!empty($p_id)) {
        $sql = "UPDATE tb_post SET
        p_title = '$p_title',
        c_id = '$c_name',
        p_time = NOW()
        WHERE p_id = '$p_id'";
    
    $rs = $conn->query($sql);

    if($rs) {
        echo "  <script> 
                    alert('แก้ไขสำเร็จครับ')
                    window.location = 'post.php'; 
                </script>";
    } else {
        echo "  <script>
                    alert('ไม่สามารถลบได้ครับ')
                    window.location = 'edit_post.php';
                </script>";
        }
    } else {
        echo "ไม่พบโพสต์!!!";
    }
?>