<?php
include('server.php');

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
    <div class="container mt-5">

        <style>
            img {
                border: 1px solid black;
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>ขั้นตอนการประมูล</h1>
                <hr>
            </div>

            <div class="col-md-2"></div>
            <div class="col-md-8 text-left">
                <h5>1. เลือกเมนู "<strong>หน้าหลัก</strong>"</h5>
                <h5>2. ดาวโหลดเอกสารใบประกาศขาย </h5>
                <img src="web-structure/step1.png" class="mt-2 mb-3" width="75%" alt="">
                <h5>3. เลือกเมนู "<strong>รายการประมูล</strong>"</h5>
                <h5>4. คลิกดูรายละเอียดการประมูล</h5>
                <img src="web-structure/im2.png" class="mt-2 mb-3" width="75%" alt="">

                <h5>5. ระบุข้อมูลตามที่ระบบต้องการ เสร็จแล้วคลิก ลงชื่อ</h5>
                <img src="web-structure/im3.png" class="mt-2 mb-3" width="75%" alt="">

                <h5>6. จากนั้นรอแอดมินตรวจสอบเอกสาร</h5>
                <img src="web-structure/im4.png" class="mt-2 mb-3" width="75%" alt="">
                <h5>7. หลังจากแอดมิดตรวจเอกสารเสร็จแล้ว สถานะจะเปลี่ยนเป็น "<strong>ข้อมูลผ่านการตรวจสอบแล้ว</strong>"</h5>
                <h5>8. จากนั้นให้ดาวโหลดเอกสารเสนอราคา และเสนอราคาตามกำหนดการ</h5>
                <h5>9. จากนั้นเสนอราคา</h5>
                <img src="web-structure/im5.png" class="mt-2 mb-3" width="75%" alt="">

                <h5>10. ระบุข้อมูลตามที่ระบบต้องการ เสร็จแล้วกดปุ่มบันทึก</h5>
                <img src="web-structure/im6.png" class="mt-2 mb-3" width="75%" alt="">

                <h5>11. เสร็จแล้ว ให้รอแอดมิดตรวจสอบเอกสารเสนอราคา โดยสถานะจะเป็น "<strong>รอตรวจสอบใบเสนอราคา</strong>"</h5>
                <img src="web-structure/im7.png" class="mt-2 mb-3" width="75%" alt="">

                <h5>12. หลังจากแอดมินตรวจสอบเอกสารเสร็จแล้ว สถานะจะเปลี่ยนเป็น "<strong>ใบเสนอราคาผ่านการตรวจสอบแล้ว</strong>" และจะแสดงกำหนดการประกาศผู้ชนะ</h5>
                <img src="web-structure/im8.png" class="mt-2 mb-3" width="75%" alt="">
                <h5>13. เมื่อชนะการประมูล จะขึ้นสถานะ "<strong>ชนะการประมูล</strong>" และจะต้องไปขนย้ายสินค้าให้เสร็จสิ้นภายในวันและเวลาที่กำหนด</h5>
                <img src="web-structure/im9.png" class="mt-2 mb-3" width="75%" alt="">

                <h5>14. เมื่อแพ้การประมูล จะขึ้นสถานะ "<strong>แพ้การประมูล</strong>" ให้รอแอดมินโอนเงินมัดจำคืน</h5>
                <img src="web-structure/im10.png" class="mt-2 mb-3" width="75%" alt="">
                <h5>15. หลังจากแอดมินโอนเงินคืน สามารถดูหลักฐานการโอนได้</h5>
                <img src="web-structure/im11.png" class="mt-2 mb-3" width="75%" alt="">
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <section style="height:30vh;"></section>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="user/js/scripts.js"></script>
</body>

</html>