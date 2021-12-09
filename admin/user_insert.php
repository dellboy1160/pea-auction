<?php
if (isset($_REQUEST['btn_submit'])) {
    $username = $_REQUEST['txt_username'];
    $password = $_REQUEST['txt_password'];
    $confirm_password = $_REQUEST['txt_confirm_password'];
    $Fname = $_REQUEST['txt_Fname'];
    $Lname = $_REQUEST['txt_Lname'];
    $line = $_REQUEST['txt_line'];
    $phone = $_REQUEST['txt_phone'];

    $sql_user = "SELECT * FROM user WHERE username = '$username'";
    $query_user = mysqli_query($conn, $sql_user);
    $num_user = mysqli_num_rows($query_user);

    if ($num_user == 0) {
        if ($password == $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);


            $sql = "INSERT INTO user (username,password,phone,line,Fname,Lname)
            VALUES ('$username','$hashed_password','$phone','$line','$Fname','$Lname')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                $successMsg = "สมัครสมาชิกเสร็จสิ้น";
            }
        } else {
            $errorMsg = "กรุณากรอกรหัสผ่านให้ตรงกัน";
        }
    } else {
        $errorMsg = "ชื่อผู้ใช้ถูกใช้ไปแล้ว";
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
        <form action="" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ชื่อผู้ใช้</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_username" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php if (isset($username)) {
                                                                                                                                                                echo $username;
                                                                                                                                                            } ?>" required>
                    <div class="invalid-feedback">
                        กรุณากรอกชื่อผู้ใช้
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">รหัสผ่าน</label>
                <div class="input-group has-validation">
                    <input type="password" class="form-control" name="txt_password" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกรหัสผ่าน
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ยืนยันรหัสผ่าน</label>
                <div class="input-group has-validation">
                    <input type="password" class="form-control" name="txt_confirm_password" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        กรุณากรอกยืนยันรหัสผ่าน
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">ชื่อ</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_Fname" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php if (isset($Fname)) {
                                                                                                                                                            echo $Fname;
                                                                                                                                                        } ?>" required>
                    <div class="invalid-feedback">
                        กรุณากรอกชื่อ
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">นามสกุล</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_Lname" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php if (isset($Lname)) {
                                                                                                                                                            echo $Lname;
                                                                                                                                                        } ?>" required>
                    <div class="invalid-feedback">
                        กรุณากรอกนามสกุล
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">LINE ID</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_line" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php if (isset($line)) {
                                                                                                                                                            echo $line;
                                                                                                                                                        } ?>" required>
                    <div class="invalid-feedback">
                        กรุณากรอกLINE ID
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">เบอร์โทรศัพท์</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="txt_phone" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php if (isset($phone)) {
                                                                                                                                                            echo $phone;
                                                                                                                                                        } ?>" required>
                    <div class="invalid-feedback">
                        กรุณากรอกเบอร์โทรศัพท์
                    </div>
                </div>
            </div>
            <button type="submit" name="btn_submit" class="btn btn-primary">บันทึก</button>
            <a href="javascript:history.back()" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>

        </form>
    </div>
</div>