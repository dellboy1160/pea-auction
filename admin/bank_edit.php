<?php
if (isset($_REQUEST['update_id'])) {
    try {

        $encrypt = $_REQUEST['update_id'];
        $update_id = encrypt_decrypt($encrypt, 'decrypt');

        $sql_bank = "SELECT * FROM bank WHERE bankID = $update_id";
        $query_bank = mysqli_query($conn, $sql_bank);
        $result_bank = mysqli_fetch_array($query_bank);

        $num_bank = mysqli_num_rows($query_bank);
        if ($num_bank == 0) {
            $error = "ไม่มีข้อมูลนี้อยู่";
        }

        if (isset($_REQUEST['btn_submit'])) {
            $bankName = $_REQUEST['txt_bankName'];
            $bankHolder = $_REQUEST['txt_bankHolder'];
            $bankNumber = $_REQUEST['txt_bankNumber'];

            $image_file = $_FILES['txt_file']['name'];
            $type = $_FILES['txt_file']['type'];
            $size = $_FILES['txt_file']['size'];
            $temp = $_FILES['txt_file']['tmp_name'];

            $path = "../QRCode_image/" . $image_file;
            $directory = "../QRCode_image/";

            $explode = explode('.', $_FILES['txt_file']['name']);
            $new_name = round(microtime(true)) . '.' . end($explode);


            if ($image_file) {
                if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
                    if (!file_exists($path)) {
                        if ($size < 2000000) {
                            unlink($directory . $result_bank['QRCode_image']); //ลบไฟล์ก่อนหน้า แล้วค่อยอัพเดท 
                            move_uploaded_file($temp, '../QRCode_image/' . $new_name);
                        } else {
                            $errorMsg = "ไฟล์รูปภาพใหญ่เกิน 2MB";
                        }
                    } else {
                        $errorMsg = "File name already exists...";
                    }
                } else {
                    $errorMsg = "กรุณาใช้นามสกุลไฟล์เป็น JPG, JPEG, PNG & GIF เท่านั้น";
                }
            } else {
                $new_name = $result_bank['QRCode_image'];
            }

            $sql = "UPDATE bank SET
            bankName='$bankName',
            bankHolder='$bankHolder',
            bankNumber='$bankNumber',
            QRCode_image='$new_name'
            WHERE bankID = $update_id";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                $successMsg = '';
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
            window.location = "bank.php";
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
        <form action="" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ชื่อธนาคาร</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_bankName" value="<?php echo $result_bank['bankName'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกหัวข้อประมูล
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ชื่อผู้ถือบัตร</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_bankHolder" value="<?php echo $result_bank['bankHolder'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกราคาเริ่มต้น
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">หมายเลขบัญชี</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_bankNumber" value="<?php echo $result_bank['bankNumber'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกวันและเวลาสิ้นสุดการประมูล
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationCustomUsername" class="form-label">รูป QR Code</label>
                <div class="input-group has-validation">
                    <input type="file" class="form-control" name="txt_file" id="validationCustomUsername" aria-describedby="inputGroupPrepend">
                    <div class="invalid-feedback">
                        กรุณากรอกหมายเลขบัญชี
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <label for="validationCustomUsername" class="form-label">รูปเดิม</label>
                <div class="input-group has-validation">
                    <img src="../QRCode_image/<?php echo $result_bank['QRCode_image'] ?>" style="width: 200px;" alt="">
                </div>
            </div>

            <button type="submit" name="btn_submit" class="btn btn-primary">บันทึก</button>
            <a href="javascript:history.back()" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>

        </form>
    </div>
</div>