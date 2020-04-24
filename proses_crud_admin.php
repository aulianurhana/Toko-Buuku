<?php
/*
nak table di database kamu hapus dulu,
lalu buat lagi dengan nama admin buka toko_buku admin,
yang tabel buku juga gitu iya pak saya hapus sekarang brarti saya buat baru lagi databasenya?
tabel nak, bukan database oh iya pak brrti tabelnya aja iyaa nak iya pak trimakasii

*/
    include("config_admin.php");
    if (isset($_POST["save_admin"])) {
        $action = $_POST["action"];
        $id_admin = $_POST["id_admin"];
        $nama = $_POST["nama"];
        $kontak = $_POST["kontak"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        if ($action == "insert") {
            $sql = "insert into admin values ('$id_admin','$nama', '$kontak', '$username', '$password')";
            mysqli_query($connect, $sql);

        }elseif ($action == "update") {
            $sql = "update admin set id_admin='$id_admin',
                    nama='$nama', kontak='$kontak',
                    username='$username', password='$password'";

            $query = mysqli_query($connect, $sql);
        }
        header("location:admin.php");
    }
    if (isset($_GET["hapus"])) {

        $id_admin = $_GET["id_admin"];
        // process delete
        $sql = "select * from admin where id_admin='$id_admin'";
        $query = mysqli_query($connect, $sql);

        $sql = "delete from admin where id_admin='$id_admin'";
        $query = mysqli_query($connect, $sql);

        header("location:admin.php");
    }
 ?>
