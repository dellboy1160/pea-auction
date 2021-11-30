<?php


if (isset($_REQUEST['check_id'])) {
    $check_id = $_REQUEST['check_id'];
}

if (isset($_REQUEST['auctionID'])) {
    $auctionID = $_REQUEST['auctionID'];
}

if (isset($_REQUEST['detailID'])) {
    $detailID = $_REQUEST['detailID'];
}

if (isset($_REQUEST['checkTrue'])) {
    $check_id = $_REQUEST['check_id'];
    $sql = "UPDATE offer_price SET paymentStatus = 'check' WHERE offerID=$check_id";
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
            window.location = "?act=search&detail_id=<?php echo $_REQUEST['auction_id'] ?>";
        });
    </script>
<?php exit();
} ?>
<div class="card mb-4 mt-5 ">
    <div class="card-header">
        <i class="far fa-check-square"></i>
        ตรวจสอบข้อมูลยื่นซอง
        <div class="btn-group" style="float: right;">

            <a href="auction.php?act=checkOffer&auction_id=<?php echo $auctionID ?>&check_id=<?php echo $check_id ?>&checkTrue=1" class="btn btn-primary btn-sm "><i class="far fa-check-circle"></i> ข้อมูลถูกต้อง</a>
            <a href="auction.php?act=checkOffer&auction_id=<?php echo $auctionID ?>&check_id=<?php echo $check_id ?>&checkFalse=1" class="btn btn-danger btn-sm "><i class="far fa-times-circle"></i> ข้อมูลไม่ถูกต้อง</a>
        </div>
    </div>
    <?php
    $sql = "SELECT * FROM offer_price AS o

    INNER JOIN auction_detail AS d
    ON o.detailID = d.detailID

    INNER JOIN user AS u
    ON u.user_id = d.user_id
        
    INNER JOIN auction AS a
    ON d.auctionID = a.auctionID

    WHERE d.auctionID = $auctionID";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    ?>



    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>ชื่อ : <?php echo $result['Fname'] ?> - <?php echo $result['Lname'] ?></h5>
                    <h5>เบอร์โทรศัพท์ : <?php echo $result['phone'] ?></h5>
                    <h5>LINE ID : <?php echo $result['line'] ?></h5>
                </div>


                <!-- <div class="col-md-4">
                    <h4>รูปเอกสารใบเสนอราคา</h4>
                    <h1><img src="../offer_price_img/<?php echo $result['offerPriceDocImage'] ?>" width="100%" height="auto" alt=""></h1>
                </div>
                <div class="col-md-4">
                    <h4>รูปเอกสารใบเสนอราคา</h4>
                    <h1><img src="../offer_price_img/<?php echo $result['offerPriceDocImage2'] ?>" width="100%" height="auto" alt=""></h1>
                </div>
                <div class="col-md-4">
                    <h4>รูปเอกสารใบเสนอราคา</h4>
                    <h1><img src="../offer_price_img/<?php echo $result['offerPriceDocImage3'] ?>" width="100%" height="auto" alt=""></h1>
                </div>
                <div class="col-md-4">
                    <h4>รูปใบเสร็จชำระเงิน</h4>
                    <h1><img src="../offer_price_img/<?php echo $result['paymentImage'] ?>" width="100%" height="auto" alt=""></h1>
                </div> -->
                <h5 style="text-align: center;"> <a onClick="PrintDiv();" class="btn btn-primary" style="width: 100%;"> <i class="far fa-file-pdf" style="color: white;"></i> ดาวโหลดเอกสารยื่นซอง</a></h5>
                <br>
                <a href="javascript:history.back()" style="text-align: center;"><i class="fas fa-arrow-left mt-5"></i> ย้อนกลับ</a>
            </div>


        </div>
    </div>
    <div class="container" id="container" hidden>
        <div class="row">
            <div class="col-md-12">
                <img src="../offer_price_img/<?php echo $result['offerPriceDocImage'] ?>" width="100%" height="auto" alt="">
                <img src="../offer_price_img/<?php echo $result['offerPriceDocImage2'] ?>" width="100%" height="auto" alt="">
                <img src="../offer_price_img/<?php echo $result['offerPriceDocImage3'] ?>" width="100%" height="auto" alt="">
                <img src="../offer_price_img/<?php echo $result['paymentImage'] ?>" width="100%" height="auto" alt="">
            </div>
        </div>
    </div>
</div>