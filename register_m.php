<?php
    session_start();
    include('connect_db.php');

    $m_user = $_POST['m_user'];
    $m_email = $_POST['m_email'];
    $m_pass = $_POST['m_pass'];
    $m_img = $_FILES['m_img']['name'];
    $m_img_path = $_FILES['m_img']['tmp_name'];

    $sql = "INSERT INTO tb_member(m_user, m_email, m_pass, m_img)
            VALUES('$m_user', '$m_email', '$m_pass', '$m_img')";

    $rs = $conn->query($sql);

    if($rs) {
        move_uploaded_file($m_img_path, "img/" . $m_img);
        ?>
            <script>
                alert("สมัครเรียบร้อยครับผม");
                window.location = "login.php";
            </script>
        <?php
    }else {
        ?>
            <script>
                alert("เกิดข้อผิดพลาด กรุณาสมัครใหม่อีกครั้ง");
                window.location = "register.php";
            </script>
        <?php
    }
?>