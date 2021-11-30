<?php
include('../server.php');
include('../ThaiDateFunction.php');
error_reporting(E_ERROR | E_PARSE);
if (!isset($_SESSION['username'])) {
    header('location: ../index.php');
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql_user = "SELECT * FROM user WHERE username = '$username'";
    $query_user = mysqli_query($conn, $sql_user);
    $result_user = mysqli_fetch_array($query_user);
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
    <?php include('../web-structure/user_navbar.php') ?>
    <!-- Page content-->
    <div class="container">
        <div class=" mt-5">
            <h1 class="text-center mb-5">บัญชีของฉัน</h1>
            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 mb-5">
                        <div class="list-group" style="text-align: left;">

                            <a href="profile.php" class="list-group-item list-group-item-action"><i class="far fa-user"></i> ข้อมูลส่วนตัว</a>
                            <a href="?act=auction_list" class="list-group-item list-group-item-action"><i class="fas fa-history"></i> ประวัติการประมูล</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <?php
                        if (isset($_REQUEST['act'])) {
                            if ($_REQUEST['act'] == 'edit_password') {

                                include('change_password.php');
                            } elseif ($_REQUEST['act'] == 'edit_profile') {

                                include('edit_profile.php');
                            } elseif ($_REQUEST['act'] == 'auction_list') {
                                include('auction_list.php');
                            }
                        } else {
                            include('profile_detail.php');
                        }
                        ?>

                    </div>


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