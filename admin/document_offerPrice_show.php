<div class="card mb-4 mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        ตารางรายการเอกสาร
        <a href="?act=insert" style="float: right;" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> เพิ่มรายการ</a>
    </div>
    <div class="card-body ">
        <table id="example" class="table table-bordered">
            <?php
            $sql_document = "SELECT * FROM document_offerprice";
            $query_document = mysqli_query($conn, $sql_document);

            ?>
            <thead>
                <tr>
                    <th>หัวข้อ</th>
                    <th>ไฟล์</th>
                    <th>วัน/เวลาเสนอราคา</th>
                    <th width="10%"></th>

                </tr>
            </thead>

            <tbody>
                <?php while ($result_document = mysqli_fetch_array($query_document)) { ?>
                    <tr>
                        <td data-label="หัวข้อ"><?php echo $result_document['documentTitle'] ?></td>
                        <td data-label="ไฟล์">
                            <i class="far fa-file-pdf" style="color: red;"></i> <a href="document/<?php echo $result_document['documentFile'] ?>" target="_blank"> ดาวโหลดไฟล์</a>
                        </td>
                        <td>
                            <?php
                            $startDate = $result_document['startDate'];
                            $endDate = $result_document['endDate'];
                            ?>
                            เริ่มเสนอราคา : <?php echo signDate($startDate) ?><br>
                            สิ้นสุดเสนอราคา : <?php echo signDate($endDate) ?>
                        </td>
                        <td style="text-align: center;">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a href="?act=edit&update_id=<?php echo $result_document['documentID'] ?>" type="button" class="btn btn-warning">แก้ไข</a>
                                <a href="?delete_id=<?php echo $result_document['documentID'] ?>" onclick="return confirm('ยืนยันการลบ');" type="button" class="btn btn-danger">ลบ</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>