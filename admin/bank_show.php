<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        ตารางรายการเอกสาร
        <a href="?act=insert" style="float: right;" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> เพิ่มรายการ</a>
    </div>
    <div class="card-body ">
        <table id="example" class="table table-bordered">
            <?php
            $sql_bank = "SELECT * FROM bank";
            $query_bank = mysqli_query($conn, $sql_bank);

            ?>
            <thead>
                <tr>
                    <th>ชื่อธนาคาร</th>
                    <th>ชื่อผู้ถือบัตร</th>
                    <th>หมายเลขบัญชี</th>

                    <th width="10%"></th>

                </tr>
            </thead>

            <tbody>
                <?php while ($result_bank = mysqli_fetch_array($query_bank)) { ?>
                    <tr>
                        <td data-label="ชื่อธนาคาร"><?php echo $result_bank['bankName'] ?></td>
                        <td data-label="ชื่อผู้ถือบัตร"><?php echo $result_bank['bankHolder'] ?></td>
                        <td data-label="หมายเลขบัญชี"><?php echo $result_bank['bankNumber'] ?></td>

                        <td style="text-align: center;">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <?php
                                $bankID = $result_bank['bankID'];
                                $encrypt = encrypt_decrypt($bankID, 'encrypt');
                                ?>
                                <a href="?act=edit&update_id=<?php echo $encrypt ?>" type="button" class="btn btn-warning">แก้ไข</a>
                                <a href="?delete_id=<?php echo $encrypt ?>" onclick="return confirm('ยืนยันการลบ');" type="button" class="btn btn-danger">ลบ</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>