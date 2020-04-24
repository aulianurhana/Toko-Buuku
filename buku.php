<?php
// memanggil file config.php agar tidak perlu membuat koneksi baru
include("config_buku.php");
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Toko Buku</title>
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/popper.min.js"></script>
     <script src="assets/js/bootstrap.min.js"></script>
     <script type="text/javascript">
       Add = () => {
         document.getElementById('action').value = "insert";
         document.getElementById('kode_buku').value = "";
         document.getElementById('judul').value = "";
         document.getElementById('penulis').value = "";
         document.getElementById('tahun').value = "";
         document.getElementById('harga').value = "";
         document.getElementById('stok').value = "";
         document.getElementById('image').value = "";
       }

       Edit = (item) => {
         document.getElementById('action').value = "update";
         document.getElementById('kode_buku').value = item.kode_buku;
         document.getElementById('judul').value = item.judul;
         document.getElementById('penulis').value = item.penulis;
         document.getElementById('tahun').value = item.tahun;
         document.getElementById('harga').value = item.harga;
         document.getElementById('stok').value = item.stok;
         document.getElementById('image').value = item.image;
       }
     </script>
     <style media="screen">
     .image{
       width:292px;
       height:192px;
     }
     .bg-navy{
       background: pink;
     }

     </style>
   </head>
   <body>
     <nav class="navbar navbar-expand-md bg-navy navbar-dark stiky-top">
       <a href="#">
         <img src="book.png" width="90" alt="">
       </a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="menu">
        <span class="navbar navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="tampilan_buku.php" class="nav-link"><i class="fas fa-user"></i></a></li>
          <li class="nav-item"> <a href="tampilan_buku.php" class="nav-link">Buku</a></li>
          <li class="nav-item"> <a href="admin.php" class="nav-link">Admin</a></li>
          <li class="nav-item"> <a href="customer.php" class="nav-link">Customer</a></li>
          </li>
        </ul>
      </div>

      <div class="collapse navbar-collapse" id="menu" >
        <form action="tampilan_buku.php" method="post" >
          <input type="text" name="cari"
          class="form-control" placeholder="pencarian...">
        </form>
      </div>
      </nav>
     <?php
     // membuat perintah sql utk menampilkan toko buku
     if (isset($_POST["cari"])) {
       // query jika pencarian
       $cari = $_POST["cari"];
       $sql = " select * from buku where kode_buku like '%$cari%' or judul like '%$cari%' or penulis like '%$cari%'or tahun like '%$cari%'
       or harga like '%$cari%'or harga like '%$cari%'or stok like '%$cari%'or image like '%$cari%'";
     }else {
       // query jika tidak mencari
     $sql = " select * from buku";
     }
     // eksekusi perintah sql nya
     $query = mysqli_query($connect, $sql);
   ?>

<div class="container">
  <!-- start card -->
  <div class="card">
    <div class="card-header bg-info text-white">
      <h4>Toko Buku</h4>
    </div>
    <div class="card-body">
      <form  action="buku.php" method="post">
        <input type="text" name="cari"
        class="form-control" placeholder="pencarian...">
      </form>
      <table class="table" border="1">
        <thead>
            <tr>
              <th>kode_buku</th>
              <th>Judul</th>
              <th>Penulis</th>
              <th>Tahun</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Image</th>
              <th>Option</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($query as $buku): ?>
             <tr>
              <td><?php echo $buku["kode_buku"];
              //nama "kode_buku" harus sama yg di database
              ?></td>
              <td><?php echo $buku["judul"]; ?></td>
              <td><?php echo $buku["penulis"]; ?></td>
              <td><?php echo $buku["tahun"]; ?></td>
              <td><?php echo $buku["harga"]; ?></td>
              <td><?php echo $buku["stok"]; ?></td>
              <td>
                <img src="<?php echo 'image/'.$buku['image'];?>" alt="Foto Buku" width="200" />
              </td>

              <td>
                <button data-toggle="modal" data-target="#modal_buku" type="button"
                class="btn btn-sm btn-info" onclick='Edit(<?php echo json_encode($buku);?>)'>
                 Edit </button>
              <a href="proses_crud_buku.php?hapus=true&kode_buku=<?php echo $buku["kode_buku"];?>"
                onclick="return confirm('apakah anda yakin ingin menghapus data ini?')">
                <button type="button" class="btn btn-sm btn-primary">
                hapus
              </button>
              </a>
              </td>
            <?php endforeach; ?>
          </tr>
        </tbody>
      </table>
      <button data-toggle="modal" data-target="#modal_buku"
      type="button" class="btn btn-sm btn-success" onclick="Add()">
      Tambah Data
    </button>
    </div>
  </div>
  <!-- end card -->

  <!-- form modal -->
  <div class="modal fade" id="modal_buku">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="proses_crud_buku.php" method="post" enctype="multipart/form-data">
        <div class="modal-header bg-danger text-white">
          <h4>Form Toko Buku</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="action" id="action">
          Kode Buku
          <input type="number" name="kode_buku" id="kode_buku"
          class="form-control" required />
          Judul
          <input type="text" name="judul" id="judul"
          class="form-control" required />
          Penulis
          <input type="text" name="penulis" id="penulis"
          class="form-control" required />
          Tahun
          <input type="text" name="tahun" id="tahun"
          class="form-control" required />
          Harga
          <input type="text" name="harga" id="harga"
          class="form-control" required />
          Stok
          <input type="text" name="stok" id="stok"
          class="form-control" required />
          Image
        <input type="file" name="cover" id="image" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="submit" name="save_buku" class="btn btn-primary">
        simpan
        </button>
      </div>
      </form>
    </div>

  </div>
  </div>
  <!-- end form modal -->
</div>
   </body>
 </html>
