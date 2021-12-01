<?php
if (isset($_REQUEST['update_id'])) {
    try {
        $update_id = $_REQUEST['update_id'];
        $sql_auction = "SELECT * FROM auction WHERE auctionID = $update_id";
        $query_auction = mysqli_query($conn, $sql_auction);
        $result_auction = mysqli_fetch_array($query_auction);

        $num_auction = mysqli_num_rows($query_auction);
        if ($num_auction == 0) {
            $error = "ไม่มีข้อมูลนี้อยู่";
        }


        if (isset($_REQUEST['btn_submit'])) {
            $title = $_REQUEST['txt_title'];
            $startPrice = $_REQUEST['txt_startPrice'];
            $startDate = $_REQUEST['txt_startDate'];
            $endDate = $_REQUEST['txt_endDate'];
            $detail = $_REQUEST['txt_detail'];

            $sql = "UPDATE auction SET
        auctionTitle ='$title',
        auctionStartDate='$startDate',
        auctionEndDate='$endDate',
        auctionStartPrice='$startPrice',
        auctionDetail='$detail'
        WHERE auctionID = $update_id
        ";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                $successMsg = "";
            }
        }
    } catch (Error  $e) {
        $error = "ไม่มีข้อมูลนี้อยู่";
    }
}


?>
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
        <i class="far fa-edit"></i>
        แก้ไขข้อมูล

    </div>
    <div class="card-body ">
        <form action="" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">หัวข้อประมูล</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_title" value="<?php echo $result_auction['auctionTitle'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกหัวข้อประมูล
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ราคาเริ่มต้น</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_startPrice" value="<?php echo $result_auction['auctionStartPrice'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกราคาเริ่มต้น
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">วันและเวลาเริ่มประมูล</label>

                <?php
                $startDate = date("Y-m-d\TH:i:s", strtotime($result_auction['auctionStartDate']));
                ?>
                <div class="input-group has-validation">
                    <input type="datetime-local" class="form-control" name="txt_startDate" value="<?php echo $startDate; ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกวันและเวลาเริ่มประมูล
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">วันและเวลาปิดประมูล</label>

                <?php
                $endDate = date("Y-m-d\TH:i:s", strtotime($result_auction['auctionEndDate']));
                ?>
                <div class="input-group has-validation">
                    <input type="datetime-local" class="form-control" name="txt_endDate" value="<?php echo $endDate; ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกวันและเวลาปิดประมูล
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">รายละเอียดการประมูล</label>
                <div class="input-group has-validation">

                    <textarea class="form-control" name="txt_detail" id="" cols="30" rows="5" required><?php echo $result_auction['auctionDetail'] ?></textarea>
                    <div class="invalid-feedback">
                        กรุณากรอกรายละเอียดการประมูล
                    </div>
                </div>
            </div>
            <button type="submit" name="btn_submit" class="btn btn-primary">บันทึก</button>
            <a href="javascript:history.back()" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>

        </form>
    </div>
</div>