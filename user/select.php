
<?php

require_once('../server.php');
if (isset($_REQUEST["imageID"])) {
     $output = '';

     $query = "SELECT * FROM auction_image WHERE imageID = '" . $_REQUEST["imageID"] . "'";
     $result = mysqli_query($conn, $query);
     $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
     while ($row = mysqli_fetch_array($result)) { ?>
          <img src="../admin/auction_image/<?php echo $row['imageFile'] ?>" width="100%" alt="">
<?php
     }
}

?>