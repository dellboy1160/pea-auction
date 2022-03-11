<?php
if (isset($_REQUEST['update_id'])) {

    try {
        $encrypt = $_REQUEST['update_id'];
        $update_id = encrypt_decrypt($encrypt, 'decrypt');
        $sql_doc = "SELECT * FROM document_offerprice WHERE documentID = $update_id";

        $query_doc = mysqli_query($conn, $sql_doc);
        $result_doc = mysqli_fetch_array($query_doc);

        $num_doc = mysqli_num_rows($query_doc);
        if ($num_doc == 0) {
            $error = "ไม่มีข้อมูลนี้อยู่";
        }

        if (isset($_REQUEST['btn_submit'])) {
            $title = $_REQUEST['txt_title'];
            $startDate = $_REQUEST['txt_startDate'];
            $endDate = $_REQUEST['txt_endDate'];


            $file_name = $_FILES['txt_file']['name'];
            $type = $_FILES['txt_file']['type'];
            $size = $_FILES['txt_file']['size'];
            $temp = $_FILES['txt_file']['tmp_name'];

            $path = "document/" . $file_name;
            $directory = "document/";

            $explode = explode('.', $_FILES['txt_file']['name']);
            $new_name = round(microtime(true)) . '.' . end($explode);

            // echo $new_name, '<br>';
            // echo $type;
            if (!empty($file_name)) {

                if ($type == 'application/pdf') {
                    if (!file_exists($path)) {
                        if ($size < 5000000) {
                            unlink($directory . $result_doc['documentFile']);
                            move_uploaded_file($temp, 'document/' . $new_name);
                        } else {
                            $errorMsg = 'ไฟล์รูปภาพใหญ่เกิน 5MB';
                        }
                    }
                } else {
                    $errorMsg =  'กรุณาใช้นามสกุลไฟล์เป็น PDF';
                }
            } else {
                $new_name = $result_doc['documentFile'];
            }


            if (!isset($errorMsg)) {
                $sql = "UPDATE document_offerprice SET 
            documentTitle = '$title', 
            documentFile = '$new_name',
            startDate = '$startDate',
            endDate = '$endDate'
            
            WHERE documentID = $update_id
            ";
                $query = mysqli_query($conn, $sql);

                if ($query) {
                    $successMsg = "บันทึกข้อมูลเรียบร้อย";
                }
            }
        }
    } catch (Error  $e) {
        $error = "ไม่มีข้อมูลนี้อยู่";
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
                <label for="validationCustomUsername" class="form-label">หัวข้อไฟล์</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_title" value="<?php echo $result_doc['documentTitle'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>

                    <div class="invalid-feedback">
                        กรุณากรอกหัวข้อไฟล์
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ไฟล์</label>
                <div class="input-group has-validation">
                    <input type="file" class="form-control" name="txt_file" id="validationCustomUsername" aria-describedby="inputGroupPrepend">
                    <div class="invalid-feedback">
                        กรุณากรอกไฟล์
                    </div>

                </div>
            </div>

            <?php
            $startDate = date("Y-m-d\TH:i:s", strtotime($result_doc['startDate']));

            $today_date = date('Y-m-d h:i:s');
            $dateMin = date("Y-m-d\TH:i", strtotime($today_date));
            ?>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">วันและเวลาเริ่มเสนอราคา</label>
                <div class="input-group has-validation">
                    <input type="datetime-local" min="<?php echo $dateMin ?>" class="form-control" value="<?php echo $startDate; ?>" name="txt_startDate" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกวันเริ่ม
                    </div>
                </div>
            </div>
            <?php
            $endDate = date("Y-m-d\TH:i:s", strtotime($result_doc['endDate']));
            ?>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">วันและเวลาสิ้นสุดเสนอราคา</label>
                <div class="input-group has-validation">
                    <input type="datetime-local" min="<?php echo $dateMin ?>" class="form-control" value="<?php echo $endDate; ?>" name="txt_endDate" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
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