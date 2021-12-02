<?php
session_start();
unset($_SESSION["adminUsername"]);
header('location: index.php');