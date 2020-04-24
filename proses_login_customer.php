<?php
session_start();
// session_start() digunakan sebagai tanda kalau kita akan menggunakan
// session pada halaman curl_ini
// session_start() harus diletakkan pada bari pertama
include("config.php");

// tampung data username dan pasword punya
$username = $_POST["username"];
$password = $_POST["password"];

if (isset($_POST["login_customer"])) {
  $sql = "select * from customer where username = '$username' and password = '$password'";
  // eksekusi query
  $query = mysqli_query($connect,$sql);
  $jumlah = mysqli_num_rows($query);

  if ($jumlah > 0) {

    $customer = mysqli_fetch_array($query);

    // membuat session
    $_SESSION["id_customer"] = $customer["id_customer"];
    $_SESSION["nama"] = $customer["nama"];
    $_SESSION["cart"] = array();

    header("location:tampilan_buku.php");
  }else {
    // jika jumlahnya nol, artinya tidak ada data admin yang sesuai dengan username dan password yang diinputkan
    // ini blok kode jika loginnya gagal/salah
    header("location:login_customer.php");
  }
}
if(isset($_GET["logout"])){
  // proses loginnya
  session_destroy(); // menghapus data session yang telah dibuat / menghacurkan data
  header("location : login_customer.php");
}
 ?>
