<?php
    session_start();
    include('connect_db.php');

    $a_id = $_SESSION['a_id'];

    $a_name = $_POST['a_name'];
    $a_email = $_POST['a_email'];
    $a_pass = $_POST['a_pass'];

    $a_img = $_FILES['a_img']['name'];
    $a_img_path = $_FILES['a_img']['tmp_name'];

    if($a_img == '') {
        $sql = "UPDATE tb_admin SET
        a_name = '$a_name',
        a_email = '$a_email',
        a_pass = '$a_pass'
        WHERE a_id = '$a_id'";
    }else {
        $sql = "UPDATE tb_admin SET
        a_name = '$a_name',
        a_email = '$a_email',
        a_pass = '$a_pass',
        a_img = '$a_img'
        WHERE a_id = '$a_id'";
    }

    $rs = $conn->query($sql);

    if ($rs) {
    if ($a_img != '') {
        move_uploaded_file($a_img_path, "../img/" . $a_img);
    }
        ?>
        <script language="javascript">
            alert("แก้ไขข้อมูลสำเร็จ");
            window.location = "profile_a.php";
        </script>
        <?php
    } else {
        echo "ไม่สามารถแก้ไขได้ครับ" . $conn->error;
        echo $sql;
        exit();
    }

$conn->close();
?>