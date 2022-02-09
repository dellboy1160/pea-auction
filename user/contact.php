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
        <div class="mt-5">

            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>ติดต่อเรา</h1>
                    <hr>
                </div>
                <div class="col-md-6 text-left">
                    <h4><i class="fas fa-map-marked-alt"></i> : 2/7 ถนนเพชรเกษม ตำบลหนองแก อำเภอหัวหิน 77110</h4>
                    <h4><i class="fas fa-phone-alt"></i> : 032 512 215</h4>
                    <h4><i class="fas fa-globe"></i> : <a target="_blank" href="http://peas1.pea.co.th/huahin">http://peas1.pea.co.th/huahin</a> </h4>
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v12.0" nonce="o6bPfhsZ"></script>
                    <div class="fb-page" data-href="https://web.facebook.com/peas1huahin" data-tabs="timeline" data-width="" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="https://web.facebook.com/peas1huahin" class="fb-xfbml-parse-ignore"><a href="https://web.facebook.com/peas1huahin">การไฟฟ้าส่วนภูมิภาคอำเภอหัวหิน</a></blockquote>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm mb-5 bg-body rounded">
                        <div class="card-body">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d767.1993851512724!2d99.96190544041167!3d12.551877012027752!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30fdabbc444654c7%3A0x610f90b8721ddfa3!2sProvincial%20Electric%20Authority%20Office!5e0!3m2!1sen!2sth!4v1640588004065!5m2!1sen!2sth" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="user/js/scripts.js"></script>
</body>

</html>