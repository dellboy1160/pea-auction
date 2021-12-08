<?php
include('../server.php');
include('../ThaiDateFunction.php');
include('../encrypt_decrypt_function.php');


if (isset($_REQUEST['auctionID'])) {
    $auctionID = $_REQUEST['auctionID'];

    $sql_auction = "SELECT * FROM auction WHEre auctionID = $auctionID";
    $query_auction = mysqli_query($conn, $sql_auction);
    $result_auction = mysqli_fetch_array($query_auction);
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
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <link href="css/styles.css" rel="stylesheet" />

    <link href="../css/font.css" rel="stylesheet" />
</head>

<body>

    <!-- Page content-->
    <div class="container">
        <div class=" mt-5">
            <h1 class="text-center ">รายละเอียดรหัสประมูล <?php echo $auctionID ?></h1>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <?php
                        $sql_auction = "SELECT * FROM auction WHERE auctionID = $auctionID";
                        $query_auction = mysqli_query($conn, $sql_auction);
                        $result_auction = mysqli_fetch_array($query_auction)
                        ?>

                        <h6><strong> หัวข้อ :</strong> <?php echo $result_auction['auctionTitle'] ?></h6>
                        <h6><strong>ราคาเริ่มต้น :</strong> <?php echo number_format($result_auction['auctionStartPrice']) ?> บาท</h6>
                        <h6><strong>วันเริ่มประมูล :</strong> <?php echo $result_auction['auctionStartDate'] ?></h6>
                        <h6><strong>วันปิดประมูล :</strong> <?php echo $result_auction['auctionStartDate'] ?></h6>
                        <h6><strong>รายละเอียด :</strong> <?php echo $result_auction['auctionDetail'] ?></h6>

                    </div>
                    <div class="col-md-6">
                        <?php
                        $username = $_SESSION['username'];
                        $sql_offer = "SELECT * FROM offer_price AS o
                        INNER JOIN auction_detail AS d
                        ON o.detailID = d.detailID

                        INNER JOIN user AS u 
                        ON u.user_id = d.user_id

                        WHERE o.auctionID=$auctionID AND u.username = '$username' ";

                        $query_offer = mysqli_query($conn, $sql_offer);
                        $result_offer = mysqli_fetch_array($query_offer);

                        ?>

                        <h6>ผลการประมูล : <?php if ($result_offer['auctionStatus'] == 'won') {
                                                echo 'ชนะการประมูล';
                                            } else {
                                                echo 'แพ้การประมูล';
                                            }  ?></h6>
                    </div>

                    <hr>
                    <a href="javascript:history.back();" style="text-align: center;"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>

                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="../js/validation.js"></script>
    <script src="../admin/js/dataTable.js"></script>

</body>

</html>