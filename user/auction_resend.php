<?php
include('../server.php');
include('../encrypt_decrypt_function.php');

error_reporting(E_ERROR | E_PARSE);
if (!isset($_SESSION['username'])) {
    header('location: ../index.php');
}

if (isset($_REQUEST['detailID'])) {
    $encrypt = $_REQUEST['detailID'];
    $detailID = encrypt_decrypt($encrypt, 'decrypt');
    try {
        $sql = "SELECT * FROM auction_detail WHERE detailID = $detailID";
        $query = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($query);
        $result = mysqli_fetch_array($query);
        if ($num == 0) {
            $error = "ไม่มีข้อมูลนี้อยู่";
        }
    } catch (Error  $e) {
        $error = "ไม่มีข้อมูลนี้อยู่";
    }

    if (isset($_REQUEST['btn_submit'])) {
        // สำเนาบัตรประชาชน
        $image_file = $_FILES['txt_file']['name'];
        $type = $_FILES['txt_file']['type'];
        $size = $_FILES['txt_file']['size'];
        $temp = $_FILES['txt_file']['tmp_name'];

        $path = "../copy/" . $image_file;
        // $directory = "../copy/";
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
        // End of สำเนาทะเบียนบ้าน

        // สำเนาใบทะเบียนพาณิชย์
        $image_file3 = $_FILES['txt_file3']['name'];
        $type3 = $_FILES['txt_file3']['type'];
        $size3 = $_FILES['txt_file3']['size'];
        $temp3 = $_FILES['txt_file3']['tmp_name'];

        $path3 = "../copy/" . $image_file3;
        // $directory = "../copy/";
        $explode3 = explode('.', $_FILES['txt_file3']['name']);
        $new_name3 = round(microtime(true)) . '3.' . end($explode3);


        if (empty($_FILES['txt_file3']['name'])) {
            $new_name3 = "";
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
            unlink('../copy/' . $result['idCardImage']); //ลบไฟล์ก่อนหน้า แล้วค่อยอัพเดท 
            move_uploaded_file($temp, '../copy/' . $new_name);
            // unlink('../copy/' . $result['houseRegistrationImage']); //ลบไฟล์ก่อนหน้า แล้วค่อยอัพเดท 
            // move_uploaded_file($temp2, '../copy/' . $new_name2);
            unlink('../copy/' . $result['commercialRegistrationImage']); //ลบไฟล์ก่อนหน้า แล้วค่อยอัพเดท 
            move_uploaded_file($temp3, '../copy/' . $new_name3);

            $sql = "UPDATE auction_detail SET idCardImage = '$new_name',
            commercialRegistrationImage = '$new_name3',
            auctionDetailStatus = 'unCheck'
            WHERE detailID = $detailID
            
            ";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                $successMsg = "";
            }
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
</head>

<body>

    <?php if (isset($successMsg)) { ?>
        <script>
            Swal.fire(
                'บันทึกข้อมูลเรียบร้อย',
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



        <h1 class="text-center mt-5">เอกสารสำเนา</h1>
        <hr>
        <form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">รูปสำเนาบัตร

                    <!-- Button trigger modal -->
                    <a type="button" href="" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                        ตัวอย่าง
                    </a>
                </label>
                <div class="input-group has-validation">
                    <input type="file" name="txt_file" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกรูปสำเนาบัตร
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>

           
            <!-- <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">รูปสำเนาทะเบียนบ้าน
                
                    <a type="button" href="" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                        ตัวอย่าง
                    </a>
                </label>
                <div class="input-group has-validation">
                    <input type="file" name="txt_file2" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกรูปสำเนาทะเบียนบ้าน
                    </div>
                </div>
            </div> -->
         
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">รูปสำเนาใบทะเบียนพาณิชย์ (ถ้ามี)</label>
                <div class="input-group has-validation">
                    <input type="file" name="txt_file3" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend">
                    <div class="invalid-feedback">
                        กรุณากรอกรูปสำเนาใบทะเบียนพาณิชย์
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>

            <div class="col-md-3"></div>
            <div class="col-md-6"><button type="submit" name="btn_submit" class="btn btn-primary" style="width: 100%;">บันทึก</button></div>
            <div class="col-md-3"></div>
            <hr>
            <a href="profile.php?act=auction_list" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
        </form>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ตัวอย่างสำเนาบัตรประชาชน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../web-structure/idCard1.png" width="100%" alt="">
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

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->

    <script src="../js/validation.js"></script>
    <script src="js/scripts.js"></script>

</body>

</html>