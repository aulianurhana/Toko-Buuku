<?php
session_start();
if (!isset($_SESSION["id_customer"])) {
  header("location:login_customer.php");
}
// memamnggil file config.php
// agar tidak perlu membuat koneksi baru
include("config_buku.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Buku</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <link rel="stylesheet" href="">
    <script type="text/javascript">
      Detail = (item) => {
        document.getElementById('kode_buku').value = item.kode_buku;
        document.getElementById("judul").innerHTML = item.judul;
        document.getElementById("penulis").innerHTML = "Penulis : " + item.penulis;
        document.getElementById("harga").innerHTML = "Harga : Rp " + item.harga;
        document.getElementById("stok").innerHTML = "Stok : " + item.stok;
        document.getElementById("jumlah_beli").value = "1";
        document.getElementById("image").src = "image/" + item.image;
      }
    </script>
    <style media="screen">
        *{
            box-sizing:border-box;
        }
        [class*="col-"] {float: left; padding: 15px;}
        [class*="col-"] {width: 100%;}
        .cover{
            background: url("book.png");
            background-size: cover;
            height: 87vh;
        }
        @media only screen and (max-width: 1090px) {
            .judul{
                display: none;
            }
        }
        @media only screen and (min-width: 561px) {
            .judul{
                color: pink;
                font-size: 70px;
                font-family:cursive;
                font-variant: initial;
                margin-top: 228px;
                text-shadow: 5px 5px 5px black;
            }
        }
        .logo{
            margin-top: 117px;
            width: 300px;
        }
        .footer{
            color:pink;
            font-size: 15px;
            text-decoration: none;
        }
        .user{
          color: pink;
        }
        .footer:hover{
          color: pink;
          text-decoration: none;
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-md bg-danger navbar-danger sticky-top" id="home">
        <a href=""target="blank">
            <img src="book.png" width="70">
        </a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
            <span class="navbar navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ">
              <li class="nav-item"><a href="" class="nav-link"></i></a></li>
              <li class="nav-item"><a href="" class="nav-link"></a></li>
              <li class="nav-item"><a href="tampilan_customer.php" class="nav-link"><i class="fa fa-home"></i></a></li>
              <li class="nav-item"><a href="" class="nav-link text-warning"><?php echo $_SESSION["nama"] ?></a></li>
              <li class="nav-item"><a href="proses_login_customer.php?logout=true" class="nav-link text-danger"><i class="fa fa-sign-out-alt"></i></a></li>
            </ul>
        </div>
    </nav>
    <?php
    // membuat perintah sql untuk menampilkan data siswa
    if (isset($_POST["cari"])) {
      // query jika pencarian
      $cari = $_POST["cari"];
      $sql = "select * from buku where judul like '%$cari%' or penulis like '%$cari%'";
    }else {
      // query jika tidak mencari
      $sql = "select * from buku";
    }

    // eksekusi sqlnya
    $query = mysqli_query($connect, $sql);
     ?>
     <br>
     <div class="container">
       <div class="card">
         <div class="card-header bg-warning">
           <h4 class="text-white">Keranjang Belanja Anda</h4>
         </div>
         <div class="card-body">
           <table class="table">
             <thead>
               <tr>
                 <th>No</th>
                 <th>Judul</th>
                 <th>Harga</th>
                 <th>Jumlah</th>
                 <th>Total</th>
                 <th>Option</th>
               </tr>
             </thead>
             <tbody>
               <?php $no = 1; ?>
               <?php foreach ($_SESSION["cart"] as $cart): ?>
                 <tr>
                   <td><?php echo $no ?></td>
                   <td><?php echo $cart["judul"]; ?></td>
                   <td>Rp <?php echo $cart["harga"]; ?></td>
                   <td><?php echo $cart["jumlah_beli"]; ?></td>
                   <td>Rp <?php echo $cart["jumlah_beli"]*$cart["harga"]; ?></td>
                   <td>
                     <a href="proses_cart.php?hapus=true&kode_buku=<?php echo $cart["kode_buku"]?>">
                       <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                     </a>
                   </td>
                 </tr>
               <?php $no++; endforeach; ?>
             </tbody>
           </table>
         </div>
         <div class="card-footer text-right">
           <a href="proses_cart.php?checkout=true">
               <button type="button" class="btn bg-success text-white">
               Checkout
             </button>
           </a>
         </div>
       </div>
     </div>
     <br>
    <div class="footer" align="center">
        &copy; Copyright by Aulia
    </div>
    <br>
  </body>
</html>
