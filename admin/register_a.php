<?php
    session_start();
    include('connect_db.php');

    $a_name = $_POST['a_name'];
    $a_email = $_POST['a_email'];
    $a_pass = $_POST['a_pass'];
    $a_img = $_FILES['a_img']['name'];
    $a_img_path = $_FILES['a_img']['tmp_name'];

    $sql = "INSERT INTO tb_admin(a_name, a_email, a_pass, a_img)
            VALUES('$a_name', '$a_email', '$a_pass', '$a_img')";

    $rs = $conn->query($sql);

    if($rs) { 
            move_uploaded_file($a_img_path, "../img/" . $a_img);
        ?>
        <script>
            alert("การสมัครสำเร็จ");
            window.location = "login.php";
        </script>
        <?php
    }else { ?>
        <script>
            alert("เกิดการผิดพลาด กรุณาสมัครอีกครั้ง");
            window.location = "register.php";
        </script>
        <?php
    }
?>