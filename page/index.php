<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    exit;
}

$thisPage = "Home";
require 'page/head.php';
require 'page/navbar.php';
require 'page/aside.php';
require 'page/function.php';

$produk = mysqli_query($conn, "SELECT * FROM produk");
$total_produk = mysqli_num_rows($produk);

$penjualan = mysqli_query($conn, "SELECT * FROM penjualan");
$total_penjualan = mysqli_num_rows($penjualan);

$perencanaan = mysqli_query($conn, "SELECT * FROM perencanaan_produksi");
$total_perencanaan = mysqli_num_rows($perencanaan);

$grafikPenjualan = query("SELECT count(id_penjualan) as total, nama_produk
  FROM penjualan as a
  join produk b on b.id_produk = a.id_produk
  GROUP BY b.id_produk");

$dataChartPenjualan = array();
foreach ($grafikPenjualan as $row) {
    $dataChartPenjualan['nama_produk'][] = $row['nama_produk'];
    $dataChartPenjualan['total'][] = $row['total'];
}

?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-home"></i> Dashboard</h1>
            <p>CV Aceh Socolatte</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-cube fa-4x"></i>
                <div class="info">
                    <h3>PRODUK</h3>
                    <p><b><?php echo $total_produk ?></b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-cart-plus fa-3x"></i>
                <div class="info">
                    <h3>PENJUALAN</h3>
                    <p><b><?php echo $total_penjualan ?></b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h3>PERENCANAAN PRODUKSI</h3>
                    <p><b><?php echo $total_perencanaan ?></b></p>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Penjualan</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                </div>
            </div>
        </div>
    </div> -->
</main>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="js/plugins/chart.js"></script>

<script type="text/javascript" src="js/plugins/chart.js"></script>
<script type="text/javascript">
    var data = {
        labels: <?= json_encode($dataChartPenjualan['nama_produk']) ?>,
        datasets: [{
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: <?= json_encode($dataChartPenjualan["total"]) ?>,
            },

        ]
    };
    var pdata = [{
            value: 300,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Complete"
        },
        {
            value: 50,
            color: "#F7464A",
            highlight: "#FF5A5E",
            label: "In-Progress"
        }
    ]

    var ctxl = $("#lineChartDemo").get(0).getContext("2d");
    var lineChart = new Chart(ctxl).Line(data);

    var ctxp = $("#pieChartDemo").get(0).getContext("2d");
    var pieChart = new Chart(ctxp).Pie(pdata);
</script>
