<?php
include("config.php");
if (isset($_POST["save_customer"])) {
  // isset digunakan untuk mengecek
  // apakah ketika mengakses file ini, dikirimkan
  // data dengan nama "save_siswa" dg method POST
  // kita tampung data  yang dikirimkan
  $action = $_POST["action"];
  $id_customer = $_POST["id_customer"];
  $nama = $_POST["nama"];
  $alamat = $_POST["alamat"];
  $kontak = $_POST["kontak"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  // menampung file image
  if (isset($_FILES["image"])) {
    // mendapat deksripsi info gambar
    $path = pathinfo($_FILES["image"]["nama"]);
    // mengambil ekstensi gambar
    $extension = $path["extension"];

    // rangkai file name
    $filename = $id_customer."-".rand(1,1000).".".$extension;
    // generate nama file
    // exp : 111-989.JPG
    // rand() random nilai 1-1000

  }

  // lood file config.php

// cek aksi-nya
if ($action == "insert") {
  // sintak untuk insert
  $sql = "insert into customer values('$id_customer','$nama','$kontak','$alamat','$username','$password')";
// proses upload file

  // eksekusi perintah SQL-nya
  mysqli_query($connect, $sql);
}elseif ($action == "update") {
  $sql = "update customer set nama = '$nama',kontak = '$kontak',alamat = '$alamat',username = '$username',password = '$password' where id_customer='$id_customer'";
  // eksekusi perintah SQL-nya
  mysqli_query($connect, $sql);
}
// redirect ke halaman siswa.php
header("location:customer.php");

}
if (isset($_GET["hapus"])) {

  $id_customer = $_GET["id_customer"];
  $sql = "select * from customer where id_customer = '$id_customer'";
  $query = mysqli_query();
  $hasil = mysqli_fetch_array($query);
  if (file_exists("image/".$hasil["image"])) {
    unlink("image/".$hasil["image"]);

  }
  $sql= "delete from customer where id_customer ='$id_customer'";


  mysqli_query($connect, $sql);

  // dirrect ke halaman data Siswa
  header("location:customer.php");
}
 ?>
