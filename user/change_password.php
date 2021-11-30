<?php
if (isset($_REQUEST['btn_submit'])) {
    $old_password = $_REQUEST['txt_old_password'];

    $new_password = $_REQUEST['txt_new_password'];

    $confirm_password = $_REQUEST['txt_confirm_password'];
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);

    if (password_verify($old_password, $result['password'])) {
        if ($new_password == $confirm_password) {
            $hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET password = '$hashed_password' WHERE username = '$username'";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                $successMsg = "เปลี่ยนรหัสผ่านเสร็จสิ้น";
            }
        } else {
            $errorMsg = "กรอกรหัสผ่านใหม่ให้ตรงกัน";
        }
    } else {
        $errorMsg = "กรอกรหัสผ่านเดิมให้ถูกต้อง";
    }
}
?>

<?php if (isset($successMsg)) { ?>
    <script>
        Swal.fire(
            'เปลี่ยนรหัสผ่านเสร็จสิ้น',
            '',
            'success',


        ).then(function() {
            window.location = "profile.php";
        });
    </script>
<?php } ?>
<?php if (isset($errorMsg)) { ?>
    <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
        <strong><?php echo $errorMsg ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
<form action="" method="POST" class="needs-validation" novalidate>
    <div class="container">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="exampleFormControlInput1" class="form-label">กรอกรหัสผ่านเดิม</label>
                <input type="password" class="form-control" name="txt_old_password" id="exampleFormControlInput1" required>
                <div class="invalid-feedback">
                    กรุณากรอกรหัสผ่านปัจจุบัน
                </div>
            </div>
            <div class="col-md-6"></div>
            <div class="mb-3 col-md-6">
                <label for="exampleFormControlInput1" class="form-label">กรอกรหัสผ่านใหม่</label>
                <input type="password" class="form-control" name="txt_new_password" id="exampleFormControlInput1" required>
                <div class="invalid-feedback">
                    กรุณาระบุรหัสผ่าน
                </div>
            </div>
            <div class="mb-3 col-md-6">
                <label for="exampleFormControlInput1" class="form-label">กรอกรหัสผ่านใหม่อีกครั้ง</label>
                <input type="password" class="form-control" name="txt_confirm_password" id="exampleFormControlInput1" required>
                <div class="invalid-feedback">
                    กรุณายืนยันรหัสผ่าน
                </div>
            </div>

            <dib class="col-md-3">
                <button type="submit" name="btn_submit" class="btn btn-primary" style="width: 100%;">เปลี่ยนรหัสผ่าน</button>
            </dib>
        </div>
    </div>

</form>