<?php


if (isset($_REQUEST['check_id'])) {
    $check_id = $_REQUEST['check_id'];
    $auctionID = $_REQUEST['detail_id'];
}

if (isset($_REQUEST['checkTrue'])) {
    $check_id = $_REQUEST['check_id'];
    $sql = "UPDATE auction_detail SET auctionDetailStatus = 'check' WHERE detailID=$check_id";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $successMsg = "";
    }
} elseif (isset($_REQUEST['checkFalse'])) {
    echo 'ข้อมูลไม่ถูกต้อง';
}
?>
<?php if (isset($successMsg)) { ?>
    <script>
        Swal.fire(
            'บันทึกข้อมูลเรียบร้อย',
            '',
            'success',


        ).then(function() {
            window.location = "?act=search&detail_id=<?php echo $auctionID ?>";
        });
    </script>
<?php } ?>
<div class="card mb-4 mt-5 ">
    <div class="card-header">
        <i class="far fa-check-square"></i>
        ตรวจสอบข้อมูล

        <div class="btn-group" style="float: right;">
            <a href="auction.php?act=check&detail_id=<?php echo $auctionID ?>&check_id=<?php echo $check_id ?>&checkTrue=1" class="btn btn-primary btn-sm "><i class="far fa-check-circle"></i> ข้อมูลถูกต้อง</a>
            <a href="auction.php?act=check&detail_id=<?php echo $auctionID ?>&check_id=<?php echo $check_id ?>&checkFalse=1" class="btn btn-danger btn-sm "><i class="far fa-times-circle"></i> ข้อมูลไม่ถูกต้อง</a>
        </div>
    </div>
    <?php
    $sql = "SELECT * FROM auction_detail AS d
    INNER JOIN user AS u
    ON d.user_id = u.user_id
    WHERE d.detailID = $check_id";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    ?>



    <div class="card-body ">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>ชื่อ : <?php echo $result['Fname'] ?> - <?php echo $result['Lname'] ?></h5>
                    <h5>เบอร์โทรศัพท์ : <?php echo $result['phone'] ?></h5>
                    <h5>LINE ID : <?php echo $result['line'] ?></h5>
                </div>


                <hr>

                <div class="col-md-4">
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
                </div>

                <h5 style="text-align: center;"> <a href=""> <i class="far fa-file-pdf" style="color: red;"></i> ดาวโหลดสำเนา</a></h5>
                <br>
                <a href="javascript:history.back()" style="text-align: center;"><i class="fas fa-arrow-left mt-5"></i> ย้อนกลับ</a>
            </div>


        </div>



    </div>
</div>