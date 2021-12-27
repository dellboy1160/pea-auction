<?php
session_start();
date_default_timezone_set("Asia/Bangkok");


$server = "localhost";
$name = "root";
$password = "";
$database = "pea-auction";

$conn = mysqli_connect($server, $name, $password, $database);

if (!$conn->set_charset("utf8")) {

    exit();
} else {
}
