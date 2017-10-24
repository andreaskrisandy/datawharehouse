<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Import Data Excel dengan PHP</title>

		<!-- Load File bootstrap.min.css yang ada difolder css -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Style untuk Loading -->
		<style>
        #loading{
			background: whitesmoke;
			position: absolute;
			top: 140px;
			left: 82px;
			padding: 5px 10px;
			border: 1px solid #ccc;
		}
		</style>

		<!-- Load File jquery.min.js yang ada difolder js -->
		<script src="js/jquery.min.js"></script>

		<script>
		$(document).ready(function(){
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
		</script>
	</head>
	<body>
		<!-- Membuat Menu Header / Navbar -->
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#" style="color: white;"><b>Import Data Excel dengan PHP</b></a>
				</div>
			</div>
		</nav>
		<!-- Content -->
		<div style="padding: 0 15px;">
			<!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
			<a href="index.php" class="btn btn-danger pull-right">
				<span class="glyphicon glyphicon-remove"></span> Cancel
			</a>
			<h3>Form Import Data</h3>
			<hr>
			<!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
			<form method="post" action="" enctype="multipart/form-data">
				<a href="Format.xlsx" class="btn btn-default">
					<span class="glyphicon glyphicon-download"></span>
					Download Format
				</a><br><br>
				<!--
				-- Buat sebuah input type file
				-- class pull-left berfungsi agar file input berada di sebelah kiri
				-->
				<input type="file" name="file" class="pull-left">

				<button type="submit" name="preview" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-eye-open"></span> Preview
				</button>
			</form>

			<hr>

			<!-- Buat Preview Data -->
			<?php
			// Jika user telah mengklik tombol Preview
			if(isset($_POST['preview'])){
				//$ip = ; // Ambil IP Address dari User
				$nama_file_baru = 'data.xlsx';

				// Cek apakah terdapat file data.xlsx pada folder tmp
				if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
					unlink('tmp/'.$nama_file_baru); // Hapus file tersebut

				$tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
				$tmp_file = $_FILES['file']['tmp_name'];

				// Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
				if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
					// Upload file yang dipilih ke folder tmp
					// dan rename file tersebut menjadi data{ip_address}.xlsx
					// {ip_address} diganti jadi ip address user yang ada di variabel $ip
					// Contoh nama file setelah di rename : data127.0.0.1.xlsx
					move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

					// Load librari PHPExcel nya
					require_once 'PHPExcel/PHPExcel.php';

					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

					// Buat sebuah tag form untuk proses import data ke database
					echo "<form method='post' action='import.php'>";

					// Buat sebuah div untuk alert validasi kosong
					echo "<div class='alert alert-danger' id='kosong'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
					</div>";
					echo "<table class='table table-bordered'>
					<tr>
						<th align='center' rowspan='3'>No</th>
						<th align='center' rowspan='3'>Kode</th>
						<th align='center' rowspan='3'>Penyakit</th>
						<th align='center' colspan='3'>0-7 Hr</th>
						<th align='center' colspan='3'>8-28 Hr</th>
						<th align='center' colspan='4'>1Bl-1Th</th>
						<th align='center' colspan='4'>1-4Th</th>
						<th align='center' colspan='4'>5-9Th</th>
						<th align='center' colspan='4'>10-14Th</th>
						<th align='center' colspan='4'>15-19Th</th>
						<th align='center' colspan='4'>20-44Th</th>
						<th align='center' colspan='4'>45-54Th</th>
						<th align='center' colspan='4'>55-59Th</th>
						<th align='center' colspan='4'>60-69Th</th>
						<th align='center' colspan='4'>70Th</th>
						<th align='center' colspan='5'>Total</th>
						</tr>
							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>

							<th colspan='2'>Baru</th>
							<th colspan='2'>Lama</th>
							<th rowspan='2'>JML</th>
						</tr>
						<tr>
							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

							<th>L</th>
							<th>P</th>

						</tr>
					</tr>";

					$numrow = 1;
					$kosong = 0;
					foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
						// Ambil data pada excel sesuai Kolom
						$nis = $row['B']; // Ambil data NIS
						$nama = $row['C']; // Ambil data nama
						$jenis_kelamin = $row['D']; // Ambil data jenis kelamin
						$telp = $row['E']; // Ambil data telepon
						$alamat = $row['F']; // Ambil data alamat

						// Cek jika semua data tidak diisi
						if(empty($nis) && empty($nama) && empty($jenis_kelamin) && empty($telp) && empty($alamat))
							continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

						// Cek $numrow apakah lebih dari 1
						// Artinya karena baris pertama adalah nama-nama kolom
						// Jadi dilewat saja, tidak usah diimport
						if($numrow > 1){
							// Validasi apakah semua data telah diisi
							$nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
							$nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
							$jk_td = ( ! empty($jenis_kelamin))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
							$telp_td = ( ! empty($telp))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
							$alamat_td = ( ! empty($alamat))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah

							// Jika salah satu data ada yang kosong
							if(empty($nis) or empty($nama) or empty($jenis_kelamin) or empty($telp) or empty($alamat)){
								$kosong++; // Tambah 1 variabel $kosong
							}

							echo "<tr>";
							echo "<td".$nis_td.">".$nis."</td>";
							echo "<td".$nama_td.">".$nama."</td>";
							echo "<td".$jk_td.">".$jenis_kelamin."</td>";
							echo "<td".$telp_td.">".$telp."</td>";
							echo "<td".$alamat_td.">".$alamat."</td>";
							echo "</tr>";
						}

						$numrow++; // Tambah 1 setiap kali looping
					}

					echo "</table>";

					// Cek apakah variabel kosong lebih dari 1
					// Jika lebih dari 1, berarti ada data yang masih kosong
					if($kosong > 1){
					?>
						<script>
						$(document).ready(function(){
							// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
							$("#jumlah_kosong").html('<?php echo $kosong; ?>');

							$("#kosong").show(); // Munculkan alert validasi kosong
						});
						</script>
					<?php
					}else{ // Jika semua data sudah diisi
						echo "<hr>";

						// Buat sebuah tombol untuk mengimport data ke database
						echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
					}

					echo "</form>";
				}else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
					// Munculkan pesan validasi
					echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
					</div>";
				}
			}
			?>
		</div>
	</body>
</html>
