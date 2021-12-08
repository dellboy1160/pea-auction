<?php
include('../server.php');
include('../ThaiDateFunction.php');
include('../encrypt_decrypt_function.php');


if (isset($_REQUEST['offerID'])) {
    $encrypt = $_REQUEST['offerID'];
    $offerID =  encrypt_decrypt($encrypt, 'decrypt');
    try {
        $sql = "SELECT * FROM offer_price WHERE offerID = $offerID";
        $query = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($query);
        $result = mysqli_fetch_array($query);

        if ($num == 0) {
            $error = "ไม่มีข้อมูลนี้อยู่";
        }
    } catch (Error  $e) {
        $error = "ไม่มีข้อมูลนี้อยู่";
    }
}
if (isset($_REQUEST['auctionID'])) {
    $encrypt = $_REQUEST['auctionID'];
    $auctionID =  encrypt_decrypt($encrypt, 'decrypt');
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
}
if (isset($_REQUEST['detailID'])) {
    $encrypt = $_REQUEST['detailID'];
    $detailID =  encrypt_decrypt($encrypt, 'decrypt');
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
}
if (isset($_REQUEST['btn_submit'])) {

    $image_file = $_FILES['txt_file']['name'];
    $type = $_FILES['txt_file']['type'];
    $size = $_FILES['txt_file']['size'];
    $temp = $_FILES['txt_file']['tmp_name'];

    $path = "../refund_image/" . $image_file;

    $explode = explode('.', $_FILES['txt_file']['name']);
    $new_name = round(microtime(true)) . '1.' . end($explode);


    if (empty($new_name)) {
        $errorMsg = "กรุณาเลือกรูปภาพ";
    } else if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png") {
        if (!file_exists($path)) {
            if ($size < 2000000) {
            } else {
                $errorMsg = "ไฟล์รูปภาพใหญ่เกิน 2MB";
            }
        }
    } else {
        $errorMsg = "กรุณาใช้นามสกุลไฟล์เป็น JPG, JPEG, PNG เท่านั้น";
    }

    if (!isset($errorMsg)) {
        move_uploaded_file($temp, '../refund_image/' . $new_name);

        $sql = "UPDATE offer_price SET refundPaymentImage = '$new_name' WHERE offerID = $offerID ";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $successMsg = '';
        }
    }
}
?>

<?php
try {
    $sql_detail = "SELECT * FROM auction_detail AS d
INNER JOIN user AS u
ON d.user_id = u.user_id
WHERE detailID = $detailID";
    $query_detail = mysqli_query($conn, $sql_detail);
    $num_detail = mysqli_num_rows($query_detail);
    $result_detail = mysqli_fetch_array($query_detail);

    $sql_offer = "SELECT * FROM offer_price WHERE offerID = $offerID";
    $query_offer = mysqli_query($conn, $sql_offer);
    $num_offer = mysqli_num_rows($query_offer);
    $result_offer = mysqli_fetch_array($query_offer);


    if ($num_detail == 0 || $num_offer == 0) {
        $error = "ไม่มีข้อมูลนี้อยู่";
    }
} catch (Error  $e) {
    $error = "ไม่มีข้อมูลนี้อยู่";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php include('../web-structure/title_name.php') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../css/font.css">
</head>

<body>
    <?php if (isset($successMsg)) { ?>
        <script>
            Swal.fire(
                'บันทึกข้อมูลเรียบร้อย',
                '',
                'success',


            ).then(function() {
                window.location = "auction.php?act=search&detail_id=<?php echo $_REQUEST['auctionID'] ?>";
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mt-3">โอนเงินคืน</h1>
                <hr>
            </div>
            <div class="col-md-6">
                <h4 class="text-center">รูปหลักฐานการชำระเงิน</h4>
                <img src="../offer_price_img/<?php echo $result_offer['paymentImage'] ?>" style="width: 100%;height:auto;" alt="">
            </div>
            <div class="col-md-6">
                <h4 class="text-center">ข้อมูลผู้โอน</h4>
                <table border="0">
                    <tr>
                        <td width="100px">ชื่อ-นามสกุล</td>
                        <td width="10px">:</td>
                        <td><?php echo $result_detail['Fname'] ?> - <?php echo $result_detail['Lname'] ?> </td>
                    </tr>
                    <tr>
                        <td>เบอร์โทรศัพท์</td>
                        <td>:</td>
                        <td><?php echo $result_detail['phone'] ?></td>
                    </tr>
                    <tr>
                        <td>LINE ID</td>
                        <td>:</td>
                        <td><?php echo $result_detail['line'] ?></td>
                    </tr>

                </table>
                <hr>
                <table border="0">

                    <tr>
                        <td width="100px">ชื่อธนาคาร</td>
                        <td width="10px">:</td>
                        <td>
                            <?php
                            if (empty($result_detail['bankName'])) {
                                echo '*';
                            } else {
                                echo $result_detail['bankName'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>ชื่อผู้ถือบัญชี</td>
                        <td>:</td>
                        <td>
                            <?php
                            if (empty($result_detail['bankHolder'])) {
                                echo '*';
                            } else {
                                echo $result_detail['bankHolder'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>หมายเลขบัญชี</td>
                        <td>:</td>
                        <td>
                            <?php
                            if (empty($result_detail['bankNumber'])) {
                                echo '*';
                            } else {
                                echo $result_detail['bankNumber'];
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <hr>
                <div class="col-md-12">
                    <form action="" class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        <div class="col-md-12">
                            <label for="validationCustomUsername" class="form-label">หลักฐานการชำระเงิน</label>
                            <div class="input-group has-validation">
                                <input type="file" class="form-control" name="txt_file" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    กรุณากรอกหลักฐานการชำระเงิน
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-3" name="btn_submit" style="width: 100%;">บันทึก</button>
                    </form>
                </div>
            </div>
            <a href="javascript:history.back()"" class=" text-center"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
        </div>
    </div>

    <section style="height: 10vh;"></section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/validation.js"></script>
</body>

</html>