<?php
// mana confignya?
//itu yang customer pak

// koneksi ke Database
$host = "localhost";
$username = "root";
$password = "";
$db = "toko_buku";
// db = database
$connect = mysqli_connect($host,$username,$password,$db);
 // cek koneksi database
 if(mysqli_connect_errno()){
   // menampilkan pesan error ketika koneksi gagals
   echo mysqli_connect_error();
 }
 else {
   echo "Koneksi Berhasil";
 }

 ?>
