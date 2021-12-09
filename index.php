<?php
include('server.php');

if (isset($_SESSION['username'])) {
    header('refresh:0;user/main_page.php');
}

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
            <img class="mb-5" src="web-structure/PEA-LOGO.png" alt="">
            <h5><strong>ประกาศ</strong> การไฟฟ้าส่วนภูมิภาคอำเภอหัวหิน</h5>
            <?php
            $sql_doc = "SELECT * FROM document_announce";
            $query_doc = mysqli_query($conn, $sql_doc);
            $num_doc = mysqli_num_rows($query_doc);

            ?>
            <div class="row">
                <?php while ($result_doc = mysqli_fetch_array($query_doc)) { ?>
                    <h5 class="mt-5"> <strong> เรื่อง </strong><?php echo $result_doc['documentTitle'] ?></h5>

                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <a target="_blank" style="width: 100%;" class="btn btn-primary mt-3" href="../admin/document/<?php echo $result_doc['documentFile'] ?>"><i class="far fa-file-pdf" style="color: white;"></i> ดาวโหลดไฟล์</a>
                    </div>
                    <div class="col-md-3"></div>

                <?php } ?>
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?php
                    if ($num_doc == 0) { ?>
                        <div class="alert alert-info" style="font-size:18px" role="alert">
                            <strong>ยังไม่มีการประกาศ</strong>
                        </div>
                    <?php   }  ?>
                </div>
                <div class="col-md-3"></div>

            </div>

        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="user/js/scripts.js"></script>
</body>

</html>