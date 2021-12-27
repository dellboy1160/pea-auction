<?php


if (isset($_REQUEST['check_id'])) {


    $encrypt_checkID = $_REQUEST['check_id'];
    $encrypt_auctionID = $_REQUEST['detail_id'];

    $check_id = encrypt_decrypt($encrypt_checkID, 'decrypt');
    $auctionID = encrypt_decrypt($encrypt_auctionID, 'decrypt');
    try {
        $sql = "SELECT * FROM auction WHERE auctionID = $auctionID";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($query);
        $num = mysqli_num_rows($query);
        if ($num == 0) {
            $error = "ไม่มีข้อมูลนี้อยู่";
        }
    } catch (Error  $e) {
        $error = "ไม่มีข้อมูลนี้อยู่";
    }
}

if (isset($_REQUEST['checkTrue'])) {

    $encrypt = $_REQUEST['check_id'];
    $check_id = encrypt_decrypt($encrypt, 'decrypt');
    $sql = "UPDATE auction_detail SET auctionDetailStatus = 'check' WHERE detailID=$check_id";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $successMsg = "";
    }
} elseif (isset($_REQUEST['checkFalse'])) {
    $encrypt = $_REQUEST['check_id'];
    $check_id = encrypt_decrypt($encrypt, 'decrypt');
    $sql = "UPDATE auction_detail SET auctionDetailStatus = 'checkFail' WHERE detailID=$check_id";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $successMsg = "";
    }
}
?>




<?php
try {
    $sql = "SELECT * FROM auction_detail AS d
    INNER JOIN user AS u
    ON d.user_id = u.user_id
    WHERE d.detailID = $check_id";
    $query = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($query);
    if ($num == 0) {
        $error = "ไม่มีข้อมูลนี้อยู่";
    }
    $result = mysqli_fetch_array($query);
} catch (Error  $e) {
    $error = "ไม่มีข้อมูลนี้อยู่";
}

?>


<?php if (isset($successMsg)) { ?>
    <script>
        Swal.fire(
            'บันทึกข้อมูลเรียบร้อย',
            '',
            'success',


        ).then(function() {
            window.location = "?act=search&detail_id=<?php echo encrypt_decrypt($auctionID, 'encrypt'); ?>";
        });
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

<div class="card mb-4 mt-5 ">
    <div class="card-header">
        <i class="far fa-check-square"></i>
        ตรวจสอบข้อมูล
        <?php
        $encrypt_detailID = $auctionID;
        $encrypt_check_id = $check_id;

        $detailID = encrypt_decrypt($encrypt_detailID, 'encrypt');
        $checkID = encrypt_decrypt($encrypt_check_id, 'encrypt');
        ?>
        <div class="btn-group" style="float: right;">
            <a href="auction.php?act=check&detail_id=<?php echo $detailID ?>&check_id=<?php echo $checkID ?>&checkTrue=1" class="btn btn-primary btn-sm "><i class="far fa-check-circle"></i> ข้อมูลถูกต้อง</a>
            <a href="auction.php?act=check&detail_id=<?php echo $detailID ?>&check_id=<?php echo $checkID ?>&checkFalse=1" class="btn btn-danger btn-sm "><i class="far fa-times-circle"></i> ข้อมูลไม่ถูกต้อง</a>
        </div>
    </div>




    <div class="card-body ">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>ชื่อ : <?php echo $result['Fname'] ?> - <?php echo $result['Lname'] ?></h5>
                    <h5>เบอร์โทรศัพท์ : <?php echo $result['phone'] ?></h5>
                    <h5>LINE ID : <?php echo $result['line'] ?></h5>
                </div>




                <!-- <div class="col-md-4">
                    <h4>สำเนาบัตรประชาชน</h4>
                    <h1><img src="../copy/<?php echo $result['idCardImage'] ?>" width="100%" height="auto" alt=""></h1>
                </div>
                <div class="col-md-4">
                    <h4>สำเนาทะเบียนบ้าน</h4>
                    <h1><img src="../copy/<?php echo $result['houseRegistrationImage'] ?>" width="100%" height="auto" alt=""></h1>
                </div>
                <div class="col-md-4">
                    <h4>สำเนาใบทะเบียนพาณิชย์</h4>
                    <h1><img src="../copy/<?php echo $result['commercialRegistrationImage'] ?>" width="100%" height="auto" alt=""></h1>
                </div> -->
                <h5 style="text-align: center; "> <a onClick="PrintDiv();" style="width:100%;" class="btn btn-primary"> <i class="far fa-file-pdf" style="color: white;"></i> ดาวโหลดเอกสาร</a></h5>
                <br>
                <a href="?act=search&detail_id=<?php echo $_REQUEST['detail_id'] ?>" style="text-align: center;"><i class="fas fa-arrow-left mt-5"></i> ย้อนกลับ</a>
            </div>
        </div>
    </div>
    <div class="container" id="container" hidden>
        <div class="row">
            <div class="col-md-12">
                <img src="../copy/<?php echo $result['idCardImage'] ?>" width="100%" height="auto" alt="">

                <?php if ($result['commercialRegistrationImage'] == "" || $result['commercialRegistrationImage'] == null || empty($result['commercialRegistrationImage'])) { ?>

                <?php } else { ?>
                    <img src="../copy/<?php echo $result['commercialRegistrationImage'] ?>" width="100%" height="auto" alt="">
                <?php } ?>

            </div>
        </div>
    </div>
</div>