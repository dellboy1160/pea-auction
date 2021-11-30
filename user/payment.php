<?php
include('../server.php');
include('../ThaiDateFunction.php');
if (!isset($_SESSION['username'])) {
    header('location: ../index.php');
}

if (isset($_REQUEST['detailID'])) {
    $detailID = $_REQUEST['detailID'];
}
if (isset($_REQUEST['btn_submit'])) {
    $detailID = $_REQUEST['detailID'];


    $image_file = $_FILES['txt_file']['name'];
    $type = $_FILES['txt_file']['type'];
    $size = $_FILES['txt_file']['size'];
    $temp = $_FILES['txt_file']['tmp_name'];

    $path = "../payment_image/" . $image_file;
    $directory = "../payment_image/";

    $explode = explode('.', $_FILES['txt_file']['name']);
    $new_name = round(microtime(true)) . '.' . end($explode);

    if ($image_file) {
        if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png") {
            if (!file_exists($path)) {
                if ($size < 2000000) {

                    move_uploaded_file($temp, '../payment_image/' . $new_name);
                } else {
                    $errorMsg = "ไฟล์รูปภาพใหญ่เกิน 2MB";
                }
            } else {
                $errorMsg = "File name already exists...";
            }
        } else {
            $errorMsg = "กรุณาใช้นามสกุลไฟล์เป็น JPG, JPEG, PNG เท่านั้น";
        }
    } else {
        $new_name = $row['image'];
    }

    if (!isset($errorMsg)) {
        $sql = "UPDATE auction_detail SET paymentImage= '$new_name' WHERE detailID = $detailID";
        $query = mysqli_query($conn, $sql);


        if ($query) {
            $successMsg = "แก้ไขข้อมูลเสร็จสิ้น";
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
    <?php
    if (isset($errorMsg)) {
    ?>
        <script type="text/javascript">
            var errorMsg = '<?php echo $errorMsg; ?>';
            Swal.fire(
                errorMsg,
                '',
                'error'
            )
        </script>
    <?php } ?>
    <!-- Page content-->
    <div class="container">
        <div class="text-center mt-5">
            <h1>ชำระเงิน</h1>
            <?php
            $sql_bank = "SELECT * FROM bank";
            $query_bank = mysqli_query($conn, $sql_bank);


            $sql_detail = "SELECT * FROM auction_detail WHERE detailID = $detailID";
            $query_detail = mysqli_query($conn, $sql_detail);
            $result_detail = mysqli_fetch_array($query_detail);
            ?>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>ช่องทางการชำระ</h5>
                        <hr>
                        <?php while ($result_bank = mysqli_fetch_array($query_bank)) { ?>
                            <tr>
                                <td>ธนาคาร : <?php echo $result_bank['bankName'] ?>, </td>
                                <td><?php echo $result_bank['bankHolder'] ?>,</td>
                                <td>เลขบัญชี : <?php echo $result_bank['bankNumber'] ?> <br>
                                </td>
                            </tr>
                        <?php } ?>
                        <hr>
                        <form action="" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                            <h5>ยอดที่ต้องชำระ : <?php echo number_format($result_detail['bidPrice'], 2) ?> บาท</h5>
                            <div class="col-md-12">

                                <div class="input-group has-validation">

                                    <input type="file" name="txt_file" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุหลักฐานการชำระเงิน
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btn_submit" class="btn btn-primary mt-3" style="width: 100%;">บันทึก</button>
                        </form>


                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-12 text-center mt-5"><a href="javascript:history.back()"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a></div>

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