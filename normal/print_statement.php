<?php
header('Content-type: application/json; charset=UTF-8');
include('dbcon.php');
include('session.php');

require_once 'vendors/ar-php/src/Arabic.php';
require_once 'vendors/dompdf/autoload.inc.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;

if (!empty($_GET['id'])) {
    $stmt_id = $_GET['id'];
    //STATEMENT INFO:
    $query = mysqli_query($conn, "select * from statements where stmt_id=$stmt_id") or die('Error, query failed');
    $row = mysqli_fetch_array($query);
    $orders_id = $row['orders_id'];


    $invoiceDate = $row['stmt_date'];

    // (B) CREATE QR CODE
 /*   $path = 'statements/';
    $file = $path . $id . ".png";

    // $ecc stores error correction capability('L')
    $ecc = 'L';
    $pixel_Size = 300;
    $frame_Size = 300;


    if (!file_exists($path . $file)) {

        // Generates QR Code and Stores it in directory given
        QRcode::png($stmt_id, $file, $ecc, $pixel_Size, $frame_size);
    }
    //QR Code

    $type = pathinfo($file, PATHINFO_EXTENSION);
    $data = file_get_contents($file);
    $qr = 'data:image/' . $type . ';base64,' . base64_encode($data);
*/
    //Logo:
    $file2 = "../images/logoT.png";
    $type2 = pathinfo($file2, PATHINFO_EXTENSION);
    $data2 = file_get_contents($file2);
    $logo = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);

    $output = '';
    $output .= '
    <style type="text/css">
body
{
background-image:url("'.$logo.'");
background-repeat: no-repeat;
opacity:0.2;
background-position: center center;
font-family: DejaVu Sans;
font-size:14px;
}
</style>
<body>
<center><h1 style="opacity:1">HexaPi Delivery</h1></center>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
<td colspan="2" align="center" style="font-size:18px"><b>Statement No. : ' . $row['stmt_id'] . '</b><br/>
Statement Date : ' . $invoiceDate . '</td>
</tr>
<tr>
<td colspan="2">
<table width="100%" cellpadding="5">
<tr>
<td>
<b>RECEIVER</b><br />
Name : ' . $row['seller_name'] . '</td>
<td>
<b>ISSUER</b><br />
Sender : ' . $row['issued_by'] . '

</tr>
</table>
<br />
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
<th align="left">Order ID</th>
<th align="left">Customer</th>
<th align="left">Address</th>
<th align="left">Price L.L</th>
<th align="left">Delivery Date</th>
<th align="left">Status</th>
</tr>';

$total_L=0;
$total_D=0;

$array = explode(",", $orders_id);
$in = '(' . implode(',', $array) .')';
$orders_count=count($array);
$query2 = mysqli_query($conn, "select * from orders where order_id in $in")
       or die('Error, query2 failed');
    while ($row2 = mysqli_fetch_array($query2)) {
        $isLira=$row2["pricing_lira"];
        if($isLira){
        $total_L+=$row2["uncharged_price"];
        }
        else{
        $total_D+=$row2["uncharged_price$"];
        }
        $route=$row2["route"];
            $q3 = mysqli_query($conn,"select * from charge where governorate_id=$route")or die('Error');
    $row3= mysqli_fetch_array($q3);
	$gov=$row3['governorate'];
        $output .= '
<tr>
<td align="left">' . $row2["order_id"] . '</td>
<td align="left">' . $row2["receiver_name"] . '</td>
<td align="left">' . $gov . '</td>
<td align="left">';
if($isLira){
$output.=$row2["uncharged_price"].' L.L';
}
else {
    $output.=$row2["uncharged_price$"].' $';
}
$output.=' </td>
<td align="left">' . $row2["createdAt"] . '</td>
<td align="left">' . $row2["status"] . '</td>
</tr>';
    }
    
    $output .= '
    
</table>
</td>
</tr>



</tr>;
</table>
<br>

<table width="100%" border="1" cellpadding="2" cellspacing="0">
<tr>
<td colspan="2" align="center" style="font-size:18px"><b> Number of Orders</b>
' . $orders_count. '</td>
</tr>
<tr>
<td colspan="2">
<table width="100%" cellpadding="5">
<tr>
<td>    
<b>TOTAL AMOUNT PAYED in L.L: </b></td>
<td>' . $total_L . ' L.L</td>
<td>    
<b>TOTAL AMOUNT PAYED in $$: </b></td>
<td>' . $total_D . ' $ </td>
</tr>
</table>
<br /></body>
';
}
// create pdf of invoice
$invoiceFileName = 'Statement-022' . $row['stmt_id'] . '.pdf';

$html = html_entity_decode($output);
$Arabic = new ArPHP\I18N\Arabic();

$p = $Arabic->arIdentify($html);

for ($i = count($p)-1; $i >= 0; $i-=2) {
    $utf8ar = $Arabic->utf8Glyphs(substr($html, $p[$i-1], $p[$i] - $p[$i-1]));
    $html   = substr_replace($html, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
}

$dompdf = new Dompdf();
$dompdf->loadHtml($html,'UTF-8');
$dompdf->setPaper('A5', 'landscape');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
