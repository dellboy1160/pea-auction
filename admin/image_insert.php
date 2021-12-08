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
                <h1 class="text-center">เพิ่มรูปภาพ</h1>
            </div>

            <!-- ส่วนแสดงภาพที่อัพโหลดเข้าไป -->
            <div id='preview'>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6 mt-5">
                <form id="imageform" method="post" enctype="multipart/form-data" action='image_upload.php' style="clear:both">
                    <?php

                    ?>
                    <input hidden type="text" name="txt_auctionID" value="<?php echo $encrypt ?>">
                    <div id='imageloadstatus' style='display:none'>
                        <img src="loading.gif" alt="Uploading...." />
                    </div>

                    <div id='imageloadbutton'>
                        <!-- เลือกได้หลายๆไฟล์ในครั้งเดียว   name="photos[]"  multiple="true"  -->

                        <input type="file" class="form-control" name="photos[]" id="photoimg" multiple="true" />
                    </div>

                </form>
            </div>
            <div class="col-md-3"></div>
            <a style="text-align: center;" href="auction.php?act=image&auctionID=<?php echo $encrypt ?>"><i class="fas fa-arrow-left "></i> ย้อนกลับ</a>
        </div>
    </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.wallform.js"></script>

    <script>
        //สร้าง function สำหรับการแสดงตัวอย่างภาพที่อัพโหลด
        $(document).ready(function() {

            $('#photoimg').die('click').live('change', function() {
                //$("#preview").html('');

                $("#imageform").ajaxForm({
                    target: '#preview',
                    beforeSubmit: function() {
                        //เมื่ออัพโหลดภาพไปแล้วจะแสดงไฟล์ .gif loading
                        console.log('ttest');
                        $("#imageloadstatus").show();
                        $("#imageloadbutton").hide();
                    },

                    //อัพโหลดเสร็จแล้วซ่อนไฟล์ .gif loading
                    success: function() {
                        console.log('test');
                        $("#imageloadstatus").hide();
                        $("#imageloadbutton").show();
                    },
                    //error
                    error: function() {
                        console.log('xtest');
                        $("#imageloadstatus").hide();
                        $("#imageloadbutton").show();
                    }
                }).submit();


            });
        });
    </script>
</body>

</html>