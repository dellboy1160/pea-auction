<?php
include('../server.php');
$userID = $_REQUEST['userID'];
$auctionID = $_REQUEST['auctionID'];
$offerID = $_REQUEST['offerID'];
$detailID = $_REQUEST['detailID'];

$today = date("Y-m-d H:i:s");

$sql = "UPDATE offer_price SET auctionStatus = 'won'
 
WHERE detailID = $detailID";
$query = mysqli_query($conn, $sql);
    
if ($query) {
    $sql_u = "UPDATE offer_price SET auctionStatus = 'lose' WHERE auctionID = $auctionID AND auctionStatus != 'won'";
    $query_u = mysqli_query($conn, $sql_u);
    if ($query_u) {
    }
}
