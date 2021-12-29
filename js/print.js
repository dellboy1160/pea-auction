function PrintDiv() {
  var divToPrint = document.getElementById("container"); // เลือก div id ที่เราต้องการพิมพ์
  var html =
    "<html>" + //
    "<head>" +
    '<link href="../css/print.css" rel="stylesheet" type="text/css">' +
    "</head>" +
    '<body onload="window.print(); window.close();">' +
    divToPrint.innerHTML +
    "</body>" +
    "</html>";

  var popupWin = window.open();
  popupWin.document.open();
  popupWin.document.write(html); //โหลด print.css ให้ทำงานก่อนสั่งพิมพ์
  popupWin.document.close();
}

function PrintDiv2() {
  var divToPrint = document.getElementById("container2"); // เลือก div id ที่เราต้องการพิมพ์
  var html =
    "<html>" + //
    "<head>" +
    '<link href="../css/print.css" rel="stylesheet" type="text/css">' +
    "</head>" +
    '<body onload="window.print(); window.close();">' +
    divToPrint.innerHTML +
    "</body>" +
    "</html>";

  var popupWin = window.open();
  popupWin.document.open();
  popupWin.document.write(html); //โหลด print.css ให้ทำงานก่อนสั่งพิมพ์
  popupWin.document.close();
}
