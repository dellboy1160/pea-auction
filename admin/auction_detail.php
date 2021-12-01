<?php

if (isset($_REQUEST['detail_id'])) {
    $auctionID = $_REQUEST['detail_id'];
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

<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        ตารางรายรายชื่อคนลงประมูล รหัส <?php echo $_REQUEST['detail_id'] ?>

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
                    <th width="20%">สถานะ</th>

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
                                <a href="?act=check&detail_id=<?php echo $auctionID ?>&check_id=<?php echo $result_auction['detailID'] ?>" class="btn btn-primary">ตรวจสอบข้อมูล</a>
                            <?php } elseif ($result_auction['auctionDetailStatus'] == 'checkFail') { ?>
                                ข้อมูลไม่ถูกต้อง
                            <?php } elseif ($result_auction['auctionDetailStatus'] == 'check' && $result_offer['paymentStatus'] == null) { ?>
                                ตรวจสอบแล้ว รอยื่นซอง
                            <?php } elseif ($result_offer['paymentStatus'] == 'checkFail') { ?>
                                ข้อมูลยื่นซองไม่ถูกต้อง
                            <?php } elseif ($result_offer['paymentStatus'] == 'unCheck') { ?>
                                ยื่นซองแล้ว <a href="?act=checkOffer&auctionID=<?php echo $auctionID ?>&check_id=<?php echo $result_offer['offerID'] ?>&detailID=<?php echo $result_auction['detailID'] ?>" class="">ตรวจสอบ</a>
                            <?php } elseif ($result_offer['paymentStatus'] == 'check') { ?>
                                ตรวจสอบการยื่นซองแล้ว
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