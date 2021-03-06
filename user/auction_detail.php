<?php
include('../server.php');
include('../ThaiDateFunction.php');
include('../encrypt_decrypt_function.php');
if (!isset($_SESSION['username'])) {
    header('location: ../index.php');
}

if (isset($_REQUEST['auctionID'])) {
    $encrypt = $_REQUEST['auctionID'];
    $auctionID = encrypt_decrypt($encrypt, 'decrypt');
    $today = date("Y-m-d H:i:s");

    $username = $_SESSION['username'];
    $sql_users = "SELECT * FROM user WHERE username = '$username'";
    $query_users = mysqli_query($conn, $sql_users);
    $result_users = mysqli_fetch_array($query_users);

    $user_id = $result_users['user_id'];
    $sql_auctionDetail = "SELECT * FROM auction_detail WHERE user_id = $user_id AND auctionID = $auctionID";
    $query_auctionDetail = mysqli_query($conn, $sql_auctionDetail);
    $num_auctionDetail = mysqli_num_rows($query_auctionDetail);

    if ($num_auctionDetail >= 1) {
        echo "<script>
alert('คุณลงชื่อไปแล้ว');
window.location.href='auction.php';
</script>";
    }
}

if (isset($_REQUEST['btn_submit'])) {
    $auctionID = $_REQUEST['txt_auctionID'];
    $userID = $_REQUEST['txt_user_id'];

    // $bidPrice = $_REQUEST['txt_bid'];
    $today = date("Y-m-d H:i:s");

    // สำเนาบัตรประชาชน
    $image_file = $_FILES['txt_file']['name'];
    $type = $_FILES['txt_file']['type'];
    $size = $_FILES['txt_file']['size'];
    $temp = $_FILES['txt_file']['tmp_name'];

    $path = "../copy/" . $image_file;
    $explode = explode('.', $_FILES['txt_file']['name']);
    $new_name = round(microtime(true)) . '1.' . end($explode);


    if (empty($new_name)) {
        $errorMsg = "กรุณาเลือกรูปภาพ";
    } else if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png") {
        if (!file_exists($path)) {
            if ($size < 5000000) {
            } else {
                $errorMsg = "ไฟล์รูปภาพใหญ่เกิน 5MB";
            }
        }
    } else {
        $errorMsg = "กรุณาใช้นามสกุลไฟล์เป็น JPG, JPEG, PNG เท่านั้น";
    }
    // End of สำเนาบัตรประชาชน

    // สำเนาทะเบียนบ้าน
    // $image_file2 = $_FILES['txt_file2']['name'];
    // $type2 = $_FILES['txt_file2']['type'];
    // $size2 = $_FILES['txt_file2']['size'];
    // $temp2 = $_FILES['txt_file2']['tmp_name'];

    // $path2 = "../copy/" . $image_file2;
    // $explode2 = explode('.', $_FILES['txt_file2']['name']);
    // $new_name2 = round(microtime(true)) . '2.' . end($explode2);


    // if (empty($new_name2)) {
    //     $errorMsg = "กรุณาเลือกรูปภาพ";
    // } else if ($type2 == "image/jpg" || $type2 == 'image/jpeg' || $type2 == "image/png") {
    //     if (!file_exists($path2)) {
    //         if ($size2 < 5000000) {
    //         } else {
    //             $errorMsg = "ไฟล์รูปภาพใหญ่เกิน 5MB";
    //         }
    //     }
    // } else {
    //     $errorMsg = "กรุณาใช้นามสกุลไฟล์เป็น JPG, JPEG, PNG เท่านั้น";
    // }
    // End of สำเนาบัตรประชาชน

    // สำเนาใบทะเบียนพาณิชย์
    $image_file3 = $_FILES['txt_file3']['name'];
    $type3 = $_FILES['txt_file3']['type'];
    $size3 = $_FILES['txt_file3']['size'];
    $temp3 = $_FILES['txt_file3']['tmp_name'];

    $path3 = "../copy/" . $image_file3;
    $explode3 = explode('.', $_FILES['txt_file3']['name']);
    $new_name3 = round(microtime(true)) . '3.' . end($explode3);


    if (empty($_FILES['txt_file3']['name'])) {
        echo $new_name3 = "";
    } else {
        if ($type3 == "image/jpg" || $type3 == 'image/jpeg' || $type3 == "image/png") {
            if (!file_exists($path3)) {
                if ($size3 < 5000000) {
                } else {
                    $errorMsg = "ไฟล์รูปภาพใหญ่เกิน 5MB";
                }
            }
        } else {
            $errorMsg = "กรุณาใช้นามสกุลไฟล์เป็น JPG, JPEG, PNG เท่านั้น";
        }
    }
    // End of สำเนาใบทะเบียนพาณิชย์

    if (!isset($errorMsg)) {
        move_uploaded_file($temp, '../copy/' . $new_name);
        // move_uploaded_file($temp2, '../copy/' . $new_name2);
        move_uploaded_file($temp3, '../copy/' . $new_name3);
        $today = date("Y-m-d H:i:s");
        $sql = "INSERT INTO auction_detail (auctionID,user_id,signDate,idCardImage,commercialRegistrationImage,auctionDetailStatus)
        VALUES ('$auctionID','$userID','$today','$new_name','$new_name3','unCheck')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $successMsg = "";
        }
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
    <link href="../css/font.css" rel="stylesheet" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.view_data').click(function() {
                var imageID = $(this).attr("id");
                $.ajax({
                    url: "select.php",
                    method: "post",
                    data: {
                        imageID: imageID
                    },
                    success: function(data) {
                        $('#employee_detail').html(data);
                        $('#dataModal').modal("show");
                    }
                });
            });
        });
    </script>

