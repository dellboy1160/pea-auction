<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4>ประวัติส่วนตัว</h4>
            <table width="100%">
                <tr>
                    <th width="130px">ชื่อผู้ใช้</th>
                    <th width="10px">:</th>
                    <td><?php echo $result_user['username'] ?></td>
                </tr>
                <tr>
                    <th>ชื่อ</th>
                    <th width="10px">:</th>
                    <td><?php echo $result_user['Fname'] ?> </td>
                </tr>
                <tr>
                    <th>นามสกุล</th>
                    <th width="10px">:</th>
                    <td><?php echo $result_user['Lname'] ?></td>
                </tr>
                <tr>
                    <th>LINE ID</th>
                    <th width="10px">:</th>
                    <td>
                        <?php if ($result_user['line'] == null) {
                            echo '*';
                        } else {
                            echo $result_user['line'];
                        }
                        ?>



                    </td>
                </tr>
                <tr>
                    <th>เบอร์โทรศัพท์</th>
                    <th width="10px">:</th>
                    <td><?php echo $result_user['phone'] ?></td>
                </tr>


            </table>
        </div>
        <div class="col-md-6">
            <h4> บัญชีธนาคาร</h4>
            <table width="100%">
                <tr>
                    <th width="130px">ชื่อธนาคาร</th>
                    <th width="10px">:</th>
                    <td>
                        <?php
                        if (empty($result_user['bankName'])) {
                            echo "*";
                        } else {
                            echo $result_user['bankName'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>ชื่อผู้ถือบัญชี</th>
                    <th width="10px">:</th>
                    <td>
                        <?php
                        if (empty($result_user['bankHolder'])) {
                            echo "*";
                        } else {
                            echo $result_user['bankHolder'];
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <th>หมายเลขบัญชี</th>
                    <th width="10px">:</th>
                    <td>
                        <?php
                        if (empty($result_user['bankNumber'])) {
                            echo "*";
                        } else {
                            echo $result_user['bankNumber'];
                        }
                        ?>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">

        <div class="col-md-3 " style="text-align: center;">
            <a href="?act=edit_password" class="btn btn-primary mt-5" style="width: 100%;">เปลี่ยนรหัสผ่าน</a>
        </div>
        <div class="col-md-3" style="text-align: center;">
            <a href="?act=edit_profile" class="btn btn-primary mt-5" style="width: 100%;">แก้ไข้อมูลส่วนตัว</a>
        </div>

    </div>

</div>