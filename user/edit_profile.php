<?php
$username = $_SESSION['username'];
$sql_user = "SELECT * FROM user WHERE username='$username'";
$query_user = mysqli_query($conn, $sql_user);
$result = mysqli_fetch_array($query_user);

$user_id = $result['user_id'];

if (isset($_REQUEST['btn_submit'])) {
    $Fname = $_REQUEST['txt_Fname'];
    $Lname = $_REQUEST['txt_Lname'];
    $line = $_REQUEST['txt_line'];
    $phone = $_REQUEST['txt_phone'];

    $sql = "UPDATE user SET Fname ='$Fname',
    Lname='$Lname',
    line='$line',
    phone='$phone'
    WHERE user_id = $user_id
    ";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $successMsg = "";
    }
}
?>
<?php if (isset($successMsg)) { ?>
    <script>
        Swal.fire(
            'แก้ไขข้อมูลเสร็จสิ้น',
            '',
            'success',


        ).then(function() {
            window.location = "profile.php";
        });
    </script>
<?php } ?>
<form action="" method="POST" class="row g-3 needs-validation" novalidate>
    <div class="col-md-6">
        <label for="validationCustomUsername" class="form-label">ชื่อผู้ใช้</label>
        <div class="input-group has-validation">
            <input disabled type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $username; ?>" required>

        </div>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <label for="validationCustomUsername" class="form-label">ชื่อ</label>
        <div class="input-group has-validation">
            <input type="text" name="txt_Fname" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $result['Fname'] ?>" required>
            <div class="invalid-feedback">
                กรุณากรอกชื่อ
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="validationCustomUsername" class="form-label">นามสกุล</label>
        <div class="input-group has-validation">
            <input type="text" name="txt_Lname" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $result['Lname'] ?>" required>
            <div class="invalid-feedback">
                กรุณากรอกนามสกุล
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="validationCustomUsername" class="form-label">LINE ID (ถ้ามี)</label>
        <div class="input-group has-validation">
            <input type="text" name="txt_line" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $result['line'] ?>" >
            <div class="invalid-feedback">
                กรุณากรอก Line ID
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label for="validationCustomUsername" class="form-label">เบอร์โทรศัพท์</label>
        <div class="input-group has-validation">
            <input type="text" name="txt_phone" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $result['phone'] ?>" required>
            <div class="invalid-feedback">
                กรุณากรอกเบอร์โทรศัพท์
            </div>
        </div>
    </div>
    <dib class="col-md-3">
        <button type="submit" name="btn_submit" class="btn btn-primary" style="width: 100%;">บันทึก</button>
    </dib>
</form>