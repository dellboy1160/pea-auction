<?php
if (isset($_REQUEST['btn_submit'])) {
    $title = $_REQUEST['txt_title'];
    $startDate = $_REQUEST['txt_startDate'];
    $endDate = $_REQUEST['txt_endDate'];

    $file_name = $_FILES['txt_file']['name'];
    $type = $_FILES['txt_file']['type'];
    $size = $_FILES['txt_file']['size'];
    $temp = $_FILES['txt_file']['tmp_name'];

    $path = "document/" . $file_name;
    $explode = explode('.', $_FILES['txt_file']['name']);
    $new_name = round(microtime(true)) . '.' . end($explode);

    // echo $new_name, '<br>';
    // echo $type;

    if ($type == 'application/pdf') {
        if (!file_exists($path)) {
            if ($size < 5000000) {
                move_uploaded_file($temp, 'document/' . $new_name);
            } else {
                $errorMsg = 'ไฟล์รูปภาพใหญ่เกิน 5MB';
            }
        }
    } else {
        $errorMsg =  'กรุณาใช้นามสกุลไฟล์เป็น PDF';
    }
    if (!isset($errorMsg)) {
        $sql = "INSERT INTO document_offerprice (documentTitle,documentFile,startDate,endDate)
    VALUES ('$title','$new_name','$startDate','$endDate')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $successMsg = "บันทึกข้อมูลเรียบร้อย";
        }
    }
}
?>
<?php if (isset($successMsg)) { ?>

    <script type="text/javascript">
        var successMsg = '<?php echo $successMsg; ?>';
        Swal.fire(

            successMsg,
            '',
            'success',


        ).then(function() {
            window.location = "document_offerPrice.php";
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
                <label for="validationCustomUsername" class="form-label">หัวข้อไฟล์</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_title" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกหัวข้อไฟล์
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ไฟล์</label>
                <div class="input-group has-validation">
                    <input type="file" class="form-control" name="txt_file" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกไฟล์
                    </div>
                </div>
            </div>
            <?php
            $today_date = date('Y-m-d h:i:s');
            $dateMin = date("Y-m-d\TH:i", strtotime($today_date));


            ?>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">วันและเวลาเริ่มเสนอราคา</label>
                <div class="input-group has-validation">
                    <input type="datetime-local" min="<?php echo $dateMin ?>" class="form-control" name="txt_startDate" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกวันเริ่ม
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">วันและเวลาสิ้นสุดเสนอราคา</label>
                <div class="input-group has-validation">
                    <input type="datetime-local" min="<?php echo $dateMin ?>" class="form-control" name="txt_endDate" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกวันสิ้นสุด
                    </div>
                </div>
            </div>

            <button type="submit" name="btn_submit" class="btn btn-primary">บันทึก</button>
            <a href="javascript:history.back()" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>

        </form>
    </div>
</div>