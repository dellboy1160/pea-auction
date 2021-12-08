<?php
$username = $_SESSION['username'];

$sql = "SELECT * FROM auction AS a
INNER JOIN auction_detail AS d
ON a.auctionID = d.auctionID

INNER JOIN user AS u
ON d.user_id = u.user_id

WHERE u.username = '$username' AND status='unActive'
";

$query = mysqli_query($conn, $sql);
?>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <th width="15%">รหัสประมูล</th>
            <th>หัวข้อประมูล</th>
            <th width="5%"></th>
        </tr>
    </thead>
    <tbody>
        <?php while ($result = mysqli_fetch_array($query)) { ?>
            <tr>
                <td><?php echo $result['auctionID'] ?></td>
                <td><?php echo $result['auctionTitle'] ?></td>
                <td><a href="auction_recordDetail.php?auctionID=<?php echo $result['auctionID'] ?>" class="btn btn-warning"><i class="fas fa-search"></i></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>