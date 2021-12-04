<?php

function DateThaiStart($startDate)
{
    $strYear = date("Y", strtotime($startDate)) + 543;
    $strMonth = date("n", strtotime($startDate));
    $strDay = date("j", strtotime($startDate));
    $strHour = date("H", strtotime($startDate));
    $strMinute = date("i", strtotime($startDate));
    $strSeconds = date("s", strtotime($startDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";

    // $strDate = "2008-08-14 13:42:44";
    // echo "ThaiCreate.Com Time now : ".DateThai($strDate);
}
function DateThaiEnd($endDate)
{
    $strYear = date("Y", strtotime($endDate)) + 543;
    $strMonth = date("n", strtotime($endDate));
    $strDay = date("j", strtotime($endDate));
    $strHour = date("H", strtotime($endDate));
    $strMinute = date("i", strtotime($endDate));
    $strSeconds = date("s", strtotime($endDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";

    // $strDate = "2008-08-14 13:42:44";
    // echo "ThaiCreate.Com Time now : ".DateThai($strDate);

}
function signDate($signDate)
{
    $strYear = date("Y", strtotime($signDate)) + 543;
    $strMonth = date("n", strtotime($signDate));
    $strDay = date("j", strtotime($signDate));
    $strHour = date("H", strtotime($signDate));
    $strMinute = date("i", strtotime($signDate));
    $strSeconds = date("s", strtotime($signDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";

    // $strDate = "2008-08-14 13:42:44";
    // echo "ThaiCreate.Com Time now : ".DateThai($strDate);
}

function justDate($date)
{
    $strYear = date("Y", strtotime($date)) + 543;
    $strMonth = date("n", strtotime($date));
    $strDay = date("j", strtotime($date));

    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";

    // $strDate = "2008-08-14 13:42:44";
    // echo "ThaiCreate.Com Time now : ".DateThai($strDate);
}
