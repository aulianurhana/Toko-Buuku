<?php
session_start();
// session_start() digunakan sebagai tanda kalau kita akan menggunakan
// session pada halaman curl_ini
// session_start() harus diletakkan pada bari pertama
include("config.php");

// tampung data username dan pasword punya
$username = $_POST["username"];
$password = $_POST["password"];

if (isset($_POST["login_admin"])) {
  $sql = "select * from admin where username = '$username'and password = '$password'";
  // eksekusi query
  $query = mysqli_query($connect,$sql);
  $jumlah = mysqli_num_rows($query);
  // mysqli_num_rows digunakan untuk menghitung jumlah data hasil dari query
  if ($jumlah > 0) {
    // jika jumlahnya lebih dari nol artinya terdapat data admin yang sesuai dengan username dn password yang diinputkan
    // ini blok kode jika login berhasil
    // kita ubah hasil query ke array
    $admin = mysqli_fetch_array($query);

    // membuat session
    $_SESSION["id_admin"] = $admin["id_admin"];
    $_SESSION["nama"] = $admin["nama"];

    header("location:buku.php");
  }else {
    // jika jumlahnya nol, artinya tidak ada data admin yang sesuai dengan username dan password yang diinputkan
    // ini blok kode jika loginnya gagal/salah
    header("location:login_admin.php");
  }
}

if(isset($_GET["logout"])){
  // proses loginnya

  session_destroy(); // menghapus data session yang telah dibuat / menghacurkan data
  header("location : login_admin.php");
}

 ?>
