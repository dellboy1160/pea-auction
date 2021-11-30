<?php
if (isset($_REQUEST['btn_submit'])) {
    $bankName = $_REQUEST['txt_bankName'];
    $bankHolder = $_REQUEST['txt_bankHolder'];
    $bankNumber = $_REQUEST['txt_bankNumber'];

    $sql = "INSERT INTO bank (bankName,bankHolder,bankNumber)
    VALUES ('$bankName','$bankHolder','$bankNumber')";
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
            window.location = "bank.php";
        });
    </script>
<?php } ?>
<?php
if (isset($errorMsg)) {
?>
    <script type="text/javascript">
        var errorMsg = '<?php echo $errorMsg; ?>';
        Swal.fire(
            errorMsg,
            '',
            'error'
        )
    </script>
<?php } ?>
<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="far fa-plus-square"></i>
        เพิ่มข้อมูล
    </div>
    <div class="card-body ">
        <form action="" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ชื่อธนาคาร</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_bankName" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกชื่อธนาคาร
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ชื่อผู้ถือบัตร</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_bankHolder" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกชื่อผู้ถือบัตร
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">หมายเลขบัญชี</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_bankNumber" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกหมายเลขบัญชี
                    </div>
                </div>
            </div>

            <button type="submit" name="btn_submit" class="btn btn-primary">บันทึก</button>
            <a href="javascript:history.back()" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>

        </form>
    </div>
</div>