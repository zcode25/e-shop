<?php

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'e-shop2');
// mengambil data
function query($query)
{

	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah_bisnis($data)
{
	global $conn;

	$kode_bisnis = htmlspecialchars($data["kode_bisnis"]);
	$nama_bisnis = htmlspecialchars($data["nama_bisnis"]);
	$alamat_bisnis = htmlspecialchars($data["alamat_bisnis"]);
	$email_bisnis = htmlspecialchars($data["email_bisnis"]);
	$telp_bisnis = htmlspecialchars($data["telp_bisnis"]);

	$query = "INSERT INTO bisnis VALUES ('$kode_bisnis', '$nama_bisnis', '$alamat_bisnis', '$email_bisnis', '$telp_bisnis')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubah_bisnis($data)
{

	global $conn;

	// ambil data dari form
	$kode_bisnis = htmlspecialchars($data["kode_bisnis"]);
	$nama_bisnis = htmlspecialchars($data["nama_bisnis"]);
	$alamat_bisnis = htmlspecialchars($data["alamat_bisnis"]);
	$email_bisnis = htmlspecialchars($data["email_bisnis"]);
	$telp_bisnis = htmlspecialchars($data["telp_bisnis"]);


	$query = "UPDATE bisnis SET 
				nama_bisnis = '$nama_bisnis',
				alamat_bisnis = '$alamat_bisnis',
				email_bisnis = '$email_bisnis',
				telp_bisnis = '$telp_bisnis'

				WHERE kode_bisnis = '$kode_bisnis'

			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambah_supplier($data)
{

	global $conn;

	// ambil data dari form
	$kode_supplier = htmlspecialchars($data["kode_supplier"]);
	$nama_supplier = htmlspecialchars($data["nama_supplier"]);
	$alamat_supplier = htmlspecialchars($data["alamat_supplier"]);
	$email_supplier = htmlspecialchars($data["email_supplier"]);
	$telp_supplier = htmlspecialchars($data["telp_supplier"]);
	$kode_bisnis = htmlspecialchars($data["kode_bisnis"]);

	// query insert
	$query = "INSERT INTO supplier VALUES ('$kode_supplier', '$nama_supplier', '$alamat_supplier', '$email_supplier', '$telp_supplier', '$kode_bisnis') ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus_supplier($kode)
{

	global $conn;
	mysqli_query($conn, "DELETE FROM supplier WHERE kode_supplier = '$kode'");
	return mysqli_affected_rows($conn);
}

function ubah_supplier($data)
{

	global $conn;

	// ambil data dari form
	$kode_supplier = htmlspecialchars($data["kode_supplier"]);
	$nama_supplier = htmlspecialchars($data["nama_supplier"]);
	$alamat_supplier = htmlspecialchars($data["alamat_supplier"]);
	$email_supplier = htmlspecialchars($data["email_supplier"]);
	$telp_supplier = htmlspecialchars($data["telp_supplier"]);


	$query = "UPDATE supplier SET 
				nama_supplier = '$nama_supplier',
				alamat_supplier = '$alamat_supplier',
				email_supplier = '$email_supplier',
				telp_supplier = '$telp_supplier'

				WHERE kode_supplier = '$kode_supplier'

			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari_supplier($keyword, $kode)
{

	$query = "SELECT * FROM supplier
				WHERE

				(nama_supplier LIKE '%$keyword%' OR
				alamat_supplier LIKE '%$keyword%' OR 
				email_supplier LIKE '%$keyword%' OR 
				telp_supplier LIKE '%$keyword%') AND
				kode_bisnis = '$kode'

				";

	return query($query);
}

function tambah_kategori($data)
{

	global $conn;

	// ambil data dari form
	$kode_kategori = htmlspecialchars($data["kode_kategori"]);
	$nama_kategori = htmlspecialchars($data["nama_kategori"]);
	$kode_bisnis = htmlspecialchars($data["kode_bisnis"]);

	// query insert
	$query = "INSERT INTO kategori VALUES ('$kode_kategori', '$nama_kategori', '$kode_bisnis') ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubah_kategori($data)
{

	global $conn;

	// ambil data dari form
	$kode_kategori = htmlspecialchars($data["kode_kategori"]);
	$nama_kategori = htmlspecialchars($data["nama_kategori"]);
	// $kode_bisnis = htmlspecialchars($data["kode_bisnis"]);


	$query = "UPDATE kategori SET 
				nama_kategori = '$nama_kategori'

				WHERE kode_kategori = '$kode_kategori'

			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus_kategori($kode)
{

	global $conn;
	mysqli_query($conn, "DELETE FROM kategori WHERE kode_kategori = '$kode'");
	return mysqli_affected_rows($conn);
}

function cari_kategori($keyword, $kode)
{

	$query = "SELECT * FROM kategori
				WHERE

				(nama_kategori LIKE '%$keyword%') AND
				kode_bisnis = '$kode'

				";

	return query($query);
}

function tambah_barang($data)
{

	global $conn;

	// ambil data dari form
	$kode_barang = htmlspecialchars($data["kode_barang"]);
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$harga_beli = htmlspecialchars($data["harga_beli"]);
	$harga_jual = htmlspecialchars($data["harga_jual"]);
	$stok = htmlspecialchars($data["stok"]);
	$supplier = htmlspecialchars($data["supplier"]);
	$kode_bisnis = htmlspecialchars($data["kode_bisnis"]);

	// var_dump($kategori);
	// exit();

	// query insert
	$query = "INSERT INTO barang VALUES ('$kode_barang', '$nama_barang', '$kategori', '$harga_beli', '$harga_jual', '$stok', '$supplier', '$kode_bisnis') ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function ubah_barang($data)
{

	global $conn;

	// ambil data dari form
	$kode_barang = htmlspecialchars($data["kode_barang"]);
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$harga_beli = htmlspecialchars($data["harga_beli"]);
	$harga_jual = htmlspecialchars($data["harga_jual"]);
	$stok = htmlspecialchars($data["stok"]);
	$supplier = htmlspecialchars($data["supplier"]);


	$query = "UPDATE barang SET 
				nama_barang = '$nama_barang',
				kode_kategori = '$kategori',
				harga_beli = '$harga_beli',
				harga_jual = '$harga_jual',
				stok = '$stok',
				kode_supplier = '$supplier'

				WHERE kode_barang = '$kode_barang'

			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function hapus_barang($kode)
{

	global $conn;
	mysqli_query($conn, "DELETE FROM barang WHERE kode_barang = '$kode'");
	return mysqli_affected_rows($conn);
}

function cari_barang($keyword, $kode)
{

	$query = "SELECT * FROM barang JOIN supplier USING(kode_supplier) JOIN kategori USING(kode_kategori)
				WHERE

				(kode_barang LIKE '%$keyword%' OR 
				nama_barang LIKE '%$keyword%' OR 
				nama_kategori LIKE '%$keyword%' OR 
				harga_beli LIKE '%$keyword%' OR 
				harga_jual LIKE '%$keyword%' OR 
				stok LIKE '%$keyword%' OR 
				nama_supplier LIKE '%$keyword%') AND
				barang.kode_bisnis = '$kode'

				";

	return query($query);
}


function tambah_pembeli($data)
{

	global $conn;

	// ambil data dari form
	$id_pembeli = htmlspecialchars($data["id_pembeli"]);
	$nama_pembeli = htmlspecialchars($data["nama_pembeli"]);
	$alamat_pembeli = htmlspecialchars($data["alamat_pembeli"]);
	$email_pembeli = htmlspecialchars($data["email_pembeli"]);
	$telp_pembeli = htmlspecialchars($data["telp_pembeli"]);
	$kode_bisnis = htmlspecialchars($data["kode_bisnis"]);

	// query insert
	$query = "INSERT INTO pembeli VALUES ('$id_pembeli', '$nama_pembeli', '$alamat_pembeli', '$email_pembeli', '$telp_pembeli', '$kode_bisnis') ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambah_karyawan($data)
{

	global $conn;

	// ambil data dari form
	$id_karyawan = htmlspecialchars($data["id_karyawan"]);
	$nama_karyawan = htmlspecialchars($data["nama_karyawan"]);
	$alamat_karyawan = htmlspecialchars($data["alamat_karyawan"]);
	$email_karyawan = htmlspecialchars($data["email_karyawan"]);
	$telp_karyawan = htmlspecialchars($data["telp_karyawan"]);
	$password = sha1($data["password"]);
	$kode_bisnis = htmlspecialchars($data["kode_bisnis"]);

	// query insert
	$query = "INSERT INTO karyawan VALUES ('$id_karyawan', '$nama_karyawan', '$alamat_karyawan', '$email_karyawan', '$telp_karyawan', '$password', '$kode_bisnis') ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function ubah_karyawan($data)
{

	global $conn;

	// ambil data dari form
	$id_karyawan = htmlspecialchars($data["id_karyawan"]);
	$nama_karyawan = htmlspecialchars($data["nama_karyawan"]);
	$alamat_karyawan = htmlspecialchars($data["alamat_karyawan"]);
	$email_karyawan = htmlspecialchars($data["email_karyawan"]);
	$telp_karyawan = htmlspecialchars($data["telp_karyawan"]);

	$query = "UPDATE karyawan SET 
				nama_karyawan = '$nama_karyawan',
				alamat_karyawan = '$alamat_karyawan',
				email_karyawan = '$email_karyawan',
				telp_karyawan = '$telp_karyawan'

				WHERE id_karyawan = '$id_karyawan'

			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubah_pass_karyawan($data)
{

	global $conn;

	// ambil data dari form
	$id_karyawan = htmlspecialchars($data["id_karyawan"]);
	$password = sha1($data["password"]);

	$query = "UPDATE karyawan SET 
				password = '$password'

				WHERE id_karyawan = '$id_karyawan'

			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function hapus_karyawan($id)
{

	global $conn;
	mysqli_query($conn, "DELETE FROM karyawan WHERE id_karyawan = '$id'");
	return mysqli_affected_rows($conn);
}

function hapus_pembeli($id)
{

	global $conn;
	mysqli_query($conn, "DELETE FROM pembeli WHERE id_pembeli = '$id'");
	return mysqli_affected_rows($conn);
}

function ubah_pembeli($data)
{

	global $conn;

	// ambil data dari form
	$id_pembeli = htmlspecialchars($data["id_pembeli"]);
	$nama_pembeli = htmlspecialchars($data["nama_pembeli"]);
	$alamat_pembeli = htmlspecialchars($data["alamat_pembeli"]);
	$email_pembeli = htmlspecialchars($data["email_pembeli"]);
	$telp_pembeli = htmlspecialchars($data["telp_pembeli"]);


	$query = "UPDATE pembeli SET 
				nama_pembeli = '$nama_pembeli',
				alamat_pembeli = '$alamat_pembeli',
				email_pembeli = '$email_pembeli',
				telp_pembeli = '$telp_pembeli'

				WHERE id_pembeli = '$id_pembeli'

			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function cari_pembeli($keyword, $kode)
{

	$query = "SELECT * FROM pembeli
				WHERE

				-- id_pembeli LIKE '%$keyword%' OR 
				(nama_pembeli LIKE '%$keyword%' OR 
				alamat_pembeli LIKE '%$keyword%' OR 
				email_pembeli LIKE '%$keyword%' OR 
				telp_pembeli LIKE '%$keyword%') AND
				kode_bisnis = '$kode'

				";

	return query($query);
}

function cari_karyawan($keyword, $kode)
{

	$query = "SELECT * FROM karyawan
				WHERE

				-- id_karyawan LIKE '%$keyword%' OR 
				(nama_karyawan LIKE '%$keyword%' OR 
				alamat_karyawan LIKE '%$keyword%' OR 
				email_karyawan LIKE '%$keyword%' OR 
				telp_karyawan LIKE '%$keyword%') AND
				kode_bisnis = '$kode'

				";

	return query($query);
}

function cari_penjualan($keyword, $kode)
{

	$query = "SELECT * FROM faktur JOIN pembeli USING (id_pembeli) JOIN karyawan USING (id_karyawan) 
				WHERE

				(no_faktur LIKE '%$keyword%' OR 
				tgl_pemesanan LIKE '%$keyword%' OR  
				tgl_jatohtempo LIKE '%$keyword%' OR 
				nama_pembeli LIKE '%$keyword%' OR
				nama_karyawan LIKE '%$keyword%') AND
				faktur.kode_bisnis = '$kode'


				";

	return query($query);
}


function cari_pembayaran($keyword, $kode)
{

	$query = "SELECT * FROM pembayaran JOIN faktur USING (no_faktur ) JOIN pembeli USING (id_pembeli) JOIN karyawan USING (id_karyawan) 
				WHERE

				(status LIKE '%$keyword%' OR 
				kode_pembayaran LIKE '%$keyword%' OR
				tgl_pembayaran LIKE '%$keyword%' OR 
				no_faktur LIKE '%$keyword%' OR 
				nama_pembeli LIKE '%$keyword%' OR
				nama_karyawan LIKE '%$keyword%') AND
				pembayaran.kode_bisnis = '$kode'


				";

	return query($query);
}

function tambah_penjualan($data)
{

	global $conn;

	// ambil data dari form
	$no_faktur = htmlspecialchars($data["no_faktur"]);
	$tgl_pemesanan = htmlspecialchars($data["tgl_pemesanan"]);
	$tgl_jatohtempo = htmlspecialchars($data["tgl_jatohtempo"]);
	$pembeli = htmlspecialchars($data["pembeli"]);
	$karyawan = htmlspecialchars($data["karyawan"]);
	$kode_bisnis = htmlspecialchars($data["kode_bisnis"]);

	// query insert
	$query = "INSERT INTO faktur VALUES ('$no_faktur', '$tgl_pemesanan', '$tgl_jatohtempo', '$pembeli', '$karyawan', '$kode_bisnis') ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function ubah_penjualan($data)
{

	global $conn;

	// ambil data dari form
	$no_faktur = htmlspecialchars($data["no_faktur"]);
	$tgl_pemesanan = htmlspecialchars($data["tgl_pemesanan"]);
	$tgl_jatohtempo = htmlspecialchars($data["tgl_jatohtempo"]);
	$pembeli = htmlspecialchars($data["pembeli"]);
	$karyawan = htmlspecialchars($data["karyawan"]);


	$query = "UPDATE faktur SET 
				tgl_pemesanan = '$tgl_pemesanan',
				tgl_jatohtempo = '$tgl_jatohtempo',
				id_pembeli = '$pembeli',
				id_karyawan = '$karyawan'

				WHERE no_faktur = '$no_faktur'

			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambah_transaksi_penjualan($data, $stok)
{

	global $conn;

	// ambil data dari form
	$no_faktur = htmlspecialchars($data["no_faktur"]);
	$barang = htmlspecialchars($data["barang"]);
	$kuantitas = htmlspecialchars($data["kuantitas"]);


	// query insert
	$query = "INSERT INTO transaksi VALUES ('$no_faktur', '$barang', '$kuantitas') ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function kurangi_stok($data, $stok)
{
	global $conn;

	$barang = htmlspecialchars($data["barang"]);
	$kuantitas = htmlspecialchars($data["kuantitas"]);
	$stoks = $stok["stok"];

	$query = "UPDATE barang SET stok = $stoks - $kuantitas WHERE kode_barang = '$barang' ";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function tambah_stok($barang, $kuantitas, $stok)
{
	global $conn;

	$stoks = $stok["stok"];

	$query = "UPDATE barang SET stok = $stoks + $kuantitas WHERE kode_barang = '$barang' ";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}



function hapus_transaksi_penjualan($no, $kode)
{

	global $conn;
	mysqli_query($conn, "DELETE FROM transaksi WHERE no_faktur ='$no' && kode_barang = '$kode'");
	return mysqli_affected_rows($conn);
}

function hapus_pembayaran($no, $kode)
{

	global $conn;
	mysqli_query($conn, "DELETE FROM pembayaran WHERE no_faktur ='$no' && kode_pembayaran = '$kode'");
	return mysqli_affected_rows($conn);
}

function hapus_penjualan($no)
{

	global $conn;
	mysqli_query($conn, "DELETE FROM faktur WHERE no_faktur ='$no'");
	return mysqli_affected_rows($conn);
}

function tambah_pembayaran($data)
{

	global $conn;

	// ambil data dari form
	$kode_pembayaran = htmlspecialchars($data["kode_pembayaran"]);
	$faktur = htmlspecialchars($data["faktur"]);
	$tgl_pembayaran = htmlspecialchars($data["tgl_pembayaran"]);
	$total_pembayaran = htmlspecialchars($data["total_pembayaran"]);
	$kode_bisnis = htmlspecialchars($data["kode_bisnis"]);

	$transaksis = query("SELECT * FROM transaksi JOIN barang USING(kode_barang) JOIN kategori USING(kode_kategori) WHERE no_faktur = '$faktur' ");

	if ($transaksis == null) {
		echo "

      <script>
        alert('Belum ada barang yang dipesan');
        document.location.href = 'pembayaran.php';
      </script>

    ";
		exit;
	}

	$total[] = 0;
	foreach ($transaksis as $transaksi) {
		$total[] = $transaksi["kuantitas"] * $transaksi["harga_jual"];
	}



	// $status;
	if ($total_pembayaran >= array_sum($total)) {
		$status = 'Lunas';
	} else {
		$status = 'Belum Lunas';
	}


	// query insert
	$query = "INSERT INTO pembayaran VALUES ('$kode_pembayaran', '$tgl_pembayaran', '$total_pembayaran', '$faktur', '$status', '$kode_bisnis') ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function ubah_pembayaran($data)
{

	global $conn;

	// ambil data dari form
	$kode_pembayaran = htmlspecialchars($data["kode_pembayaran"]);
	$faktur = htmlspecialchars($data["faktur"]);
	$tgl_pembayaran = htmlspecialchars($data["tgl_pembayaran"]);
	$total_pembayaran = htmlspecialchars($data["total_pembayaran"]);

	$transaksis = query("SELECT * FROM transaksi JOIN barang USING(kode_barang) JOIN kategori USING(kode_kategori) WHERE no_faktur = '$faktur' ");

	$total[] = 0;
	foreach ($transaksis as $transaksi) {
		$total[] = $transaksi["kuantitas"] * $transaksi["harga_jual"];
	}

	// $status;
	if ($total_pembayaran >= array_sum($total)) {
		$status = 'Lunas';
	} else {
		$status = 'Belum Lunas';
	}


	// query insert
	$query = "UPDATE pembayaran SET 
				tgl_pembayaran = '$tgl_pembayaran',
				total_pembayaran = '$total_pembayaran',
				no_faktur = '$faktur',
				status = '$status'

				WHERE kode_pembayaran = '$kode_pembayaran'

			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
