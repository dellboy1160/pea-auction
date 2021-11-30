<?php
if (isset($_REQUEST['update_id'])) {
    $update_id = $_REQUEST['update_id'];
    $sql_doc = "SELECT * FROM document_announce WHERE documentID = $update_id";

    $query_doc = mysqli_query($conn, $sql_doc);
    $result_doc = mysqli_fetch_array($query_doc);

    if (isset($_REQUEST['btn_submit'])) {
        $title = $_REQUEST['txt_title'];


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
                    if ($size < 2000000) {
                        unlink($directory . $result_doc['documentFile']);
                        move_uploaded_file($temp, 'document/' . $new_name);
                    } else {
                        $errorMsg = 'ไฟล์รูปภาพใหญ่เกิน 2MB';
                    }
                }
            } else {
                $errorMsg =  'กรุณาใช้นามสกุลไฟล์เป็น PDF';
            }
        } else {
            $new_name = $result_doc['documentFile'];
        }


        if (!isset($errorMsg)) {
            $sql = "UPDATE document_announce SET 
            documentTitle = '$title', 
            documentFile = '$new_name'
            
            WHERE documentID = $update_id
            ";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                $successMsg = "บันทึกข้อมูลเรียบร้อย";
            }
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
            window.location = "document_announce.php";
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

            <div class="col-md-6"></div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ไฟล์เก่า <i class="far fa-file-pdf" style="color: red;"></i> <a href="document/<?php echo $result_doc['documentFile'] ?>" target="_blank"> ดาวโหลดไฟล์</a></label>
            </div>



            <button type="submit" name="btn_submit" class="btn btn-primary">บันทึก</button>
            <a href="javascript:history.back()" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>

        </form>
    </div>
</div>