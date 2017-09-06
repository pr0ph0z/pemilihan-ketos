<?php
include '../src/kandidat.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pemilihan Ketua OSIS SMKN 2 Cimahi</title>
    <link rel="shortcut icon" type="image/png" href="../img/logo.png"/>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/sweetalert.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <span class="title-1">Pemilihan</span><span class="title-2"> Ketua OSIS</span><br>
          <span class="title-3">SMK Negeri 2 Cimahi</span>
          <hr class="hr">
          <div class="col-md-2 col-md-offset-5" style="margin-bottom: 10px">
            <input type="text" name="kelas" placeholder="Kelas" id="kelas" class="form-control text-center">
            <br>
            <button class="btn btn-primary" onclick="buka()" id="buka">Buka</button> <button class="btn btn-danger" onclick="tutup()" id="tutup">Tutup</button>
          </div>
        </div>
      </div>
      <div class="row">
      <?php
      $kandidat = new Kandidat();
      $sql = $kandidat->getIndex();
      while ($data = $sql->fetch_assoc()):
        $visi_explode = explode("-", $data['visi']);
        $misi_explode = explode("-", $data['misi']);
      ?>
        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading text-center"><?= $data['nama'] ?></div>
            <div class="panel-body">
              <img class="center-block" src="../img/<?= $data['gambar']?>" width="150">
              <br>
              <span class="center-block vm">Kelas : <?= $data['kelas'] ?></span>
              <span class="center-block vm"><br>Visi :<br>
              <?php 
                foreach ($visi_explode as $visi) {
                  echo "-$visi<br>";
                }
              ?></span>
              <span class="center-block vm"><br>Misi :<br>
              <?php
                foreach ($misi_explode as $misi) {
                  echo "-$misi<br>";
                }
              ?></span>
              <br>
              <button class="btn btn-primary col-md-6 vote" name="<?= $data['nama'] ?>" id="<?= $data['id'] ?>" style="margin-left:70px" onClick="vote(this.id, this.name)">
                <i class="fa fa-check" aria-hidden="true"></i> Vote
              </button>
            </div>
          </div>
        </div>
      <?php
      endwhile;
      ?>
      </div>
    </div>
    <footer class="footer">
      <div class="container text-center">
      <hr>
        <img src="../img/logic.jpg" width="100"><br><span class="text-muted">&copy;LOGIC 2017 - Mohamad Radisha XII RPL A</span>
      </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/sweetalert-dev.js"></script>
    <script type="text/javascript">
      var element = document.getElementById("kelas");
      var op = element.options[element.selectedIndex].text;

      function vote(id,nama) {
        var id_kandidat = id;
        swal({
          title: "Konfirmasi",
          text: "Apakah anda yakin akan memilih "+nama+"? ",
          type: "warning",
          animation: "slide-from-top",
          showCancelButton: true,
          confirmButtonColor: "#86cceb",
          confirmButtonText: "Ya",  
          cancelButtonText: "Saya ingin memilih yang lain",
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            $.ajax(
                    {
                        type: "get",
                        url: "../src/vote.php",
                        data: {"id_kandidat":id, "kelas":element.value},
                        success: function(data){
                        }
                    }
            )
            .done(function(data) {
              swal("Berhasil!", "Terimakasih telah memilih!", "success");
            })
            .error(function(data) {
              swal("Oops", "Ada masalah dengan server!", "error");
            });
          } else {
            swal("Dibatalkan", "Silahkan pilih kandidat yang lain", "error");
          }
        });

       //  swal({
       //   title: "Are you sure?", 
       //   text: "This action will completely remove "+nama, 
       //   type: "warning", 
       //   showCancelButton: true, 
       //   confirmButtonColor: "#DD6B55", 
       //   confirmButtonText: "Yes, delete it!", 
       //   showLoaderOnConfirm: true, 
       //   closeOnConfirm: false 
       //  }, 
       //  function(isConfirm) {
       //   if (isConfirm) {
       //      swal("Berhasil!", "Terimakasih telah memilih.", "success");
       //    } else {
       //      swal("Dibatalkan", "Silahkan pilih kandidat yang lain", "error");
       //    }
       // });
      }
      function buka() {
        $('#kelas').removeAttr('disabled');
      }
      function tutup() {
        $('#kelas').attr('disabled','true');
      }
    </script>
  </body>
</html>