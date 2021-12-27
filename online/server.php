<?php
session_start();
date_default_timezone_set("Asia/Bangkok");


$server = "localhost";
$name = "cp640956_bidmcv";
$password = "bidmcvDatabase@64";
$database = "cp640956_pea-auction";

$conn = mysqli_connect($server, $name, $password, $database);
if (!$conn->set_charset("utf8")) {

    exit();
} else {
}
