<?php
include('../server.php');
include('../encrypt_decrypt_function.php');
if (!isset($_SESSION['username'])) {
    header('location: ../index.php');
}

if (isset($_REQUEST['detailID'])) {
    $encrypt = $_REQUEST['detailID'];
    $detailID = encrypt_decrypt($encrypt, 'decrypt');

    try {
        $sql_detail = "SELECT * FROM auction_detail WHERE detailID = $detailID";
        $query_detail = mysqli_query($conn, $sql_detail);
        $num_detail = mysqli_num_rows($query_detail);
        $result_detail = mysqli_fetch_array($query_detail);

        if ($num_detail == 0) {
            $error = "ไม่มีข้อมูลนี้อยู่";
        }

        if (isset($_REQUEST['auctionID'])) {
            $encrypt = $_REQUEST['auctionID'];
            $auctionID = encrypt_decrypt($encrypt, 'decrypt');
            $sql_auction = "SELECT * FROM auction WHERE auctionID = $auctionID";
            $query_auction = mysqli_query($conn, $sql_auction);
            $num_auction = mysqli_num_rows($query_auction);
            $result_auction = mysqli_fetch_array($query_auction);

            if ($num_auction == 0) {
                $error = "ไม่มีข้อมูลนี้อยู่";
            }
        }
    } catch (Error  $e) {
        $error = "ไม่มีข้อมูลนี้อยู่";
    }

    $today = date("Y-m-d H:i:s");
    if (isset($_REQUEST['btn_submit'])) {
        $encrypt1 = $_REQUEST['detailID'];
        $encrypt2 = $_REQUEST['txt_auctionID'];

        $detailID =   encrypt_decrypt($encrypt1, 'decrypt');
        $auctionID =  encrypt_decrypt($encrypt2, 'decrypt');
        // $bidPrice = $_REQUEST['txt_bid'];


        // รูปใบเสนอราคา ส่วนที่ 1
        $image_file = $_FILES['txt_file']['name'];
        $type = $_FILES['txt_file']['type'];
        $size = $_FILES['txt_file']['size'];
        $temp = $_FILES['txt_file']['tmp_name'];

        $path = "../offer_price_img/" . $image_file;
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
        // End of รูปใบเสนอราคา ส่วนที่ 1

        // รูปใบเสนอราคา ส่วนที่ 2
        $image_file2 = $_FILES['txt_file2']['name'];
        $type2 = $_FILES['txt_file2']['type'];
        $size2 = $_FILES['txt_file2']['size'];
        $temp2 = $_FILES['txt_file2']['tmp_name'];

        $path2 = "../offer_price_img/" . $image_file2;
        $explode2 = explode('.', $_FILES['txt_file2']['name']);
        $new_name2 = round(microtime(true)) . '2.' . end($explode2);


        if (empty($new_name2)) {
            $errorMsg = "กรุณาเลือกรูปภาพ";
        } else if ($type2 == "image/jpg" || $type2 == 'image/jpeg' || $type2 == "image/png") {
            if (!file_exists($path2)) {
                if ($size2 < 5000000) {
                } else {
                    $errorMsg = "ไฟล์รูปภาพใหญ่เกิน 5MB";
                }
            }
        } else {
            $errorMsg = "กรุณาใช้นามสกุลไฟล์เป็น JPG, JPEG, PNG เท่านั้น";
        }
        // End of รูปใบเสนอราคา ส่วนที่ 2

        // รูปใบเสนอราคา ส่วนที่ 3
        $image_file3 = $_FILES['txt_file3']['name'];
        $type3 = $_FILES['txt_file3']['type'];
        $size3 = $_FILES['txt_file3']['size'];
        $temp3 = $_FILES['txt_file3']['tmp_name'];

        $path3 = "../offer_price_img/" . $image_file3;
        $explode3 = explode('.', $_FILES['txt_file3']['name']);
        $new_name3 = round(microtime(true)) . '3.' . end($explode3);


        if (empty($new_name3)) {
            $errorMsg = "กรุณาเลือกรูปภาพ";
        } else if ($type3 == "image/jpg" || $type3 == 'image/jpeg' || $type3 == "image/png") {
            if (!file_exists($path3)) {
                if ($size3 < 5000000) {
                } else {
                    $errorMsg = "ไฟล์รูปภาพใหญ่เกิน 5MB";
                }
            }
        } else {
            $errorMsg = "กรุณาใช้นามสกุลไฟล์เป็น JPG, JPEG, PNG เท่านั้น";
        }
        // End of รูปใบเสนอราคา ส่วนที่ 3

        // รูปใบเสนอราคา ส่วนที่ 4
        $image_file4 = $_FILES['txt_file4']['name'];
        $type4 = $_FILES['txt_file4']['type'];
        $size4 = $_FILES['txt_file4']['size'];
        $temp4 = $_FILES['txt_file4']['tmp_name'];

        $path4 = "../offer_price_img/" . $image_file4;
        $explode4 = explode('.', $_FILES['txt_file4']['name']);
        $new_name4 = round(microtime(true)) . '4.' . end($explode4);


        if (empty($new_name3)) {
            $errorMsg = "กรุณาเลือกรูปภาพ";
        } else if ($type4 == "image/jpg" || $type4 == 'image/jpeg' || $type4 == "image/png") {
            if (!file_exists($path4)) {
                if ($size4 < 5000000) {
                } else {
                    $errorMsg = "ไฟล์รูปภาพใหญ่เกิน 5MB";
                }
            }
        } else {
            $errorMsg = "กรุณาใช้นามสกุลไฟล์เป็น JPG, JPEG, PNG เท่านั้น";
        }
        // End of รูปใบเสนอราคา ส่วนที่ 4

        if (!isset($errorMsg)) {
            move_uploaded_file($temp, '../offer_price_img/' . $new_name);
            move_uploaded_file($temp2, '../offer_price_img/' . $new_name2);
            move_uploaded_file($temp3, '../offer_price_img/' . $new_name3);
            move_uploaded_file($temp4, '../offer_price_img/' . $new_name4);

            $today = date("Y-m-d H:i:s");
            $sql = "INSERT INTO offer_price (detailID,auctionID,offerPriceDocImage,offerPriceDocImage2,offerPriceDocImage3,paymentImage,offerDate,paymentStatus)
            VALUES ('$detailID','$auctionID','$new_name','$new_name2','$new_name3','$new_name4','$today','unCheck')";
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
                'บันทึกเรียบร้อย',
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
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <h1>เสนอราคา</h1>
                <?php
                $sql = "SELECT * FROM document_offerprice";
                $query = mysqli_query($conn, $sql);
                ?>
                <br>
                <?php while ($result = mysqli_fetch_array($query)) { ?>
                    <!-- <a target="_blank" href="../admin/document/<?php echo $result['documentFile'] ?>"><i class="far fa-file-pdf" style="color: red;"></i> ดาวโหลด<?php echo $result['documentTitle'] ?></a> -->
                <?php } ?>
                <br>

                <hr>
                <br>

            </div>


            <div class="col-md-6">
                <?php
                $sql_bank = "SELECT * FROM bank";
                $query_bank = mysqli_query($conn, $sql_bank);
                ?>
                <div class="card shadow-sm p-3 mb-5 bg-body rounded mt-4" style="width:100%;">
                    <div class="card-body">
                        <h3 class="card-title text-center">ช่องทางการชำระ</h3>
                        <?php while ($result_bank = mysqli_fetch_array($query_bank)) { ?>
                            <h6 class="card-text text-center mb-2 ">
                                ธนาคาร : <?php echo $result_bank['bankName'] ?>,
                                <?php echo $result_bank['bankHolder'] ?>,
                                เลขบ/ช : <?php echo $result_bank['bankNumber'] ?></h6>
                            <h6 class="text-center mt-5">QR Code Payment</h6>
                            <img style="display: block; margin-left: auto; margin-right: auto; width:200px" src="../QRCode_image/<?php echo $result_bank['QRCode_image'] ?>" style="width: 200px;" alt="">
                            <hr>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form action="" method="POST" class="row needs-validation" enctype="multipart/form-data" novalidate>

                    <input type="text" hidden name="txt_auctionID" value="<?php echo $_REQUEST['auctionID'] ?>">
                    <div class="col-md-12">
                        <label for="validationCustom03" class="form-label">รูปใบเสนอราคา ส่วนที่ 1

                            <!-- Button trigger modal -->
                            <a type="button" href="" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                ตัวอย่าง
                            </a>
                        </label>
                        <input type="file" name="txt_file" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            กรุณากรอกรูปใบเสนอราคา
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="validationCustom03" class="form-label">รูปใบเสนอราคา ส่วนที่ 2
                            <!-- Button trigger modal -->
                            <a type="button" href="" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                ตัวอย่าง
                            </a>

                        </label>
                        <input type="file" name="txt_file2" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            กรุณากรอกรูปใบเสนอราคา
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="validationCustom03" class="form-label">รูปใบเสนอราคา ส่วนที่ 3
                            <!-- Button trigger modal -->
                            <a type="button" href="" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                                ตัวอย่าง
                            </a>

                        </label>
                        <input type="file" name="txt_file3" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            กรุณากรอกรูปใบเสนอราคา
                        </div>
                    </div>


                    <div class="col-md-12 mt-3">
                        <label for="validationCustom03" class="form-label">รูปหลักฐานการชำระเงิน
                            <!-- Button trigger modal -->
                            <a type="button" href="" data-bs-toggle="modal" data-bs-target="#exampleModal4">
                                ตัวอย่าง
                            </a>

                        </label>
                        <input type="file" name="txt_file4" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            กรุณากรอกหลักฐานการชำระเงิน
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <hr class="mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                ข้อมูลถูกต้องครบถ้วน
                            </label>

                        </div>
                    </div>



                    <div class="col-md-12 mt-3">
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle"></i> เงินมัดจำไม่น้อยกว่าร้อยละ 5 ของราคาประเมิน
                        </div>
                    </div>





                    <div class="col-md-12 mt-3">
                        <button type="submit" name="btn_submit" class="btn btn-primary mb-3" style="width: 100%;">บันทึก</button>
                    </div>

                </form>
            </div>
            <hr>
            <a href="profile.php?act=auction_list" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
        </div>

    </div>
    <section style="height: 30vh;"></section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ตัวอย่างใบเสนอราคา</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../web-structure/D1.png" width="100%" alt="">
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
                    <h5 class="modal-title" id="exampleModalLabel">ตัวอย่างใบเสนอราคา</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../web-structure/D2.png" width="100%" alt="">
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
                    <h5 class="modal-title" id="exampleModalLabel">ตัวอย่างใบเสนอราคา</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../web-structure/D3.png" width="100%" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ตัวอย่างการชำระเงิน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../web-structure/D4.jpg" width="100%" alt="">
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="../js/validation.js"></script>
    <script src="../admin/js/dataTable.js"></script>
</body>

</html>