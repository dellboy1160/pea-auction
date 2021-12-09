<?php
try {
    $encrypt = $_REQUEST['auctionID'];
    $auctionID = encrypt_decrypt($encrypt, 'decrypt');
    $sql_auction = "SELECT * FROM auction WHERE auctionID = $auctionID";
    $query_auction = mysqli_query($conn, $sql_auction);
    $num_auction = mysqli_num_rows($query_auction);
    $result_auction = mysqli_fetch_array($query_auction);

    if ($num_auction == 0) {
        $error = "ไม่มีข้อมูลนี้อยู่";
    }
} catch (Error  $e) {
    $error = "ไม่มีข้อมูลนี้อยู่";
}
$sql_image = "SELECT * FROM auction_image WHERE auctionID = $auctionID";
$query_image = mysqli_query($conn, $sql_image);




if (isset($_REQUEST['delete_id'])) {
    $encrypt = $_REQUEST['delete_id'];
    $delete_id = encrypt_decrypt($encrypt, 'decrypt');

    $sql_img = "SELECT * FROM auction_image WHERE imageID  = $delete_id";
    $query_img = mysqli_query($conn, $sql_img);
    $result_img = mysqli_fetch_array($query_img);
    unlink("auction_image/" . $result_img['imageFile']);


    $sql = "DELETE  FROM auction_image WHERE imageID   = $delete_id ";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $successMsg = "";
    }
}
?>
<?php if (isset($successMsg)) { ?>
    <script>
        Swal.fire(
            'ลบข้อมูลเรียบร้อย',
            '',
            'success',


        ).then(function() {
            window.location = "auction.php?act=image&auctionID=<?php echo $_REQUEST['auctionID'] ?>";
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
<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        ตารางรายการรูปภาพ

        <a href="image_insert.php?auctionID=<?php echo $encrypt ?>" style="float: right;" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> เพิ่มรายการ</a>




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
                    <th width="10%">รูป</th>

                    <th></th>
                    <th width="10%"></th>
                </tr>
            </thead>

            <tbody>
                <?php while ($result_image = mysqli_fetch_array($query_image)) { ?>
                    <tr>
                        <td style="text-align: center;"><img src="auction_image/<?php echo $result_image['imageFile'] ?>" width="100px" height="100px" alt=""></td>
                        <td></td>
                        <td style="text-align: center;">
                            <div class="btn-group">
                                <?php

                                $imageID = $result_image['imageID'];
                                $encrypt = encrypt_decrypt($imageID, 'encrypt');

                                ?>
                                <a href="image_edit.php?auctionID=<?php echo $_REQUEST['auctionID'] ?>&updateID=<?php echo $encrypt ?>" class="btn btn-warning " aria-current="page">แก้ไข</a>

                                <a href="auction.php?act=image&auctionID=<?php echo $_REQUEST['auctionID'] ?>&delete_id=<?php echo $encrypt ?>" onclick="return confirm('ยืนยันการลบ');" class="btn btn-danger">ลบ</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>

        </table>

    </div>
    <a href="auction.php" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
</div>