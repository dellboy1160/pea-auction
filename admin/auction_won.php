<?php
include('../server.php');

$encrypt1 = $_REQUEST['auctionID'];
$encrypt2 = $_REQUEST['detailID'];

$auctionID = encrypt_decrypt($encrypt1, 'decrypt');
$detailID = encrypt_decrypt($encrypt2, 'decrypt');

$today = date("Y-m-d");

$sql = "UPDATE offer_price SET auctionStatus = 'won',
announceWonDate = '$today'
 
WHERE detailID = $detailID";
$query = mysqli_query($conn, $sql);

if ($query) {
    $sql_u = "UPDATE offer_price SET auctionStatus = 'lose',announceWonDate = '$today' WHERE auctionID = $auctionID AND auctionStatus != 'won'";
    $query_u = mysqli_query($conn, $sql_u);
    if ($query_u) {
        $successMsg = "";
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
            window.location = "?act=search&detail_id=<?php echo $_REQUEST['auctionID'] ?>";
        });
    </script>
<?php exit();
} ?>