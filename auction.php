<?php
include('server.php');
include('ThaiDateFunction.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php include('web-structure/title_name.php') ?></title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="user/css/styles.css" rel="stylesheet" />
    <link href="css/font.css" rel="stylesheet" />
</head>

<body>
    <?php include('web-structure/navbar.php') ?>
    <!-- Page content-->
    <div class="container">
        <div class="text-center mt-5">
            <h1>รายการประมูล</h1>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php
                $sql = "SELECT * FROM auction WHERE status ='active'";
                $query = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($query);

                ?>
                <?php while ($result = mysqli_fetch_array($query)) { ?>
                    <div class="col-md-12">
                        <div class="card" style="width:100%;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $result['auctionTitle'] ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">เริ่มต้น <?php echo number_format($result['auctionStartPrice']) ?> บาท</h6>
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



                                <!-- Button trigger modal -->
                                <button type="button" style="width: 100%;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    รายละเอียด
                                </button>



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
            <div class="col-md-3"></div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>กรุณาเข้าสู่ระบบก่อนทำรายการ</h5>
                </div>
                <div class="modal-footer">

                    <a href="login.php" type="button" class="btn btn-primary">เข้าสู่ระบบ</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

 
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="user/js/scripts.js"></script>
</body>

</html>