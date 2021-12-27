<?php
include('../server.php');
include('../encrypt_decrypt_function.php');

if (!isset($_SESSION['adminUsername'])) {
    header('location: ../index.php');
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


    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link href="../css/font.css" rel="stylesheet" />



</head>

<body class="sb-nav-fixed">
    <?php include('../web-structure/admin_topbar.php') ?>
    <div id="layoutSidenav">
        <?php include('../web-structure/admin_sidebar.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <?php
                                $sqlAuction = "SELECT * FROM auction";
                                $queryAuction = mysqli_query($conn, $sqlAuction);
                                $numAuction = mysqli_num_rows($queryAuction);
                                ?>
                                <div class="card-body">รายการประมูลทั้งหมด <?php echo $numAuction ?> รายการ</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="auction.php">ดูรายละเอียด</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <?php
                                $sqlAn = "SELECT * FROM document_announce";
                                $queryAn = mysqli_query($conn, $sqlAn);
                                $numAn = mysqli_num_rows($queryAn);
                                ?>
                                <div class="card-body">เอกสารประกาศขายทั้งหมด <?php echo $numAn ?> รายการ</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="document_announce.php">ดูรายละเอียด</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <?php
                                $sqlOffer = "SELECT * FROM document_offerprice";
                                $queryOffer = mysqli_query($conn, $sqlOffer);
                                $numOffer = mysqli_num_rows($queryOffer);
                                ?>
                                <div class="card-body">เอกสารใบเสนอราคาทั้งหมด <?php echo $numOffer ?> รายการ</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="document_offerPrice.php">ดูรายละเอียด</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <?php
                                $sqlUser = "SELECT * FROM user";
                                $queryUser = mysqli_query($conn, $sqlUser);
                                $numUser = mysqli_num_rows($queryUser);
                                ?>
                                <div class="card-body">สมาชิกทั้งหมด <?php echo $numUser ?> คน</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="user.php">ดูรายละเอียด</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            ตารางรายการประมูลที่กำลังดำเนินการ
                        </div>
                        <div class="card-body">
                            <?php
                            $sql_auction = "SELECT * FROM auction WHERE status = 'active'";
                            $query_auction = mysqli_query($conn, $sql_auction);
                            $num_auction = mysqli_num_rows($query_auction);
                            ?>
                            <table id="example" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>รหัสประมูล</th>
                                        <th>หัวข้อ</th>
                                        <th></th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php while ($result_auction = mysqli_fetch_array($query_auction)) { ?>
                                        <tr>
                                            <td><?php echo $result_auction['auctionID'] ?></td>
                                            <td><?php echo $result_auction['auctionTitle'] ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="auction.php" class="btn btn-warning "><i class="fas fa-search"></i></a>

                                                </div>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

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
</body>

</html>