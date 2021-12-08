<?php
if (isset($_POST["imageID"])) {
     $output = '';
     $connect = mysqli_connect("localhost", "root", "", "pea-auction");
     $query = "SELECT * FROM auction_image WHERE imageID = '" . $_POST["imageID"] . "'";
     $result = mysqli_query($connect, $query);
     $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
     while ($row = mysqli_fetch_array($result)) { ?>
          <img src="../admin/auction_image/<?php echo $row['imageFile'] ?>" width="100%" alt="">
<?php
     }
}

?>