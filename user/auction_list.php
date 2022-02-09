<?php
$username = $_SESSION['username'];
$sql_user = "SELECT * FROM user WHERE username='$username'";
$query_user = mysqli_query($conn, $sql_user);
$result_user = mysqli_fetch_array($query_user);


$user_id =  $result_user['user_id'];


$sql_list = "SELECT * FROM auction_detail AS d
INNER JOIN user AS u
ON d.user_id = u.user_id

INNER JOIN auction AS a
ON d.auctionID = a.auctionID

WHERE d.user_id = $user_id AND a.status='active'
";

$query_list = mysqli_query($conn, $sql_list);
$num_list = mysqli_num_rows($query_list);
?>

<?php if ($num_list == 0) { ?>
    <div class="alert alert-primary d-flex align-items-center" role="alert">

        <div>
            ยังไม่มีรายการประมูล
        </div>
    </div>
<?php } ?>

<?php while ($result_list = mysqli_fetch_array($query_list)) { ?>
    <div class="card shadow-sm p-3 mb-5 bg-body rounded">
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <h5>รหัสประมูล : <?php echo $result_list['auctionID'] ?></h5>

                </div>
                <div class="col-md-6">
                    <?php
                    $id = $result_list['auctionID'];
                    $encryptID = encrypt_decrypt($id, 'encrypt');
                    ?>
                    <a href="auction_listDetail.php?auctionID=<?php echo $encryptID ?>" class="btn btn-primary btn-sm mb-3">รายละเอียดเพิ่มเติม</a>
                </div>
                <hr>
                <div class="col-md-6">
                    <strong>หัวข้อ : </strong> <?php echo $result_list['auctionTitle'] ?><br>
                    <strong> ลงชื่อวันที่ :</strong> <?php $signDate = $result_list['signDate'];
                                                        echo signDate($signDate);
                                                        ?><br>
                </div>
                <div class="col-md-6">

                    <!-- สถานะ -->
                    <?php
                    if ($result_list['auctionDetailStatus'] == 'unCheck') { ?>
                        <strong>สถานะ : </strong> <label class="text-danger"> <strong>กำลังตรวจสอบข้อมูล</strong> </label>


                    <?php } elseif ($result_list['auctionDetailStatus'] == 'checkFail') { ?>
                        <?php
                        $detailID = $result_list['detailID'];
                        $encrypt = encrypt_decrypt($detailID, 'encrypt');
                        ?>
                        <strong>สถานะ : </strong> <label class="text-danger"> <strong>ข้อมูลไม่ถูกต้อง</strong> </label> <a href="auction_resend.php?detailID=<?php echo $encrypt  ?>">ยื่นเอกสารอีกครั้ง</a>
                    <?php } else { ?>

                        <?php
                        $detailID = $result_list['detailID'];
                        $sql = "SELECT * FROM offer_price WHERE detailID = $detailID";
                        $query = mysqli_query($conn, $sql);
                        $result = mysqli_fetch_array($query);

                        ?>
                        <?php if ($result['paymentStatus'] == 'unCheck') { ?>

                            <strong>สถานะ : </strong> <label class="text-danger"> <strong>รอตรวจสอบใบเสนอราคา</strong> </label>
                        <?php } elseif ($result['paymentStatus'] == 'checkFail') {   ?>
                            <?php
                            $offerID = $result['offerID'];
                            $encrypt_offerID = encrypt_decrypt($offerID, 'encrypt');

                            ?>
                            <strong>สถานะ : </strong> <label class="text-danger"> <strong>ข้อมูลเสนอราคาไม่ถูกต้อง</strong> </label> <a href="auction_resendOffer.php?offerID=<?php echo  $encrypt_offerID ?>">ยื่นเอกสารอีกครั้ง</a>
                        <?php } elseif ($result['paymentStatus'] == 'check') { ?>
                            <?php if ($result['auctionStatus'] == '' || $result['auctionStatus'] == null || empty($result['auctionStatus'])) { ?>
                                <?php
                                $sql_doc = "SELECT * FROM document_offerprice";
                                $query_doc = mysqli_query($conn, $sql_doc);

                                ?>
                                <?php while ($result_doc = mysqli_fetch_array($query_doc)) {
                                    $startDate = $result_doc['startDate'];
                                    $endDate = $result_doc['endDate'];
                                    $today = date("Y-m-d H:i:s");
                                ?>
                                <?php } ?>
                                <strong>สถานะ : </strong> <label class="text-success"> <strong>ใบเสนอราคาผ่านการตรวจสอบแล้ว</strong> </label>
                                <br>ประกาศผู้ชนะวันที่ : <?php echo justDate($startDate) ?>
                            <?php } elseif ($result['auctionStatus'] == 'won') { ?>
                                <strong>สถานะ : </strong> <label class="text-success"> <strong>ชนะการประมูล</strong> </label> <br>

                                กำหนดรับสินค้าภายในวันที่ : <br>
                                <?php
                                $date = $result['announceWonDate'];

                                ?>

                                <?php echo justDate($date); ?> - <?php echo justDate($date . ' + 10 days'); ?>, 08:30 - 16:30
                            <?php } elseif ($result['auctionStatus'] == 'lose') { ?>
                                <strong>สถานะ : </strong> <label class="text-danger"> <strong>แพ้การประมูล</strong> </label> <br>

                                <?php if (empty($result_user['bankName']) || empty($result_user['bankHolder']) || empty($result_user['bankNumber'])) { ?>
                             
                                    <h6>คุณยังไม่ระบุข้อมูลบัญชีธนาคาร<a href="profile.php?act=edit_profile"> จัดการที่นี่</a> </h6>
                                <?php  } else {  ?>
                                    <?php
                                    if (empty($result['refundPaymentImage'])) {
                                        echo 'กำลังดำเนินการคืนเงิน';
                                    } else { ?>
                                        คืนเงินเสร็จสิ้น

                                        <a class="view_data" type="button" name="view" id="<?php echo $result["offerID"]; ?>">หลักฐานการโอน</a>

                                <?php  }
                                }
                                ?>

                            <?php } ?>
                        <?php } else { ?>
                            <strong>สถานะ : </strong> <label class="text-success"> <strong>ข้อมูลผ่านการตรวจสอบแล้ว</strong> </label><br>

                            <?php
                            $sql_doc = "SELECT * FROM document_offerprice";
                            $query_doc = mysqli_query($conn, $sql_doc);

                            ?>
                            <?php while ($result_doc = mysqli_fetch_array($query_doc)) {
                                $startDate = $result_doc['startDate'];
                                $endDate = $result_doc['endDate'];
                                $today = date("Y-m-d H:i:s");
                            ?>
                                <h6 class="mb-3"> <a target="_blank" href="../admin/document/<?php echo $result_doc['documentFile'] ?>"><i class="far fa-file-pdf" style="color: red;"></i> ดาวโหลดใบเสนอราคา</a> <br></h6>
                                เสนอราคา วันที่:<br> <?php echo signDate($startDate)  ?> -
                                <?php echo signDate($endDate) ?>

                                <br>
                                <?php if ($today < $startDate) { ?>
                                    <button disabled class="btn btn-secondary btn-sm mt-2" style="width: 100%;">ยังไม่ถึงเวลาเสนอราคา</button>
                                <?php } elseif ($today > $startDate && $today < $endDate) { ?>
                                    <?php
                                    $auctionID = $result_list['auctionID'];
                                    $detailID = $result_list['detailID'];
                                    $encrypt_auctionID = encrypt_decrypt($auctionID, 'encrypt');
                                    $encrypt_detailID = encrypt_decrypt($detailID, 'encrypt');
                                    ?>
                                    <a href="offer_price.php?auctionID=<?php echo $encrypt_auctionID ?>&detailID=<?php echo $encrypt_detailID ?>" style="width: 100%;" class="btn btn-primary btn-sm mt-2">เสนอราคา</a>
                                <?php } elseif ($today > $endDate) { ?>
                                    <button disabled class="btn btn-secondary btn-sm mt-2" style="width: 100%;">หมดเวลาเสนอราคา</button>
                                <?php } ?>
                            <?php } ?>

                        <?php } ?>
                    <?php } ?>

                    <!-- end of สถานะ -->
                    <!-- Vertical Steps -->
                    <!-- <div class="step step-active">
                        <div>
                           
                            <div class="circle">1</div>
                        </div>
                        <div>
                            <div class="title">กำลังตรวจสอบข้อมูลลงชื่อประมูล</div>
                            <div class="caption">กำลังดำเนินการ</div>
                        </div>
                    </div>
                    <div class="step ">
                        <div>
                            <div class="circle">2</div>
                        </div>
                        <div>
                            <div class="title">เสนอราคา</div>
                            <div class="caption">กำลังดำเนินการ</div>
                        </div>
                    </div>
                    <div class="step">
                        <div>
                            <div class="circle">3</div>
                        </div>
                        <div>
                            <div class="title">กำลังตรวจสอบข้อมูลเสนอราคา</div>
                            <div class="caption">กำลังดำเนินการ</div>
                        </div>
                    </div>
                    <div class="step">
                        <div>
                            <div class="circle">4</div>
                        </div>
                        <div>
                            <div class="title">ผลการประมูล</div>
                            <div class="caption">กำลังดำเนินการ</div>
                        </div>
                    </div> -->
                    <!--End Of Vertical Steps -->


                </div>
            </div>
        </div>

    </div>
<?php } ?>