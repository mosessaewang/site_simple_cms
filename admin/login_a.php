<?php
    session_start();
    include('connect_db.php');

    $a_name = $_POST['a_name'];
    $a_pass = $_POST['a_pass'];

    $sql = "SELECT * FROM tb_admin WHERE a_name = '$a_name' AND a_pass = '$a_pass'";
    $rs = $conn->query($sql);
    $r = $rs->fetch_object();

    if($rs->num_rows > 0){
        $_SESSION['a_id'] = $r->a_id;
        $_SESSION['a_name'] = $r->a_name;
        header("location:index.php");
    }else{ ?>
                    <script language="javascript">
                    alert("ข้อมูลไม่ถูกต้อง กรุณากลับไปกรอกข้อมูลใหม่");
                    window.location = "login.php";
                    </script>
<?php } ?>