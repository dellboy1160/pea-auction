<?php
include('server.php');
if (isset($_REQUEST['btn_submit'])) {
    $username = $_REQUEST['txt_username'];
    $password = $_REQUEST['txt_password'];

    $sql = "SELECT * FROM user WHERE username = '$username'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    $num = mysqli_num_rows($query);

    if ($num != 0) {
        $hashed_password = $result['password'];

        if (password_verify($password, $hashed_password)) {


            $_SESSION['username'] = $username;
            header('refresh:2;user/main_page.php');
            $successMsg = "เข้าสู่ระบบเสร็จสิ้น";
        } else {
            $errorMsg = "ตรวจสอบข้อมูลให้ถูกต้อง";
        }
    } else {
        $errorMsg = "ตรวจสอบข้อมูลให้ถูกต้อง";
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
    <title><?php include('web-structure/title_name.php') ?></title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="user/css/styles.css" rel="stylesheet" />
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link href="css/font.css" rel="stylesheet" />
</head>

<body>
    <?php include('web-structure/navbar.php'); ?>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-md-4">
                <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="margin-top: 50px;">
                    <div class="card-body">
                        <div class="col-md-12">
                            <h3 class="text-center ">เข้าสู่ระบบ</h3>
                        </div>
                        <?php
                        if (isset($errorMsg)) { ?>
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong><?php echo $errorMsg ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } elseif (isset($successMsg)) { ?>
                            <script>
                                let timerInterval
                                Swal.fire({
                                    title: 'เข้าสู่ระบบเสร็จสิ้น',
                                    // html: 'รอสักครู่ <b></b>',
                                    timer: 2010,
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
                        <?php } ?>

                        <form action="" class="row g-3 needs-validation" method="POST" novalidate>

                            <div class="col-md-12 mt-5">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" name="txt_username" id="validationCustomUsername" placeholder="ชื่อผู้ใช้" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอกชื่อผู้ใช้
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" name="txt_password" id="validationCustomUsername" placeholder="รหัสผ่าน " aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอกรหัสผ่าน
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary mt-5" name="btn_submit" style="width: 100%;">เข้าสู่ระบบ</button>

                            <div class="col-md-12 text-center mt-2">
                                <a href="register.php" class="text-center">สมัครสมาชิก</a>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="user/js/scripts.js"></script>


    <script src="js/validation.js"></script>
</body>

</html>