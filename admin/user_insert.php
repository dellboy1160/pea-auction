<?php
if (isset($_REQUEST['btn_submit'])) {
    $title = $_REQUEST['txt_title'];
    $startPrice = $_REQUEST['txt_startPrice'];
    $startDate = $_REQUEST['txt_startDate'];
    $endDate = $_REQUEST['txt_endDate'];
    $detail = $_REQUEST['txt_detail'];


    $sql = "INSERT INTO auction (auctionTitle,acutionStartPrice,auctionStartDate,auctionEndDate,auctionDetail)
    VALUES ('$title','$startPrice','$staartDate','$endDate','$detail')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $successMsg = "";
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
<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="far fa-plus-square"></i>
        เพิ่มข้อมูล

    </div>
    <div class="card-body ">
        <form action="" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">หัวข้อประมูล</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_title" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกหัวข้อประมูล
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ราคาเริ่มต้น</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_startPrice" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกราคาเริ่มต้น
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">วันและเวลาเริ่มประมูล</label>
                <div class="input-group has-validation">
                    <input type="datetime-local" class="form-control" name="txt_startDate" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกวันและเวลาเริ่มประมูล
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">วันและเวลาสิ้นสุดการประมูล</label>
                <div class="input-group has-validation">
                    <input type="datetime-local" class="form-control" name="txt_endDate" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกวันและเวลาสิ้นสุดการประมูล
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">รายละเอียดการประมูล</label>
                <div class="input-group has-validation">

                    <textarea class="form-control" name="txt_detail" id="" cols="30" rows="5" required></textarea>
                    <div class="invalid-feedback">
                        กรุณากรอกรายละเอียดการประมูล
                    </div>
                </div>
            </div>
            <button type="submit" name="btn_submit" class="btn btn-primary">บันทึก</button>


        </form>
    </div>
</div>