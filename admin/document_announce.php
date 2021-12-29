<?php
include('../server.php');
include('../encrypt_decrypt_function.php');
if (!isset($_SESSION['adminUsername'])) {
    header('location: ../index.php');
}


if (isset($_REQUEST['delete_id'])) {
    $encrypt = $_REQUEST['delete_id'];
    $delete_id = encrypt_decrypt($encrypt, 'decrypt');
    $sql_doc = "SELECT * FROM document_announce WHERE documentID = $delete_id";
    $query_doc = mysqli_query($conn, $sql_doc);
    $result_doc = mysqli_fetch_array($query_doc);
    unlink("document/" . $result_doc['documentFile']);

    $sql = "DELETE  FROM document_announce WHERE documentID = $delete_id";
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
    <link href="../css/table_responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/font.css">




</head>

<body class="sb-nav-fixed">

    <?php if (isset($successMsg)) { ?>
        <script>
            Swal.fire(
                'ลบข้อมูลเรียบร้อย',
                '',
                'success',


            ).then(function() {
                window.location = "document_announce.php";
            });
        </script>
    <?php } ?>
    <?php include('../web-structure/admin_topbar.php') ?>
    <div id="layoutSidenav">
        <?php include('../web-structure/admin_sidebar.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">จัดการข้อมูลใบประกาศขาย</h1>
                    <?php

                    if (isset($_REQUEST['act'])) {
                        if ($_REQUEST['act'] == 'insert') {

                            include('document_announce_insert.php');
                        } elseif ($_REQUEST['act'] == 'edit') {

                            include('document_announce_edit.php');
                        }
                    } else {
                        include('document_announce_show.php');
                    } ?>



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
    <script src="../js/validation.js"></script>
</body>

</html>