</head>

<body>
    <?php if (isset($successMsg)) { ?>
        <script>
            Swal.fire(
                'ลงชื่อเรียบร้อย',
                '',
                'success',


            ).then(function() {
                window.location = "profile.php?act=auction_list";
            });
        </script>
    <?php } ?>

    <?php if (isset($errorMsg)) { ?>

        <script>
            var errorMsg = '<?php echo $errorMsg; ?>';
            Swal.fire(
                errorMsg,
                '',
                'error',
            )
        </script>
    <?php } ?>

    <?php
    try {
        $sql = "SELECT * FROM auction WHERE auctionID = $auctionID";
        $query = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($query);
        $result = mysqli_fetch_array($query);
        if ($num == 0) {
            $error = "ไม่มีข้อมูลนี้อยู่";
        }
    } catch (Error  $e) {
        $error = "ไม่มีข้อมูลนี้อยู่";
    }
    ?>


    <?php
    if (isset($error)) {
    ?>
        <script type="text/javascript">
            var error = '<?php echo $error; ?>';
            Swal.fire(
                error,
                '',
                'error'
            ).then(function() {
                window.location = "main_page.php";
            });
        </script>
    <?php exit();
    } ?>



    <?php include('../web-structure/user_navbar.php') ?>
    <!-- Page content-->
    <div class="container">
        <div class="text-center mt-5">
            <h1>ลงชื่อประมูล</h1>
            <hr>
        </div>
        <div class="row">





            <?php
            $auctionID = $result['auctionID'];
            $sql_image = "SELECT * FROM auction_image WHERE auctionID = $auctionID";
            $query_image = mysqli_query($conn, $sql_image);
            ?>


            <div class="col-md-6" style="text-align: center;">

                <?php while ($row = mysqli_fetch_array($query_image)) {  ?>
                    <a class="view_data" type="button" name="view" id="<?php echo $row["imageID"]; ?>"><img class="shadow p-3 mb-5 bg-body rounded" src="../admin/auction_image/<?php echo $row['imageFile'] ?>" width="200px" height="200px" halt=""></a>

                <?php }  ?>

                <!-- <?php while ($row = mysqli_fetch_array($query_image)) { ?>

                <?php } ?> -->
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="width: auto;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $result['auctionTitle'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">เริ่มต้น <?php echo number_format($result['auctionStartPrice'], 2) ?> บาท</h6>
                        <p class="card-text"><?php echo $result['auctionDetail'] ?> </p>

                        <?php

                        $startDate = $result['auctionStartDate'];
                        $endDate = $result['auctionEndDate'];

                        $start = DateThaiStart($startDate);
                        $end =  DateThaiEnd($endDate);
                        ?>
                        <hr>
                        <p class="card-text">วันเริ่มประมูล : <?php echo $start  ?> </p>
                        <p class="card-text">วันปิดประมูล : <?php echo $end  ?> </p>
                        <hr>
                    </div>
                </div>
                <?php
                $username = $_SESSION['username'];
                $sql_user = "SELECT * FROM user WHERE username = '$username'";
                $query_user = mysqli_query($conn, $sql_user);
                $result_user = mysqli_fetch_array($query_user);
                ?>
                <form action="" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                    <input type="text" hidden name="txt_auctionID" value="<?php echo $auctionID; ?>">
                    <input type="text" hidden name="txt_user_id" value="<?php echo $result_user['user_id'] ?>">

                    <div class="col-md-12">
                        <label for="validationCustomUsername" class="form-label">รูปสำเนาบัตร
                            <!-- Button trigger modal -->
                            <a type="button" href="" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                ตัวอย่าง
                            </a>
                        </label>
                        <div class="input-group has-validation">
                            <input type="file" class="form-control" name="txt_file" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                กรุณากรอกรูปสำเนาบัตร
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-12">
                        <label for="validationCustomUsername" class="form-label">รูปสำเนาทะเบียนบ้าน
                            <a type="button" href="" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                ตัวอย่าง
                            </a>
                        </label>
                        <div class="input-group has-validation">
                            <input type="file" class="form-control" name="txt_file2" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                กรุณากรอกรูปสำเนาทะเบียนบ้าน
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-12">
                        <label for="validationCustomUsername" class="form-label">รูปสำเนาใบทะเบียนพาณิชย์ (ถ้ามี)

                        </label>
                        <div class="input-group has-validation">
                            <input type="file" class="form-control" name="txt_file3" id="validationCustomUsername" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                ข้อมูลถูกต้องครบถ้วน
                            </label>
                        </div>
                    </div>
                    <button type="submit" name="btn_submit" class="btn btn-primary" style="width: 100%;">ลงชื่อ</button>

                </form>
            </div>
        </div>
    </div>






    <section style="height: 30vh;"></section>

    <div id="dataModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title">รูปภาพ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="employee_detail">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>








    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ตัวอย่างสำเนาบัตร</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../web-structure/A1.png" width="100%" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ตัวอย่างสำเนาทะเบียนบ้าน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../web-structure/home.jpg" width="100%" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ตัวอย่างสำเนาใบทะเบียนพาณิชย์</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>




    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="../js/validation.js"></script>
</body>

</html>