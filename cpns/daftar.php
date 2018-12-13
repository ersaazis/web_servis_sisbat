<?php
	include 'koneksi.php';
	$nik = $_POST['nik'];
	$url = "http://localhost/e_ktp/get_profil.php?nik=".$nik;
	$res = json_decode(file_get_contents($url));
	if($res->status == "sukses"){
		$data=($res->profil);
		$nik=$data->nik;
		$tgl_lahir=$data->tgl_lahir;
		$tempat_lahir=$data->tempat_lahir;
		$nama=$data->nama;
		$alamat=$data->provinsi." ".$data->kabupaten." ".$data->kecamatan;

		echo "
			<b>Data Anda</b><hr />
			Nik : $nik <br />
			Nama : $nama <br />
			Tanggal Lahir : $tgl_lahir <br />
			Tempat Lahir : $tempat_lahir <br />
			Alamat : $alamat <hr />
			<b>Anda Sukses Mendaftar CPNS</b>
		";

		$q=$db->prepare("insert into $app.pendaftar (nik,nama,alamat) values ('$nik','$nama','$alamat');");
		$q->execute();
	}
	else {
		echo "$nik tidak ditemukan";
	}
?>