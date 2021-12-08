<?php
include('../server.php');
include('../encrypt_decrypt_function.php');
include('../ThaiDateFunction.php');

if (isset($_REQUEST['auctionID'])) {
    try {
        $encrypt = $_REQUEST['auctionID'];
        $auctionID = encrypt_decrypt($encrypt, 'decrypt');

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
}

if (isset($_REQUEST['updateID'])) {
    try {
        $encrypt = $_REQUEST['updateID'];
        $updateID = encrypt_decrypt($encrypt, 'decrypt');

        $sql_img = "SELECT * FROM auction_image WHERE imageID = $updateID";
        $query_img = mysqli_query($conn, $sql_img);
        $result_img = mysqli_fetch_array($query_img);
    } catch (Error  $e) {
        $error = "ไม่มีข้อมูลนี้อยู่";
    }
}

if (isset($_REQUEST['btn_submit'])) {

    $image_file = $_FILES['txt_file']['name'];
    $type = $_FILES['txt_file']['type'];
    $size = $_FILES['txt_file']['size'];
    $temp = $_FILES['txt_file']['tmp_name'];
    $path = "auction_image/" . $image_file;
    $directory = "auction_image/";

    $explode = explode('.', $_FILES['txt_file']['name']);
    $new_name = round(microtime(true)) . '.' . end($explode);


    if ($image_file) {
        if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
            if (!file_exists($path)) {
                if ($size < 2000000) {
                    unlink($directory . $result_img['imageFile']);
                    move_uploaded_file($temp, 'auction_image/' . $new_name);
                } else {
                    $errorMsg = "ไฟล์รูปภาพใหญ่เกิน 2MB";
                }
            } else {
                $errorMsg = "ชื่อรูปภาพถูกใช้งานแล้ว";
            }
        } else {
            $errorMsg = "กรุณาใช้นามสกุลไฟล์เป็น JPG, JPEG, PNG & GIF เท่านั้น";
        }
    } else {
        $new_name = $result_img['imageFile'];
    }


    if (!isset($errorMsg)) {
        $imageID = $result_img['imageID'];
        $sql = "UPDATE auction_image SET imageFile = '$new_name' WHERE imageID = $imageID ";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $successMsg = "";
        }
    }
}

?>

<html>

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
</head>

<style>
    #preview {
        color: #cc0000;
        font-size: 12px
    }

    .imgList {
        max-height: 150px;
        margin-left: 5px;
        border: 1px solid #dedede;
        padding: 4px;
        float: left;
    }
</style>



<body>
    <?php if (isset($successMsg)) { ?>
        <script>
            Swal.fire(
                'บันทึกช้อมูลเรียบร้อย',
                '',
                'success',


            ).then(function() {
                window.location = "auction.php?act=image&auctionID=<?php echo $_REQUEST['auctionID'] ?>";
            });
        </script>
    <?php } ?>

    <?php
    if (isset($errorMsg)) {
    ?>
        <script type="text/javascript">
            var errorMsg = '<?php echo $errorMsg; ?>';
            Swal.fire(
                errorMsg,
                '',
                'error'
            )
        </script>
    <?php } ?>
    <?php
    if (isset($error)) {
    ?>
        <script type="text/javascript">
            var error = '<?php echo $error; ?>';
            Swal.fire(
                error,
                '',
                'error'
            ).then(function() {
                window.location = "main_page.php";
            });
        </script>
    <?php exit();
    } ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">แก้ไขรูปภาพ</h1>
            </div>

            <!-- ส่วนแสดงภาพที่อัพโหลดเข้าไป -->
            <!-- <div id='preview'>
            </div> -->
            <div class="col-md-3"></div>
            <div class="col-md-6 mt-5" style="text-align: center;">
                <a target="_blank" href="auction_image/<?php echo $result_img['imageFile'] ?>">ภาพเดิม</a>
                <br>
                <img class="mb-3" src="auction_image/<?php echo $result_img['imageFile'] ?>" width="100px" height="100px" alt="">

                <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <input type="file" name="txt_file" class="form-control">

                    <button type="submit" name="btn_submit" class="btn btn-primary mt-3" style="width: 100%;">บันทึกข้อมูล</button>
                </form>
            </div>
            <div class="col-md-3"></div>
            <a style="text-align: center;" href="auction.php?act=image&auctionID=<?php echo $_REQUEST['auctionID'] ?>"><i class="fas fa-arrow-left "></i> ย้อนกลับ</a>
        </div>
    </div>


</body>

</html>