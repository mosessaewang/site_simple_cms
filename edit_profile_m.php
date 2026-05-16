<?php
    session_start();
    include('connect_db.php');

    $m_id = $_SESSION['m_id'];

    $m_user = $_POST['m_user'];
    $m_email = $_POST['m_email'];
    $m_pass = $_POST['m_pass'];

    $m_img = $_FILES['m_img']['name'];
    $m_img_path = $_FILES['m_img']['tmp_name'];

    if($m_img == '') {
        $sql = "UPDATE tb_member SET
        m_user = '$m_user',
        m_email = '$m_email',
        m_pass = '$m_pass'
        WHERE m_id = '$m_id'";
    }else {
        $sql = "UPDATE tb_member SET
        m_user = '$m_user',
        m_email = '$m_email',
        m_pass = '$m_pass',
        m_img = '$m_img'
        WHERE m_id = '$m_id'";
    }

    $rs = $conn->query($sql);

    if ($rs) {
    if ($m_img != '') {
        move_uploaded_file($m_img_path, "img/" . $m_img);
    }
        ?>
        <script language="javascript">
            alert("แก้ไขข้อมูลสำเร็จ");
            window.location = "profile.php";
        </script>
        <?php
    } else {
        echo "ไม่สามารถแก้ไขได้ครับ" . $conn->error;
        echo $sql;
        exit();
    }

$conn->close();
?>