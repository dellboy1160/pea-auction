<?php
include('../server.php');
include('../ThaiDateFunction.php');
include('../encrypt_decrypt_function.php');
error_reporting(E_ERROR | E_PARSE);

if (!isset($_SESSION['adminUsername'])) {
    header('location: ../index.php');
}

if (isset($_REQUEST['auctionID'])) {
    $encrypt = $_REQUEST['auctionID'];
    $auctionID =   encrypt_decrypt($encrypt, 'decrypt');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php include('../web-structure/title_name.php') ?></title>

    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <link href="../css/table_responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/print.css">
    <link href="../css/font.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/print.css">



</head>


<body class="sb-nav-fixed">


    <div class="container mt-5">

        <h1 class="text-center">รายละเอียดรหัสประมูล <?php echo $auctionID ?></h1>


        <div class="row">
            <hr>
            <div class="col-md-6 mb-3">
                <?php
                try {
                    $sql_auction = "SELECT * FROM auction WHERE auctionID = $auctionID";
                    $query_auction = mysqli_query($conn, $sql_auction);
                    $num_auction = mysqli_num_rows($query_auction);
                    $result_auction = mysqli_fetch_array($query_auction);


                    if ($num_auction == 0) {
                        $error = "ไม่มีข้อมูลนี้อยู่";
                    }
                } catch (Error  $e) {
                    $error = "ไม่มีข้อมูลนี้อยู่";
                }

                ?>

                <h6><strong> หัวข้อ :</strong> <?php echo $result_auction['auctionTitle'] ?></h6>
                <h6><strong>ราคาเริ่มต้น :</strong> <?php echo number_format($result_auction['auctionStartPrice']) ?> บาท</h6>
                <h6><strong>วันเริ่มประมูล :</strong> <?php echo $result_auction['auctionStartDate'] ?></h6>
                <h6><strong>วันปิดประมูล :</strong> <?php echo $result_auction['auctionStartDate'] ?></h6>
                <h6><strong>รายละเอียด :</strong> <?php echo $result_auction['auctionDetail'] ?></h6>

                <?php
                try {
                    $sql = "SELECT * FROM offer_price WHERE auctionID = $auctionID AND auctionStatus ='won'";
                    $query = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_array($query);

                    $detailID = $result['detailID'];

                    $sql_detail = "SELECT * FROM auction_detail AS d
                INNER JOIN user AS u
                ON d.user_id = u.user_id
                
                WHERE d.detailID = $detailID";
                    $query_detial = mysqli_query($conn, $sql_detail);
                    $num_detail = mysqli_num_rows($query__detail);
                    $result_detail = mysqli_fetch_array($query_detial);

                    if ($num_detail == 0) {
                        $error = "ไม่มีข้อมูลนี้อยู่";
                    }
                } catch (Error  $e) {
                    $error = "ไม่มีข้อมูลนี้อยู่";
                }
                ?>


            </div>
            <div class="col-md-6">
                <strong> ผู้ชนะการประมูล </strong>
                <br>ชื่อผู้ใช้ : <?php echo $result_detail['username'] ?>
                <br>ชื่อ-นามสกุล : <?php echo $result_detail['Fname'] ?> - <?php echo $result_detail['Lname'] ?>
                <br>เบอร์โทรศัพท์ : <?php echo $result_detail['phone'] ?>
                <br>LINE ID : <?php echo $result_detail['line'] ?>

            </div>

            <hr>
            <a href="javascript:history.back()" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
        </div>


    </div>


    <div class="container" id="container" hidden>
        <div class="row">
            <div class="col-md-12">
                <?php
                $sql_detail = "SELECT * FROM auction_detail AS d

            INNER JOIN user AS u
            ON d.user_id = u.user_id
            
            WHERE d.auctionID = $auctionID";
                $query__detail = mysqli_query($conn, $sql_detail);

                $i = 1;
                ?>
                <h2 style="text-align: center;margin-top:50px;">รายชื่อคนลงประมูล</h2>
                <table border="1" class="table table-bordered" style="border-color: black;">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>วันที่ลงชื่อ</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>LINE ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($resilt_detail = mysqli_fetch_array($query__detail)) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $resilt_detail['Fname'] ?> - <?php echo $resilt_detail['Lname'] ?></td>
                                <td><?php
                                    $signDate = $resilt_detail['signDate'];
                                    echo signDate($signDate);

                                    ?></td>
                                <td><?php echo $resilt_detail['phone'] ?></td>
                                <td><?php echo $resilt_detail['line'] ?></td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="container" id="container2" hidden>
        <div class="row">
            <div class="col-md-12">
                <?php

                $sql_of = "SELECT * FROM offer_price AS o
            INNER JOIN auction_detail AS d
            ON o.detailID = d.detailID

            INNER JOIN user AS u
            ON u.user_id = d.user_id

            WHERE o.auctionID = $auctionID";

                $query_of = mysqli_query($conn, $sql_of);
                $j = 1;
                ?>
                <h2 style="text-align: center;margin-top:50px;">รายชื่อผู้ยื่นซอง</h2>
                <table border="1" class="table table-bordered" style="border-color: black;">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>วันที่ลงชื่อ</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>LINE ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($resilt_of = mysqli_fetch_array($query_of)) { ?>
                            <tr>
                                <td><?php echo $j ?></td>
                                <td><?php echo $resilt_of['Fname'] ?> - <?php echo $resilt_of['Lname'] ?></td>
                                <td><?php
                                    $signDate = $resilt_of['offerDate'];
                                    echo signDate($signDate);

                                    ?></td>
                                <td><?php echo $resilt_of['phone'] ?></td>
                                <td><?php echo $resilt_of['line'] ?></td>
                            </tr>
                        <?php $j++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="js/dataTable.js"></script>
    <script src="../js/validation.js"></script>
    <script src="../js/print.js"></script>
</body>

</html>