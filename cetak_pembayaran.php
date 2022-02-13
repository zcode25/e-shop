<?php

session_start();
if (!isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';

$no = $_GET["no"];
$kode = $_GET["kode"];
$bisnis = query("SELECT * FROM faktur JOIN bisnis USING(kode_bisnis) WHERE no_faktur = '$no'")[0];
$penjualan = query("SELECT * FROM faktur JOIN karyawan USING(id_karyawan) JOIN pembeli USING(id_pembeli) WHERE no_faktur = '$no' ")[0];
$pembayaran = query("SELECT * FROM pembayaran WHERE kode_pembayaran = '$kode' ")[0];
$transaksis = query("SELECT * FROM transaksi JOIN barang USING(kode_barang) JOIN kategori USING(kode_kategori) WHERE no_faktur = '$no' ");


$mpdf = new \Mpdf\Mpdf();
$html = '

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pembayaran</title>
	<style>

		body {
			font-family : arial;
			font-size : 12px;
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
			<td align="right"><p><b>Tanggal : ' . $penjualan["tgl_pemesanan"] . '</b></p></td>
		</tr>
	</table>
	<br>
	<table cellpadding="7" cellspacing="0" width="100%">
		<tr>
			<td>
				<p>Dari
				<br><strong>' . $penjualan["nama_karyawan"] . '</strong><br>' . $bisnis["alamat_bisnis"] . ' <br>Telp : ' . $bisnis["telp_bisnis"] . '<br>Email : ' . $bisnis["email_bisnis"] . '
                </p>
			</td>
			<td>
				<p>Kepada
                  <br><strong>' . $penjualan["nama_pembeli"] . '</strong><br>' . $penjualan["alamat_pembeli"] . '<br>Telp : ' . $penjualan["telp_pembeli"] . '<br>Email : ' . $penjualan["email_pembeli"] . '</br>
				</p>
			</td>
			<td>
				<p>
					<b>No Faktur : ' . $penjualan["no_faktur"] . '</b><br><b>Tanggal Jatoh Tempo : </b><br>' . $penjualan["tgl_jatohtempo"] . '
				</p>
			</td>
		</tr>
	</table>
	<br>
	<table cellpadding="7" cellspacing="0" width="100%">
    <thead>
      <tr>
        
        <th style="text-align: left">Nama Barang</th>
        <th style="text-align: left">Kategori</th>
        <th style="text-align: left">Kuantitas</th>
        <th style="text-align: left">Harga Satuan</th>
        <th style="text-align: left">Jumlah</th>
      </tr>
    </thead>
    <tbody>
    ';


foreach ($transaksis as $transaksi) {
	$html .= '
      <tr>
        
        <td>' . $transaksi["nama_barang"] . '</td>
        <td>' . $transaksi["nama_kategori"] . '</td>
        <td>' . $transaksi["kuantitas"] . '</td>
        <td>Rp ' . $transaksi["harga_jual"] . '</td>
        <td>Rp ' . $transaksi["kuantitas"] * $transaksi["harga_jual"] . '</td>
      </tr>';
};

$html .= '
      <tr class="hijau left">
        <th colspan="4">TOTAL</th>
        ';

$total[] = 0;
foreach ($transaksis as $transaksi) {
	$total[] = $transaksi["kuantitas"] * $transaksi["harga_jual"];
};


$html .= '
    	<th style="text-align: left">Rp ' . array_sum($total) . '</th>
 
      </tr>
    </tbody>
  </table>


  <br><br>
  <hr>
  <table cellpadding="7" cellspacing="0" width="100%">
		<tr>
			<td><h2>Pembayaran</h2></td>
			<td align="right"><p><b>Tanggal : ' . $pembayaran["tgl_pembayaran"] . '</b></p></td>
		</tr>
	</table>
	<br>
  <table cellpadding="7" cellspacing="0" width="100%">
		<tr>
			<td>
				<strong>Kode Pembayaran : ' . $pembayaran["kode_pembayaran"] . '</strong><br><strong>No Faktur : ' . $pembayaran["no_faktur"] . '</strong><br>Karyawan : ' . $penjualan["nama_karyawan"] . '<br>Pembeli : ' . $penjualan["nama_pembeli"] . '
			</td>
			
		</tr>
	</table>
	<br>
	<table cellpadding="7" cellspacing="0" width="100%">
		<tr class="hijau">
			<th style="text-align: left">Total Pembayaran</th>
			<th style="text-align: left">Status</th>
		</tr>
		<tr>
			<td>Rp ' . $pembayaran["total_pembayaran"] . '</td>
			<td>' . $pembayaran["status"] . '</td>
			
		</tr>
	</table>

	<br><br>
  <table cellpadding="7" cellspacing="0" width="100%">
		<tr>
			<td>
				<p>
                  <strong>Pembeli</strong><br><br><br><br><br>' . $penjualan["nama_pembeli"] . '
                </p>
			</td>
			<td>
				<p>
                  <strong>Karyawan</strong><br><br><br><br><br>' . $penjualan["nama_karyawan"] . '
				</p>
			</td>
		</tr>
	</table>


';


$mpdf->WriteHTML($html);
$mpdf->Output('Pembayaran_' . $pembayaran["kode_pembayaran"] . '.pdf', 'I');
