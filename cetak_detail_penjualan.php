<?php

session_start();
if (!isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$kode = $_SESSION["bisnis"];
$dari = $_POST["dari"];
$sampai = $_POST["sampai"];

$penjualans = query("SELECT kode_pembayaran, no_faktur, tgl_pembayaran, nama_pembeli, nama_karyawan, status, total_pembayaran
FROM faktur 
JOIN pembeli USING (id_pembeli)
JOIN karyawan USING (id_karyawan)
JOIN pembayaran USING (no_faktur)
WHERE (tgl_pembayaran BETWEEN '$dari' AND '$sampai') AND faktur.kode_bisnis = '$kode'
ORDER BY (no_faktur) ");

$pembayaran =  query("SELECT SUM(total_pembayaran) AS total FROM pembayaran JOIN faktur USING (no_faktur) WHERE tgl_pemesanan BETWEEN '$dari' AND '$sampai'")[0];



$mpdf = new \Mpdf\Mpdf();
$html = '

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan Penjualan</title>
	<style>

		body {
			font-family : arial;
			font-size : 12px;
		}

		.biru {
			background-color: #BEE5EB;
		}

		.merah {
			background-color: pink;
		}

		.hitam {
			color : white;
			background-color: black;
		}

		.h {
			font-size : 18px;
		}

    .hijau th {
			background-color: #009486;
			color: white;
		}

	</style>
</head>
<body>
	<table cellpadding="7" cellspacing="0" width="100%">
		<tr>
			<td><h1>' . $_SESSION["nama_bisnis"] . '</h1></td>
			<td align="right"><p><b>Tanggal : ' . $dari . ' - ' . $sampai . '</b></p></td>
		</tr>
	</table>
	<br>
	<table cellpadding="7" cellspacing="0" width="100%">
		<tr>
			<td class="h">Laporan Penjualan</td>
		</tr>
	</table>
  <br>
	<table cellpadding="7" cellspacing="0" width="100%">
    <thead>
      <tr>
      <th class="hitam">Status</th>
        <th style="text-align: left">Kode Pembayaran</th>
        <th style="text-align: left">No Faktur</th>
        <th style="text-align: left">Tanggal Pembayaran</th>
        <th style="text-align: left">Nama Pembeli</th>
        <th style="text-align: left">Nama Karyawan</th>
        <th style="text-align: left">Total Pembayaran</th>
      </tr>
    </thead>
    <tbody>';

foreach ($penjualans as $penjualan) {
	$html .= '
      <tr>';
	if ($penjualan["status"] == 'Lunas') {
		$html .= '<td class="biru">' . $penjualan["status"] . '</td>';
	} elseif ($penjualan["status"] == 'Belum Lunas') {
		$html .= ' <td class="merah">' . $penjualan["status"] . '</td>';
	}
	$html .= '
        <td>' . $penjualan["kode_pembayaran"] . '</td>
        <td>' . $penjualan["no_faktur"] . '</td>
        <td>' . $penjualan["tgl_pembayaran"] . '</td>
        <td>' . $penjualan["nama_pembeli"] . '</td>
        <td>' . $penjualan["nama_karyawan"] . '</td>
        <td>Rp ' . $penjualan["total_pembayaran"] . '</td>
      </tr>';
};

$html .= '
      <tr class="hijau left">
        <th colspan="6">TOTAL</th>
        ';



$html .= '
    	<th style="text-align: left">Rp ' . $pembayaran["total"] . '</th>
 
      </tr>
    </tbody>
  </table>


</body>
</html>
';


$mpdf->WriteHTML($html);
$mpdf->Output('Laporan_penjualan' . $dari . ' - ' . $sampai . '.pdf', 'I');
