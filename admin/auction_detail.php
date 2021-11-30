<?php


if (isset($_REQUEST['detail_id'])) {
    $auctionID = $_REQUEST['detail_id'];
}
?>

<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        ตารางรายรายชื่อคนลงประมูล รหัส <?php echo $_REQUEST['detail_id'] ?>
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
            $sql_auction = "SELECT * FROM auction_detail AS d
            INNER JOIN user AS u
            ON d.user_id = u.user_id
            WHERE auctionID = $auctionID";
            $query_auction = mysqli_query($conn, $sql_auction);

            ?>
            <thead>
                <tr>

                    <th width="25%">ชื่อ - นามสกุล</th>
                    <th width="25%">เบอร์โทรศัพท์</th>
                    <th width="30%">Line ID</th>

                    <th width="20%">สถานะ</th>

                </tr>
            </thead>

            <tbody>
                <?php while ($result_auction = mysqli_fetch_array($query_auction)) { ?>
                    <tr>
                        <td>
                            <?php echo $result_auction['Fname'] ?> - <?php echo $result_auction['Lname'] ?>
                        </td>
                        <td><?php echo $result_auction['phone'] ?> </td>
                        <td><?php echo $result_auction['line'] ?></td>

                        <td>
                            <?php if ($result_auction['auctionDetailStatus'] == 'unCheck') { ?>
                                <a href="?act=check&detail_id=<?php echo $auctionID ?>&check_id=<?php echo $result_auction['detailID'] ?>" class="btn btn-primary">ตรวจสอบข้อมูล</a>
                            <?php } else { ?>
                                ตรวจสอบแล้ว
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>
</div>