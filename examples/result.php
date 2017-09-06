<?php
include '../src/kandidat.php';
include '../src/hasil.php';
session_start();
$kandidat = new Kandidat();
$hasil = new Hasil();
$q6 = $hasil->getHasilByKandidatIndex();
$q7 = $hasil->getHasilByKandidatIndex();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hasil Vote</title>
    <link rel="shortcut icon" type="image/png" href="../img/logo.png"/>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/sweetalert.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="../js/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="../js/Chart.min.js"></script>
    <script type="text/javascript" src="../js/utils.js"></script>
  </head>
  <body>
    <div class="container">
      <h1 class="text-center">HASIL VOTE</h1>
      <hr class="hr">
      <div class="row">
        <?php
        $i = 0;
        $q = $kandidat->getIndex();
        $q2 = $hasil->getHasil();
        while($data = $q->fetch_assoc()):
        $id_kandidat = $data['id'];
        $q3 = $hasil->getHasilKelasTerbanyak($id_kandidat);
        $q11 = $hasil->getHasilByJumlah($id_kandidat);
        $data11 = $q11->fetch_assoc();
        $data2 = $q2->fetch_assoc();
        $data3 = $q3->fetch_assoc();
        ?>
        <div class="col-md-4 text-center">
          <div class="panel panel-primary">
            <div class="panel-heading text-center"><h4><?= $data['nama'] ?></h4></div>
            <div class="panel-body">
              <h3>Jumlah vote : </h3>
              <h2><label class="label label-primary"><?= $data11['jumlah'] ?></label></h2>
              <h3>Dengan pemilih terbanyak dari kelas : </h3>
              <h2><label class="label label-primary"><?= $data3['kelas'] ?></label></h2>
            </div>
          </div>
        </div>
        <?php
        endwhile;
        ?>
      </div>
        <canvas id="myChart" class="center-block" style="width: 50%;"></canvas>
        <script>
              var ctx = document.getElementById("myChart").getContext('2d');
              var myPieChart = new Chart(ctx,{
                type: 'pie',
                data: {
                      datasets: [{
                          data: [<?php while($b = $q7->fetch_assoc()){ echo '"' . $b['jumlah'] . '",'; } ?>],
                          backgroundColor: [
                              'rgba(255,99,132,1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                          ],
                          label: 'Dataset 1'
                      }],
                      labels: [<?php while($a = $q6->fetch_assoc()){ echo '"' . $a['nama'] . '",'; } ?>],
                  },
                  options: {
                      responsive: false
                  }
            });
        </script>
      <h1 class="text-center">Berdasarkan Kelas</h1>
      <hr class="hr">
      <div class="row">
        <?php
        $q4 = $hasil->getHasilByKelasIndex();
        while ($data4 = $q4->fetch_assoc()):
        ?>
        <div class="col-md-4 text-center">
          <div class="panelss panel-default">
            <div class="panel-heading text-center"><h4><?= $data4['kelas'] ?></h4></div>
            <div class="panel-body">
              <?php
              $kelas = $data4['kelas'];
              $q5 = $hasil->getHasilByKelasJoin($kelas);
              while ($data5 = $q5->fetch_assoc()):
              ?>
              <!-- <h2><label class="label label-primary"><?= $data4['jumlah'] ?></label></h2> -->
              <h4><?= $data5['nama'] ?> : <label class="label label-primary"><?= $data5['jumlah'] ?></label></h4>
              <?php
              endwhile;
              ?>
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
  </body>
</html>