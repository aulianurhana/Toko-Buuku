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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/dc8a681ba8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="">
    <script type="text/javascript">

    </script>
    <style media="screen">
        *{
            box-sizing:border-box;
        }
        [class*="col-"] {float: left; padding: 15px;}
        [class*="col-"] {width: 100%;}
        .cover{
            background: url("buku1.png");
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
                color: #f7dd45;
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
              <li class="nav-item"><a href="cart.php" class="nav-link"><i class="fa fa-shopping-cart"></i></i> (<?php echo count($_SESSION["cart"]); ?>)</a></li>
              <li class="nav-item"><a href="" class="nav-link link-disabled text-warning"><i class="fa fa-user"></i></a></li>
              <li class="nav-item"><a href="" class="nav-link text-warning"><?php echo $_SESSION["nama"] ?></a></li>
              <li class="nav-item"><a href="proses_login_customer.php?logout=true" class="nav-link text-white"><i class="fa fa-sign-out-alt"></i></a></li>
            </ul>
        </div>
    </nav>
     <br>
     <div class="container">
       <div class="card mt-3">
         <div class="card-header bg-danger">
           <h4 class="text-white">Riwayat Transaksi</h4>
         </div>
         <div class="card-body">
           <?php
           $sql = "select * from transaksi t inner join customer c
           on t.id_customer = c.id_customer
           where t.id_customer = '".$_SESSION["id_customer"]."' order by t.tgl desc";
           $query = mysqli_query($connect, $sql);
            ?>

            <ul class="list-group">
              <?php foreach ($query as $transaksi): ?>
                <li class="list-group-item mb-4">
                <h6>ID Transaksi: <?php echo $transaksi["id_transaksi"]; ?></h6>
                <h6>Nama Pembeli: <?php echo $transaksi["nama"]; ?></h6>
                <h6>Tgl. Transaksi: <?php echo $transaksi["tgl"]; ?></h6>
                <h6>List Barang: </h6>

                <?php
                $sql2 = "select * from detail_transaksi d inner join buku b
                on d.kode_buku = b.kode_buku
                where d.id_transaksi = '".$transaksi["id_transaksi"]."'";
                $query2 = mysqli_query($connect, $sql2);
                 ?>

                 <table class="table table-borderless">
                   <thead>
                     <tr>
                       <th>Judul</th>
                       <th>Jumlah</th>
                       <th>Harga</th>
                       <th>Total</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php $total = 0; foreach ($query2 as $detail): ?>
                       <tr>
                         <td><?php echo $detail["judul"] ?></td>
                         <td><?php echo $detail["jumlah"] ?></td>
                         <td>Rp <?php echo number_format($detail["harga_beli"]); ?></td>
                         <td>
                           Rp <?php echo number_format($detail["harga_beli"]*$detail["jumlah"]); ?>
                         </td>
                       </tr>
                     <?php $total += ($detail['harga_beli']*$detail["jumlah"]); endforeach; ?>
                   </tbody>
                 </table>
                 <h6 class="text-danger">Rp <?php echo number_format($total); ?></h6>
               </li>
              <?php endforeach; ?>
            </ul>
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
