<?php
if (isset($_REQUEST['unActive'])) {
    $auctionID = $_REQUEST['unActive'];

    $sql = "UPDATE auction SET status ='unActive' WHERE auctionID = $auctionID";
    $query = mysqli_query($conn, $sql);
}
?>

<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        ตารางรายการประมูล
        <a href="?act=insert" style="float: right;" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> เพิ่มรายการ</a>

        
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
            <?php
            $sql_auction = "SELECT * FROM auction WHERE status = 'active'";
            $query_auction = mysqli_query($conn, $sql_auction);

            ?>
            <thead>
                <tr>
                    <th>รหัสประมูล</th>
                    <th width="30%">หัวข้อ</th>
                    <th>รายละเอียด</th>
                    <!-- <th></th> -->
                    <th></th>
                    <th width="10%"></th>
                </tr>
            </thead>

            <tbody>
                <?php while ($result_auction = mysqli_fetch_array($query_auction)) { ?>
                    <tr>
                        <td data-label="รหัสประมูล"><?php echo $result_auction['auctionID'] ?></td>
                        <td data-label="หัวข้อ">
                            หัวข้อ : <?php echo $result_auction['auctionTitle'] ?>
                            <br>
                            ราคาเริ่มต้น : <?php echo $result_auction['auctionStartPrice'] ?> บาท<br>

                            <?php
                            $startDate = $result_auction['auctionStartDate'];
                            $endDate = $result_auction['auctionEndDate'];

                            ?>
                            เริ่มประมูล : <?php echo signDate($startDate) ?><br>
                            ปิดประมูล : <?php echo signDate($endDate) ?>
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
                        <td style="text-align: left;">
                            <a style="width: 100%;" href="?act=search&detail_id=<?php echo $result_auction['auctionID'] ?>" class="btn btn-primary btn-sm mt-2"><i class="fas fa-pen-alt"></i> รายชื่อคนลงประมูล</a>
                        </td>
                        <td style="text-align: center;">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                <a href="?act=edit&update_id=<?php echo $result_auction['auctionID'] ?>" type="button" class="btn btn-warning">แก้ไข</a>
                                <a href="?delete_id=<?php echo $result_auction['auctionID'] ?>" onclick="return confirm('ยืนยันการลบ');" type="button" class="btn btn-danger">ลบ</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>