<?php


if (isset($_REQUEST['unActive'])) {
    $auctionID = $_REQUEST['unActive'];

    $sql = "UPDATE auction SET status ='unActive' WHERE auctionID = $auctionID";
    $query = mysqli_query($conn, $sql);
}
?>
<?php
$sql_auction = "SELECT * FROM auction WHERE status = 'active'";
$query_auction = mysqli_query($conn, $sql_auction);
$num_auction = mysqli_num_rows($query_auction);
?>
<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        ตารางรายการประมูล
        <?php if ($num_auction >= 1) { ?>
            <button style="float: right;" class="btn btn-secondary btn-sm" disabled><i class="fas fa-plus"></i> เพิ่มรายการ</button>
        <?php } else { ?>
            <a href="?act=insert" style="float: right;" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> เพิ่มรายการ</a>
        <?php } ?>



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
                    <th width="10%">รหัสประมูล</th>
                    <th width="20%">หัวข้อ</th>
                    <th>รายละเอียด</th>
                    <!-- <th></th> -->
                    <th></th>
                    <th width="15%"></th>
                </tr>
            </thead>

            <tbody>
                <?php while ($result_auction = mysqli_fetch_array($query_auction)) { ?>
                    <tr>
                        <td data-label="รหัสประมูล"><?php echo $result_auction['auctionID'] ?></td>
                        <td data-label="หัวข้อ">
                            <strong> หัวข้อ : </strong> <?php echo $result_auction['auctionTitle'] ?>
                            <br>
                            <strong> ราคาเริ่มต้น : </strong> <?php echo $result_auction['auctionStartPrice'] ?> บาท<br>

                            <?php
                            $startDate = $result_auction['auctionStartDate'];
                            $endDate = $result_auction['auctionEndDate'];

                            ?>
                            <strong> เริ่มประมูล :</strong> <?php echo signDate($startDate) ?><br>
                            <strong> ปิดประมูล :</strong> <?php echo signDate($endDate) ?>
                        </td>
                        <td data-label="รายละเอียด">
                            <?php echo $result_auction['auctionDetail'] ?>
                        </td>
                        <!-- <td data-label="">
                            <?php
                            $today = date("Y-m-d H:i:s");
                            $startDate = $result_auction['auctionStartDate'];
                            $endDate = $result_auction['auctionEndDate'];

                            if ($today < $startDate) {
                                echo 'ยังไม่ถึงเวลาประมูล';
                            } elseif ($today > $startDate && $today < $endDate) {
                                echo 'อยู่ในขั้นตอนการประมูล';
                            } else { ?>
                                <a href="?done=<?php echo $result_auction['auctionID'] ?>">จบการประมูล</a>
                            <?php } ?>
                        </td> -->

                        <?php
                        $data = $result_auction['auctionID'];
                        $encrypt = encrypt_decrypt($data, 'encrypt');
                        ?>
                        <td style="text-align: left;">
                            <a style="width: 100%;" href="?act=search&detail_id=<?php echo  $encrypt ?>" class="btn btn-primary "><i class="fas fa-pen-alt"></i> รายชื่อคนลงประมูล</a>
                        </td>
                        <td style="text-align: center;">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a href="?act=image&auctionID=<?php echo  $encrypt ?>" type="button" class="btn btn-primary">จัดการรูป</a>
                                <a href="?act=edit&update_id=<?php echo  $encrypt ?>" type="button" class="btn btn-warning">แก้ไข</a>

                                <a href="?delete_id=<?php echo  $encrypt ?>" onclick="return confirm('ยืนยันการลบ');" type="button" class="btn btn-danger">ลบ</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>