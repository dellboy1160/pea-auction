<?php
include('../server.php');
include('../ThaiDateFunction.php');
if (!isset($_SESSION['username'])) {
    header('location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php include('../web-structure/title_name.php') ?></title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Core theme CSS (includes Bootstrap)-->

    <link href="css/styles.css" rel="stylesheet" />
    <link href="../css/font.css" rel="stylesheet" />

</head>

<body>
    <?php include('../web-structure/user_navbar.php') ?>
    <!-- Page content-->
    <div class="container">
        <div class="text-center mt-5">
            <h1>รายการประมูล</h1>
            <hr>
        </div>
        <div class="row">

            <?php
            $sql = "SELECT * FROM auction WHERE status ='active'";
            $query = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($query);

            ?>
            <?php while ($result = mysqli_fetch_array($query)) { ?>
                <div class="col-md-6">
                    <div class="card" style="width:100%;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $result['auctionTitle'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">เริ่มต้น <?php echo number_format($result['auctionStartPrice'], 2) ?> บาท</h6>
                            <p class="card-text"><?php echo $result['auctionDetail'] ?> </p>

                            <?php

                            $startDate = $result['auctionStartDate'];
                            $endDate = $result['auctionEndDate'];

                            $start = DateThaiStart($startDate);
                            $end =  DateThaiEnd($endDate);
                            ?>
                            <hr>
                            <p class="card-text">วันเริ่มประมูล : <?php echo $start  ?> </p>
                            <p class="card-text">วันปิดประมูล : <?php echo $end  ?> </p>
                            <hr>
                            <!-- <a href="#" class="card-link">Another link</a> -->
                            <?php
                            $username = $_SESSION['username'];
                            $sql_user = "SELECT * FROM user WHERE username = '$username'";
                            $query_user = mysqli_query($conn, $sql_user);
                            $result_user = mysqli_fetch_array($query_user);

                            $user_id = $result_user['user_id'];
                            $sql_auctionDetail = "SELECT * FROM auction_detail WHERE user_id = $user_id ";
                            $query_auctionDetail = mysqli_query($conn, $sql_auctionDetail);
                            $num_auctionDetail = mysqli_num_rows($query_auctionDetail);
                            ?>


                            <?php
                            $today = date("Y-m-d H:i:s");
                            $startDate = $result['auctionStartDate'];
                            $endDate = $result['auctionEndDate'];

                            ?>


                            <?php if ($today < $startDate) { ?>
                                <button disabled class="card-link btn btn-secondary" style="width: 100%;">ลงชื่อ</button>
                            <?php } elseif ($today > $startDate && $today < $endDate) { ?>
                                <?php if ($num_auctionDetail  >= 1) { ?>
                                    <button disabled class="card-link btn btn-primary" style="width: 100%;">คุณลงชื่อแล้ว</button>
                                <?php } else { ?>
                                    <a href="auction_detail.php?auctionID=<?php echo $result['auctionID'] ?>" class="card-link btn btn-primary" style="width: 100%;">ลงชื่อ</a>
                                <?php } ?>
                            <?php   } else { ?>
                                <button disabled class="card-link btn btn-secondary" style="width: 100%;">หมดเวลาประมูล</button>
                            <?php    }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php
            if ($num == 0) { ?>
                <div class="alert alert-info text-center" style="font-size:18px" role="alert">
                    <strong>ยังไม่มีรายการประมูล</strong>
                </div>
            <?php   }  ?>

        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

</body>

</html>