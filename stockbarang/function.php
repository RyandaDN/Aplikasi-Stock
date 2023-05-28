<?php

session_start();
//Membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","stockbarang");


	// Mengecek koneksi ke database
	// if($conn){
	// 	echo 'berhasil';
	// }


//Menambah Barang Baru
	if(isset($_POST['addnewbarang'])){
		$namabarang = $_POST['namabarang'];
		$deskripsi = $_POST['deskripsi'];
		$stock = $_POST['stock'];

		//$addtotable = mysqli_query($conn,"insert into stock (namabarang, deskripsi, stock) values('$namabarang', '$deskripsi', '$stock')");
		$addtotable = mysqli_query($conn, "INSERT INTO stock (namabarang, deskripsi, stock) VALUES ('$namabarang', '$deskripsi', '$stock')");
		if ($addtotable){
			header('location:index.php');
		} else {
			echo 'Gagal';
			header('location:index.php');
		}
	}




//Menambah Barang Masuk
	if(isset($_POST['barangmasuk'])){
		$barangnya = $_POST['barangnya'];
		$penerima = $_POST['penerima'];
		$qty = $_POST['qty'];

		$cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang = '$barangnya'");
		$ambildatanya = mysqli_fetch_array($cekstocksekarang);

		$stocksekarang = $ambildatanya['stock'];
		$tambahkanstocksekarangdenganquantity = $stocksekarang + $qty;

		$addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, keterangan, qty) VALUES ('$barangnya', '$penerima', '$qty')");
		$updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");

		if($addtomasuk&&$updatestockmasuk){
			header('location:masuk.php');
		} else {
			echo 'Gagal';
			header('location:masuk.php');
		}
	}

//Menambah Barang KELUAR
	if(isset($_POST['addbarangkeluar'])){
		$barangnya = $_POST['barangnya'];
		$penerima = $_POST['penerima'];
		$qty = $_POST['qty'];

		$cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang = '$barangnya'");
		$ambildatanya = mysqli_fetch_array($cekstocksekarang);

		$stocksekarang = $ambildatanya['stock'];
		$tambahkanstocksekarangdenganquantity = $stocksekarang - $qty;

		$addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, penerima, qty) VALUES ('$barangnya', '$penerima', '$qty')");
		$updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");

		if($addtokeluar&&$updatestockmasuk){
			header('location:keluar.php');
		} else {
			echo 'Gagal';
			header('location:keluar.php');
		}
	}
?>