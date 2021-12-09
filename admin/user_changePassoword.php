<?php

if (isset($_REQUEST['user_id'])) {
    $encrypt = $_REQUEST['user_id'];
    $user_id =   encrypt_decrypt($encrypt, 'decrypt');
    $sql = "SELECT * FROM user WHERE user_id = '$user_id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    if (isset($_REQUEST['btn_submit'])) {

        $new_password = $_REQUEST['txt_new_password'];
        $confirm_password = $_REQUEST['txt_confirm_password'];



        if ($new_password == $confirm_password) {
            $hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET password = '$hashed_password' WHERE user_id = '$user_id'";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                $successMsg = "เปลี่ยนรหัสผ่านเสร็จสิ้น";
            }
        } else {
            $errorMsg = "กรอกรหัสผ่านใหม่ให้ตรงกัน";
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
            window.location = "user.php";
        });
    </script>
<?php } ?>
<?php if (isset($errorMsg)) { ?>
    <script>
        var errorMsg = '<?php echo $errorMsg; ?>';
        Swal.fire(
            errorMsg,
            '',
            'error',
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
        เปลี่ยนรหัสผ่าน <?php echo $result['username'] ?>

    </div>
    <div class="card-body ">
        <form action="" method="POST" class="row g-3 needs-validation" novalidate>



            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">รหัสผ่านใหม่</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_new_password" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกรหัสผ่านใหม่
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ยืนยันรหัสผ่านใหม่</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_confirm_password" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกยืนยันรหัสผ่านใหม่
                    </div>
                </div>
            </div>


            <button type="submit" name="btn_submit" class="btn btn-primary">บันทึก</button>
            <a href="user.php" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>

        </form>
    </div>
</div>