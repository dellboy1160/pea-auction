<?php
include('../server.php');

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
            <h1>ประกาศ</h1>
            <hr>
            <?php
            $sql_doc = "SELECT * FROM document_announce";
            $query_doc = mysqli_query($conn, $sql_doc);
            $num_doc = mysqli_num_rows($query_doc);

            ?>
            <?php while ($result_doc = mysqli_fetch_array($query_doc)) { ?>
                <h5 class="mt-5"> <strong> เรื่อง : </strong><?php echo $result_doc['documentTitle'] ?></h5>
                <a target="_blank" class="btn btn-primary" href="../admin/document/<?php echo $result_doc['documentFile'] ?>"><i class="far fa-file-pdf" style="color: white;"></i> ดาวโหลดไฟล์</a>
                <hr>

            <?php } ?>

            <?php
            if ($num_doc == 0) { ?>
                <div class="alert alert-info" style="font-size:18px" role="alert">
                    <strong>ยังไม่มีการประกาศ</strong>
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