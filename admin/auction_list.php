<?php
include('../server.php');
include('../ThaiDateFunction.php');
include('../encrypt_decrypt_function.php');

if (!isset($_SESSION['adminUsername'])) {
    header('location: ../index.php');
}



if (isset($_REQUEST['delete_id'])) {
    $delete_id = $_REQUEST['delete_id'];

    $sql = "DELETE  FROM auction WHERE auctionID  = $delete_id ";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $successMsg = "";
    }
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
    <link href="../css/font.css" rel="stylesheet" />



</head>

<body class="sb-nav-fixed">
    <?php include('../web-structure/admin_topbar.php') ?>
    <div id="layoutSidenav">
        <?php include('../web-structure/admin_sidebar.php') ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">รายการประมูล</h1>
                    <?php
                    $sql_auction = "SELECT * FROM auction WHERE status = 'unActive'";
                    $query_auction = mysqli_query($conn, $sql_auction);
                    $num_auction = mysqli_num_rows($query_auction);
                    ?>
                    <div class="card mb-4 mt-5">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            ตารางรายการประมูล




                        </div>
                        <div class="card-body ">
                            <style>
                                .table_legenda {
                                    table-layout: fixed;
                                }

                                .table_legenda th {
                                    overflow-wrap: break-word;
                                }
                            </style>
                            <table id="example" class="table table-bordered table_legenda">

                                <thead>
                                    <tr>
                                        <th width="10%">รหัสประมูล</th>
                                        <th width="40%">หัวข้อ</th>

                                        <th>กำหนดลบอัตโนมัติ</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php while ($result_auction = mysqli_fetch_array($query_auction)) { ?>
                                        <tr>
                                            <td data-label="รหัสประมูล"><?php echo $result_auction['auctionID'] ?></td>
                                            <td data-label="หัวข้อ">
                                                หัวข้อ : <?php echo $result_auction['auctionTitle'] ?>

                                            </td>
                                            <td>
                                                <?php echo justDate($result_auction['dateUnactive'] . ' + 30 days')   ?>

                                                <?php
                                                // echo '<br>', $today = date("Y-m-d H:i:s");

                                                $today = date("Y-m-d H:i:s");
                                                $deleteDate =  date('Y-m-d H:i:s',  strtotime($result_auction['dateUnactive'] . '+30 days'));
                                                if ($today == $deleteDate) {
                                                    $auctionID = $result_auction['auctionID'];

                                                    $sql = "DELETE FROM auction WHERE auctionID = $auctionID";
                                                    $query = mysqli_query($conn, $sql);
                                                    if ($query) {
                                                        $sqlD = "DELETE FROM auction_detail WHERE auctionID = $auctionID";
                                                        $queryD = mysqli_query($conn, $sqlD);

                                                        $sqlO = "DELETE FROM offer_price WHERE auctionID =$auctionID";
                                                        $queryO = mysqli_query($conn, $sqlO);

                                                        $sqlI = "DELETE FROM auction_image WHERE auctionID = $auctionID";
                                                        $queryI = mysqli_query($conn, $sqlI);
                                                    }
                                                }

                                                ?>
                                            </td>
                                            <td data-label="รายละเอียด" style="text-align: center;">
                                                <a href="auctionListDetail.php?auctionID=<?php echo $result_auction['auctionID'] ?>" class="btn btn-warning"><i class="fas fa-search"></i></a>
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
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="js/dataTable.js"></script>
    <script src="../js/validation.js"></script>
</body>

</html>