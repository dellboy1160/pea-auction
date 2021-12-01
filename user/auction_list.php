<?php
$username = $_SESSION['username'];
$sql_user = "SELECT * FROM user WHERE username='$username'";
$query_user = mysqli_query($conn, $sql_user);
$result_user = mysqli_fetch_array($query_user);


$user_id =  $result_user['user_id'];


$sql_list = "SELECT * FROM auction_detail AS d
INNER JOIN user AS u
ON d.user_id = u.user_id

INNER JOIN auction AS a
ON d.auctionID = a.auctionID

WHERE d.user_id = $user_id
";

$query_list = mysqli_query($conn, $sql_list)
?>
<style>
    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

    table caption {
        font-size: 1.5em;
        margin: 0.5em 0 0.75em;
    }

    table tr {
        background-color: #ffffff;
        border: 1px solid #ddd;
        padding: 0.35em;
    }

    table th,
    table td {
        padding: 0.625em;
        /* text-align: center; */
    }

    table th {
        font-size: 0.85em;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        table caption {
            font-size: 1.3em;
        }

        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        table tr {
            border-bottom: 3px solid #ddd;

            display: block;
            margin-bottom: 0.625em;
        }

        table td {
            border-bottom: 1px solid #ddd;

            display: block;
            font-size: 0.8em;
            text-align: right;
        }

        table td::before {
            /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td:last-child {
            border-bottom: 0;
        }
    }
</style>
<table id="example" class="table table-bordered">
    <thead>
        <tr>
            <th>รหัสประมูล</th>
            <th width="15%">หัวข้อ</th>

            <th width="15%">ลงชื่อวันที่</th>
            <th></th>
            <th style="width: 35%;">สถานะ</th>
        </tr>
    </thead>
    <?php while ($result_list = mysqli_fetch_array($query_list)) { ?>
        <tbody>
            <tr>
                <td data-label="รหัสประมูล"><?php echo $result_list['auctionID'] ?></td>
                <td data-label="หัวข้อ"><?php echo $result_list['auctionTitle'] ?></td>
                <td data-label="วัน/เวลา ที่ลงชื่อ">

                    <?php

                    $signDate = $result_list['signDate'];
                    echo signDate($signDate);

                    ?>

                </td>
                <td style="text-align: center;">
                    <a href="?detailID" class="btn btn-primary btn-sm" style="width: 100%;">รายละเอียด</a>
                </td>
                <td data-label="สถานะ">
                    <?php
                    if ($result_list['auctionDetailStatus'] == 'unCheck') { ?>
                        <p class="text-danger"> <strong>รอตรวจสอบ</strong> </p>
                    <?php } elseif ($result_list['auctionDetailStatus'] == 'checkFail') { ?>

                        ข้อมูลไม่ถูกต้อง <br><a href="auction_resend.php?detailID=<?php echo $result_list['detailID'] ?>">ยื่นเอกสารอีกครั้ง</a>
                    <?php } else { ?>

                        <?php
                        $detailID = $result_list['detailID'];
                        $sql = "SELECT * FROM offer_price WHERE detailID = $detailID";
                        $query = mysqli_query($conn, $sql);
                        $result = mysqli_fetch_array($query);

                        ?>
                        <?php if ($result['paymentStatus'] == 'unCheck') { ?>
                            รอตรวจสอบใบเสนอราคา
                        <?php } elseif ($result['paymentStatus'] == 'checkFail') { ?>
                            ข้อมูลเสนอราคาไม่ถูกต้อง <br><a href="auction_resendOffer.php?offerID=<?php echo $result['offerID'] ?>">ยื่นเอกสารอีกครั้ง</a>
                        <?php } elseif ($result['paymentStatus'] == 'check') { ?>
                            ตรวจสอบใบเสนอราคาแล้ว
                        <?php } else { ?>
                            <p class="text-success"> <strong>ตรวจสอบแล้ว</strong> </p>

                            <?php
                            $sql_doc = "SELECT * FROM document_offerprice";
                            $query_doc = mysqli_query($conn, $sql_doc);

                            ?>
                            <?php while ($result_doc = mysqli_fetch_array($query_doc)) {
                                $startDate = $result_doc['startDate'];
                                $endDate = $result_doc['endDate'];
                                $today = date("Y-m-d H:i:s");
                            ?>

                                กำหนดเสนอราคาวันที่ <br> <?php echo signDate($startDate)  ?> -
                                <?php echo signDate($endDate) ?>

                                <br>
                                <?php if ($today < $startDate) { ?>
                                    <button disabled class="btn btn-secondary btn-sm mt-2" style="width: 100%;">ยังไม่ถึงเวลาเสนอราคา</button>
                                <?php } elseif ($today > $startDate && $today < $endDate) { ?>
                                    <a href="offer_price.php?auctionID=<?php echo $result_list['auctionID'] ?>&detailID=<?php echo $result_list['detailID'] ?>" style="width: 100%;" class="btn btn-primary btn-sm mt-2">เสนอราคา</a>
                                <?php } elseif ($today > $endDate) { ?>
                                    <button disabled class="btn btn-secondary btn-sm mt-2" style="width: 100%;">หมดเวลาเสนอราคา</button>
                                <?php } ?>
                            <?php } ?>

                        <?php } ?>
                    <?php } ?>
                </td>
            </tr>

        </tbody>
    <?php } ?>
</table>