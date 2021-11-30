<?php
include('server.php');

// if (isset($_REQUEST['btn_submit'])) {
//     $username = $_REQUEST['txt_username'];
//     $password = $_REQUEST['txt_password'];
//     $confirm_password = $_REQUEST['txt_confirm_password'];
//     $Fname = $_REQUEST['txt_Fname'];
//     $Lname = $_REQUEST['txt_Lname'];
//     $email = $_REQUEST['txt_email'];
//     $phone = $_REQUEST['txt_phone'];



//     $sql_user = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
//     $query_user = mysqli_query($conn, $sql_user);
//     $num_user = mysqli_num_rows($query_user);

//     if ($num_user == 0) {
//         if ($password == $confirm_password) {

//             $hashed_password = password_hash($password, PASSWORD_DEFAULT);


//             $sql = "INSERT INTO user (username,password,phone,email,Fname,Lname)
//             VALUES ('$username','$hashed_password','$phone','$email','$Fname','$Lname')";
//             $query = mysqli_query($conn, $sql);
//             if ($query) {
//                 $successMsg = "สมัครสมาชิกเสร็จสิ้น";
//                 $_SESSION['username'] = $username;
//                 header('refresh:2;user/main_page.php');
//             }
//         } else {
//             $errorMsg = "กรุณากรอกรหัสผ่านให้ตรงกัน";
//         }
//     } else {
//         $errorMsg = "ชื่อผู้ใช้ หรือ อีเมลถูกใช้ไปแล้ว";
//     }
// }
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery.signature.css">
    <link rel="stylesheet" type="text/css" href="user/signature/jquery.signature.css">
    <link href="css/font.css" rel="stylesheet" />
    <style>
        .kbw-signature {
            width: 100%;
            height: 300px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }
    </style>

</head>

<body>
    <?php include('web-structure/navbar.php'); ?>
    <?php
    if (isset($successMsg)) { ?>
        <script>
            let timerInterval
            Swal.fire({
                title: 'สมัครสมาชิกเสร็จสิ้น',
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

    <?php }    ?>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-md-8">
                <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="margin-top: 50px;">
                    <div class="card-body">
                        <div class="col-md-12">
                            <h3 class="text-center ">สมัครสมาชิก</h3>
                        </div>
                        <?php if (isset($errorMsg)) { ?>

                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong> <?php echo $errorMsg ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>

                        <form action="register_db.php" class="row g-3 needs-validation" method="POST" novalidate>

                            <div class="col-md-12 mt-5">
                                <label for="validationCustomUsername" class="form-label">ชื่อผู้ใช้</label>

                                <div class="input-group has-validation">

                                    <input type="text" class="form-control" name="txt_username" id="validationCustomUsername" value="<?php if (isset($username)) {
                                                                                                                                            echo $username;
                                                                                                                                        } ?>" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอกชื่อผู้ใช้
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="validationCustomUsername" class="form-label">รหัสผ่าน</label>

                                <div class="input-group has-validation">

                                    <input type="password" class="form-control" name="txt_password" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอกรหัสผ่าน
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustomUsername" class="form-label">ยืนยันรหัสผ่าน</label>

                                <div class="input-group has-validation">

                                    <input type="password" class="form-control" name="txt_confirm_password" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอกยืนรหัสผ่าน
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="validationCustomUsername" class="form-label">ชื่อ</label>

                                <div class="input-group has-validation">

                                    <input type="text" class="form-control" name="txt_Fname" id="validationCustomUsername" value="<?php if (isset($Fname)) {
                                                                                                                                        echo $Fname;
                                                                                                                                    } ?>" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอกชื่อ
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustomUsername" class="form-label">นามสกุล</label>

                                <div class="input-group has-validation">

                                    <input type="text" class="form-control" name="txt_Lname" id="validationCustomUsername" value="<?php if (isset($Lname)) {
                                                                                                                                        echo $Lname;
                                                                                                                                    } ?>" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอกนามสกุล
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="validationCustomUsername" class="form-label">Line ID (ถ้ามี)</label>

                                <div class="input-group has-validation">

                                    <input type="text" class="form-control" name="txt_line" id="validationCustomUsername" value="<?php if (isset($email)) {
                                                                                                                                        echo $email;
                                                                                                                                    } ?>" aria-describedby="inputGroupPrepend">
                                    <div class="invalid-feedback">
                                        กรุณากรอกอีเมล
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustomUsername" class="form-label">เบอร์โทรศัพท์</label>

                                <div class="input-group has-validation">

                                    <input type="text" class="form-control" name="txt_phone" id="validationCustomUsername" value="<?php if (isset($phone)) {
                                                                                                                                        echo $phone;
                                                                                                                                    } ?>" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอกเบอร์โทรศัพท์
                                    </div>
                                </div>
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    ข้อมูลถูกต้องครบถ้วน
                                </label>
                            </div>
                            <button class="btn btn-primary mt-5" name="btn_submit" style="width: 100%;">สมัครสมาชิก</button>


                            <style>
                                a {
                                    text-decoration: none !important;
                                }
                            </style>
                            <div class="col-md-12 text-center mt-2">
                                <a href="login.php" class="text-center">เข้าสู่ระบบ</a>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="user/js/scripts.js"></script>


    <script src="js/validation.js"></script>
</body>

</html>

<script type="text/javascript">
    var sig = $('#sig').signature({
        syncField: '#signature64',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>