<?php
require_once('../server.php');
if (isset($_REQUEST["imageID"])) {
    $output = '';
    // $connect = mysqli_connect("localhost", "cp640956_bidmcv", "bidmcvDatabase@64", "cp640956_pea-auction");
    $query = "SELECT * FROM offer_price WHERE offerID = '" . $_REQUEST["imageID"] . "'";
    $result = mysqli_query($conn, $query);
    $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while ($row = mysqli_fetch_array($result)) { ?>
        <img src="../refund_image/<?php echo $row['refundPaymentImage'] ?>" width="100%" alt="">
<?php
    }
}

?>