<?php

if (isset($_REQUEST['detail_id'])) {
    $encrypt = $_REQUEST['detail_id'];
    $auctionID = encrypt_decrypt($encrypt, 'decrypt');
}

if (isset($_REQUEST['auctionClose'])) {
    $encryptAuc = $_REQUEST['auctionID'];
    $decryptAuc = encrypt_decrypt($encryptAuc, 'decrypt');
    $today = date("Y-m-d H:i:s");
    $sql = "UPDATE auction SET status='unActive',dateUnactive='$today' WHERE auctionID = $decryptAuc";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $successMsg = "";
    }
}


?>


<?php
try {
    $sql_auction = "SELECT * FROM auction_detail AS d
            INNER JOIN user AS u
            ON d.user_id = u.user_id
            WHERE auctionID = $auctionID";
    $query_auction = mysqli_query($conn, $sql_auction);
    $num_auction = mysqli_num_rows($query_auction);

    // if ($num_auction == 0) {
    //     $error = "ไม่มีข้อมูลนี้อยู่";
    // }
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


<?php if (isset($successMsg)) { ?>
    <script>
        Swal.fire(
            'บันทึกข้อมูลเรียบร้อย',
            '',
            'success',


        ).then(function() {
            window.location = "auction.php";
        });
    </script>
<?php } ?>
<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        ตารางรายรายชื่อคนลงประมูล รหัส <?php echo $auctionID ?>
        <a href="?act=search&detail_id=<?php echo $encrypt ?>&auctionClose=1&auctionID=<?php echo $encrypt  ?>" onclick="return confirm('ยืนยันปิดการประมูล');" class="btn btn-danger btn-sm "><i class="fas fa-window-close"></i> ปิดการประมูล</a>
        <div class="btn-group" style="float: right;">

            <a onClick="PrintDiv();" class="btn btn-outline-primary"><i class="fas fa-print"></i> รายชื่อผู้ลงประมูล</a>
            <a onClick="PrintDiv2();" class="btn btn-outline-primary"><i class="fas fa-print"></i> รายชื่อผู้ยื่นซอง</a>


        </div>
    </div>
    <div class="card-body ">
        <style>
            .table_legenda {
                table-layout: fixed;
            }

            .table_legenda th {
                overflow-wrap: break-word;
            }
        </style>
        <table id="example" class="table table-bordered table_legenda">
            <thead>
                <tr>

                    <th width="25%">ชื่อ - นามสกุล</th>
                    <th width="10%">เบอร์โทรศัพท์</th>
                    <th width="10%">Line ID</th>
                    <th>วัน/เวลา ลงชื่อ </th>
                    <th width="25%"></th>

                </tr>
            </thead>

            <tbody>
                <?php
                while ($result_auction = mysqli_fetch_array($query_auction)) { ?>

                    <?php
                    $detailID = $result_auction['detailID'];
                    $sql_offer = "SELECT * FROM offer_price WHERE detailID = $detailID";
                    $query_offer = mysqli_query($conn, $sql_offer);
                    $result_offer = mysqli_fetch_array($query_offer);

                    $sql_a = "SELECT * FROM offer_price WHERE auctionID = $auctionID";
                    $query_a = mysqli_query($conn, $sql_a);
                    $result_a = mysqli_fetch_array($query_a);
                    ?>

                    <tr>
                        <td>
                            <?php echo $result_auction['Fname'] ?> - <?php echo $result_auction['Lname'] ?>
                        </td>
                        <td><?php echo $result_auction['phone'] ?> </td>
                        <td><?php echo $result_auction['line'] ?></td>

                        <td>
                            <?php
                            $signDate = $result_auction['signDate'];
                            echo signDate($signDate);
                            ?>

                        </td>

                        <td>
                            <?php if ($result_auction['auctionDetailStatus'] == 'unCheck') { ?>

                                <?php
                                $detailID = $auctionID;
                                $checkId = $result_auction['detailID'];

                                $encrypt_detailID = encrypt_decrypt($detailID, 'encrypt');
                                $encrypt_checkID = encrypt_decrypt($checkId, 'encrypt');
                                ?>
                                <a href="?act=check&detail_id=<?php echo $encrypt_detailID ?>&check_id=<?php echo  $encrypt_checkID  ?>">ตรวจสอบข้อมูล</a>
                            <?php } elseif ($result_auction['auctionDetailStatus'] == 'checkFail') { ?>
                                ข้อมูลไม่ถูกต้อง
                            <?php } elseif ($result_auction['auctionDetailStatus'] == 'check' && $result_offer['paymentStatus'] == null) { ?>
                                ตรวจสอบแล้ว รอยื่นซอง
                            <?php } elseif ($result_offer['paymentStatus'] == 'checkFail') { ?>
                                ข้อมูลยื่นซองไม่ถูกต้อง
                            <?php } elseif ($result_offer['paymentStatus'] == 'unCheck') { ?>
                                <?php
                                $auctionID = $auctionID;
                                $checkId = $result_offer['offerID'];
                                $detailID =  $result_auction['detailID'];

                                $encrypt_auctionID = encrypt_decrypt($auctionID, 'encrypt');
                                $encrypt_checkID = encrypt_decrypt($checkId, 'encrypt');
                                $encypt_detailID = encrypt_decrypt($detailID, 'encrypt')
                                ?>

                                ยื่นซองแล้ว <a href="?act=checkOffer&auctionID=<?php echo $encrypt_auctionID ?>&check_id=<?php echo $encrypt_checkID ?>&detailID=<?php echo $encypt_detailID ?>" class="">ตรวจสอบ</a>
                            <?php } elseif ($result_offer['paymentStatus'] == 'check' && empty($result_offer['auctionStatus'])) { ?>
                                <!-- ตรวจสอบการยื่นซองแล้ว -->

                                <?php
                                $auctionID1 = $auctionID;
                                $detailID1 = $result_auction['detailID'];

                                $encrypt_auctionID1 = encrypt_decrypt($auctionID1, 'encrypt');
                                $encrypt_detailID1 = encrypt_decrypt($detailID1, 'encrypt');
                                ?>
                                <a href="?act=auctionWon&auctionStatus=won&auctionID=<?php echo  $encrypt_auctionID1 ?>&detailID=<?php echo $encrypt_detailID1 ?>" onclick="return confirm('ยืนยัน');">ผู้ชนะ</a>
                            <?php } elseif ($result_offer['paymentStatus'] == 'check' && $result_offer['auctionStatus'] == 'won') { ?>
                                ผู้ชนะ<br>
                                กำหนดรับสินค้า ภายในวันที่ :<br>
                                <?php echo justDate($result_offer['announceWonDate']) ?> - <?php echo justDate($result_offer['announceWonDate'] . ' + 10 days') ?>, 8:30 - 16-30
                            <?php } elseif ($result_offer['paymentStatus'] == 'check' && $result_offer['auctionStatus'] == 'lose' && empty($result_offer['refundPaymentImage'])) { ?>
                                <?php
                                $auctionID1 = $auctionID;
                                $offerID1 = $result_offer['offerID'];
                                $detailID1 = $result_auction['detailID'];

                                $encrypt_auctionID1 = encrypt_decrypt($auctionID1, 'encrypt');
                                $encrypt_offerID1 = encrypt_decrypt($offerID1, 'encrypt');
                                $encrypt_detailID1 = encrypt_decrypt($detailID1, 'encrypt');

                                ?>
                                ผู้แพ้ <a href="refund.php?auctionID=<?php echo $encrypt_auctionID1  ?>&offerID=<?php echo $encrypt_offerID1 ?>&detailID=<?php echo $encrypt_detailID1 ?>">โอนเงินคืน</a>

                            <?php } elseif (!empty($result_offer['refundPaymentImage'])) { ?>
                                โอนเงินคืนเสร็จสิ้น
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>


    <a href="auction.php" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
</div>

<div class="container" id="container" hidden>
    <div class="row">
        <div class="col-md-12">
            <?php
            $sql_detail = "SELECT * FROM auction_detail AS d

            INNER JOIN user AS u
            ON d.user_id = u.user_id
            
            WHERE d.auctionID = $auctionID";
            $query__detail = mysqli_query($conn, $sql_detail);

            $i = 1;
            ?>
            <h2 style="text-align: center;margin-top:50px;">รายชื่อคนลงประมูล</h2>
            <table border="1" class="table table-bordered" style="border-color: black;">
                <thead>
                    <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>วันที่ลงชื่อ</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>LINE ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($resilt_detail = mysqli_fetch_array($query__detail)) { ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $resilt_detail['Fname'] ?> - <?php echo $resilt_detail['Lname'] ?></td>
                            <td><?php
                                $signDate = $resilt_detail['signDate'];
                                echo signDate($signDate);

                                ?></td>
                            <td><?php echo $resilt_detail['phone'] ?></td>
                            <td><?php echo $resilt_detail['line'] ?></td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="container" id="container2" hidden>
    <div class="row">
        <div class="col-md-12">
            <?php

            $sql_of = "SELECT * FROM offer_price AS o
            INNER JOIN auction_detail AS d
            ON o.detailID = d.detailID

            INNER JOIN user AS u
            ON u.user_id = d.user_id

            WHERE o.auctionID = $auctionID";

            $query_of = mysqli_query($conn, $sql_of);
            $j = 1;
            ?>
            <h2 style="text-align: center;margin-top:50px;">รายชื่อผู้ยื่นซอง</h2>
            <table border="1" class="table table-bordered" style="border-color: black;">
                <thead>
                    <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>วันที่ลงชื่อ</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>LINE ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($resilt_of = mysqli_fetch_array($query_of)) { ?>
                        <tr>
                            <td><?php echo $j ?></td>
                            <td><?php echo $resilt_of['Fname'] ?> - <?php echo $resilt_of['Lname'] ?></td>
                            <td><?php
                                $signDate = $resilt_of['offerDate'];
                                echo signDate($signDate);

                                ?></td>
                            <td><?php echo $resilt_of['phone'] ?></td>
                            <td><?php echo $resilt_of['line'] ?></td>
                        </tr>
                    <?php $j++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>