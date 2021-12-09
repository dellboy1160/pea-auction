<?php
if (isset($_REQUEST['update_id'])) {
    try {
        $encrypt = $_REQUEST['update_id'];
        $update_id = encrypt_decrypt($encrypt, 'decrypt');

        $sql_user = "SELECT * FROM user WHERE user_id = $update_id";
        $query_user  = mysqli_query($conn, $sql_user);
        $result_user  = mysqli_fetch_array($query_user);

        $num_user  = mysqli_num_rows($query_user);
        if ($num_user  == 0) {
            $error = "ไม่มีข้อมูลนี้อยู่";
        }


        if (isset($_REQUEST['btn_submit'])) {
            $Fname = $_REQUEST['txt_Fname'];
            $Lname = $_REQUEST['txt_Lname'];
            $line = $_REQUEST['txt_line'];
            $phone = $_REQUEST['txt_phone'];


            $sql = "UPDATE user SET
        Fname ='$Fname',
        Lname='$Lname',
        line='$line',
        phone='$phone'
        WHERE user_id = $update_id
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
            window.location = "user.php";
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
                <label for="validationCustomUsername" class="form-label">ชื่อผู้ใช้</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" disabled name="txt_title" value="<?php echo $result_user['username'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกหัวข้อประมูล
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>


            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ชื่อ</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_Fname" value="<?php echo $result_user['Fname'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกชื่อ
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">นามสกุล</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_Lname" value="<?php echo $result_user['Lname'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกนามสกุล
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">LINE ID</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_line" value="<?php echo $result_user['line'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend">
                    <div class="invalid-feedback">
                        กรุณากรอกLINE ID
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">เบอร์โทรศัพท์</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_phone" value="<?php echo $result_user['phone'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกเบอร์โทรศัพท์
                    </div>
                </div>
            </div>

            <button type="submit" name="btn_submit" class="btn btn-primary">บันทึก</button>
            <a href="user.php" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>

        </form>
    </div>
</div>