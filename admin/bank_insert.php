<?php
if (isset($_REQUEST['btn_submit'])) {
    $bankName = $_REQUEST['txt_bankName'];
    $bankHolder = $_REQUEST['txt_bankHolder'];
    $bankNumber = $_REQUEST['txt_bankNumber'];

    $image_file = $_FILES['txt_file']['name'];
    $type = $_FILES['txt_file']['type'];
    $size = $_FILES['txt_file']['size'];
    $temp = $_FILES['txt_file']['tmp_name'];

    $path = "../QRCode_image/" . $image_file;
    $explode = explode('.', $_FILES['txt_file']['name']);
    $new_name = round(microtime(true)) . '.' . end($explode);


    if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
        if (!file_exists($path)) {
            if ($size < 2000000) {
                move_uploaded_file($temp, '../QRCode_image/' . $new_name);
            } else {
                $errorMsg = "ไฟล์รูปภาพใหญ่เกิน 2MB";
            }
        }
    } else {
        $errorMsg = "กรุณาใช้นามสกุลไฟล์เป็น JPG, JPEG, PNG & GIF เท่านั้น";
    }


    if (!isset($errorMsg)) {
        $sql = "INSERT INTO bank (bankName,bankHolder,bankNumber,QRCode_image)
        VALUES ('$bankName','$bankHolder','$bankNumber','$new_name')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $successMsg = "";
        }
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
            <div class="col-md-12">
                <label for="validationCustomUsername" class="form-label">รูป QR Code</label>
                <div class="input-group has-validation">
                    <input type="file" class="form-control" name="txt_file" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
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