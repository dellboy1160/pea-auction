<table width="100%">
    <tr>
        <th width="150px">ชื่อผู้ใช้</th>
        <th width="10px">:</th>
        <td><?php echo $result_user['username'] ?></td>
    </tr>
    <tr>
        <th>ชื่อ-นามสกุล</th>
        <th width="10px">:</th>
        <td><?php echo $result_user['Fname'] ?> - <?php echo $result_user['Lname'] ?></td>
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