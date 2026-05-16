<?php
    session_start();
    include('connect_db.php');

    $m_user = $_POST['m_user'];
    $m_pass = $_POST['m_pass'];

    $sql = "SELECT * FROM tb_member WHERE m_user = '$m_user' AND m_pass = '$m_pass'";
    $rs = $conn->query($sql);
    $r = $rs->fetch_object();

    if($rs->num_rows > 0){
        $_SESSION['m_id'] = $r->m_id;
        $_SESSION['m_user'] = $r->m_user;
        header("location:index.php");
    }else{ ?>
                    <script language="javascript">
                    alert("ข้อมูลไม่ถูกต้อง กรุณากลับไปกรอกข้อมูลใหม่");
                    window.location = "login.php";
                    </script>
<?php } ?>