<?php
include('server.php');
error_reporting(E_ERROR | E_PARSE);
if (isset($_REQUEST['btn_submit'])) {
    $username = $_REQUEST['txt_username'];
    $password = $_REQUEST['txt_password'];
    $confirm_password = $_REQUEST['txt_confirm_password'];
    $Fname = $_REQUEST['txt_Fname'];
    $Lname = $_REQUEST['txt_Lname'];
    $line = $_REQUEST['txt_email'];
    $phone = $_REQUEST['txt_phone'];




    $sql_user = "SELECT * FROM user WHERE username = '$username'";
    $query_user = mysqli_query($conn, $sql_user);
    $num_user = mysqli_num_rows($query_user);

    if ($num_user == 0) {
        if ($password == $confirm_password) {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);


            $sql = "INSERT INTO user (username,password,phone,line,Fname,Lname)
            VALUES ('$username','$hashed_password','$phone','$line','$Fname','$Lname')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                $successMsg = "สมัครสมาชิกเสร็จสิ้น";
                $_SESSION['username'] = $username;
                header('refresh:2;user/main_page.php');
            }
        } else {
            $errorMsg = "กรุณากรอกรหัสผ่านให้ตรงกัน";
        }
    } else {
        $errorMsg = "ชื่อผู้ใช้ถูกใช้ไปแล้ว";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php include('../web-structure/title_name.php') ?></title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/font.css" rel="stylesheet" />
</head>

<body>

</body>

</html>
<?php
if (isset($successMsg)) { ?>
    <script>
        let timerInterval
        Swal.fire({
            title: 'สมัครสมาชิกเสร็จสิ้น',
            // html: 'รอสักครู่ <b></b>',
            timer: 2100,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
            }
        })
    </script>

<?php }    ?>