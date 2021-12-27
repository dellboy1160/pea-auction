<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        ตารางรายการประมูล
        <a href="?act=insert" style="float: right;" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> เพิ่มรายการ</a>
    </div>
    <div class="card-body ">
        <table id="example" class="table table-bordered">
            <?php
            $sql_user = "SELECT * FROM user";
            $query_user = mysqli_query($conn, $sql_user);

            ?>
            <thead>
                <tr>
                    <th>ชื่อผู้ใช้</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>LINE ID</th>

                    <th width="/0%"></th>
                </tr>
            </thead>

            <tbody>
                <?php while ($result_user = mysqli_fetch_array($query_user)) { ?>
                    <tr>
                        <td data-label="ชื่อผู้ใช้"><?php echo $result_user['username'] ?></td>
                        <td data-label="ชื่อ-นามสกุล"><?php echo $result_user['Fname'] ?> - <?php echo $result_user['Lname'] ?></td>
                        <td data-label="เบอร์โทรศัพท์"><?php echo $result_user['phone'] ?> <br></td>
                        <td data-label="LINE ID">
                            <?php echo $result_user['line'] ?>

                            <?php if (empty($result_user['line'])) {
                                echo '-';
                            } else {
                                echo $result_user['line'];
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <?php
                                $user_id = $result_user['user_id'];
                                $encrypt = encrypt_decrypt($user_id, 'encrypt');
                                ?>
                                <a href="?act=changePassword&user_id=<?php echo  $encrypt ?>" type="button" class="btn btn-secondary">เปลี่ยนรหัสผ่าน</a>
                                <a href="?act=edit&update_id=<?php echo  $encrypt ?>" type="button" class="btn btn-warning">แก้ไข</a>
                                <a href="?delete_id=<?php echo  $encrypt ?>" onclick="return confirm('ยืนยันการลบ');" type="button" class="btn btn-danger">ลบ</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>