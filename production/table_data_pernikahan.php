<?php
require('../vendor/autoload.php');
require('../php/function.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
}
// semua data
$dataResultQuery = [];
$dataResultQuery = dataPernikahan();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["id-pernikahan"])) {
        $idPernikahan = (int)($_GET["id-pernikahan"]);
        if (deleteDataPernikahan($idPernikahan)) {
            header("location:table_data_pernikahan.php");
        } else {
            echo '<script language="javascript">';
            echo 'alert("Something Error!! Gagal Menghapus Data")';
            echo '</script>';
        }
    } else if (isset($_GET["ultah-pernikahan"]) && isset($_GET["nama-suami"]) && isset($_GET["nama-istri"]) && isset($_GET["tgl-pernikahan"])) {
        $tlPernikahan = (int)($_GET["ultah-pernikahan"]);
        $namaSuami = $_GET["nama-suami"];
        $namaIstri = $_GET["nama-istri"];
        $tglPernikahan = $_GET["tgl-pernikahan"];
        $template = new \PhpOffice\PhpWord\TemplateProcessor(__DIR__ . "/download/KU_ulang_tahun_pernikahan.docx");
        $template->setValue('title', "$tlPernikahan");
        $template->setValue('nama-suami', "$namaSuami");
        $template->setValue('nama-istri', "$namaIstri");
        $template->setValue('tgl-pernikahan', "$tglPernikahan");
        $template->setValue('tahun', date("Y"));
        header("Content-Disposition: attachment; filename=KU-Pernikahan-$namaSuami&$namaIstri.docx");
        $template->saveAs("php://output");
    }
};
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["id-bulan"]) && isset($_POST["nama-suami"]) && isset($_POST["nama-istri"])) {
        $idBulan = (int)($_POST["id-bulan"]);
        $namaSuami = $_POST["nama-suami"];
        $namaIstri = $_POST["nama-istri"];
        if (getDataPernikahanBySuamiIstriBulan($namaSuami, $namaIstri, $idBulan)) {
            $dataResultQuery = getDataPernikahanBySuamiIstriBulan($namaSuami, $namaIstri, $idBulan);
        } else {
            echo '<script language="javascript">';
            echo 'alert("Data Tidak Ditemukan !!")';
            echo '</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link href="../build/css/mycss.css" rel="stylesheet">

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title" style="height: 45px;"><img src="../build/images/lambang.png" alt="" style="height: 40px; width: 40px;" /><span style="height: 40px; line-height: 40px; font-family: Carter One;">GKE KAHARAP</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Menu</h3>
                            <ul class="nav side-menu">

                                <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="form_data_orang.php">Form Jamaat</a></li>
                                        <li><a href="form_data_pernikahan.php">Form pernikahan</a></li>
                                        <li><a href="form_data_pekerjaan.php">Form Pekerjaan</a></li>
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-table"></i>Data Jamaat DAK <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="table_data_dak_satu.php">Data Lingkungan DAK I</a></li>
                                        <li><a href="table_data_dak_dua.php">Data Lingkungan DAK 2</a></li>
                                        <li><a href="table_data_dak_kosong.php">Data DAK Kosong</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-table"></i>Data Pokok<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="table_data_kelahiran.php">Data Kelahiran</a></li>
                                        <li><a href="table_data_pernikahan.php">Data Pernikahan</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-table"></i>Data Lain-Lain<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="table_data_pekerjaan.php">Data Pekerjaan</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="../build/images/lambang.png" alt="">Admin
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="../php/log-out.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- /page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="">
                            <div class="col-md-12 col-sm-12 p-0 mt-2 mb-2 p-0 m-0">
                                <form method="POST" action="/data-jemaat/production/table_data_pernikahan.php" novalidate>
                                    <div class="col-md-3 col-sm-3 pl-0">
                                        <input class="form-control mb-1" name="nama-suami" placeholder="Nama Suami" />
                                    </div>
                                    <div class="col-md-3 col-sm-3 pl-0">
                                        <input class="form-control mb-1" name="nama-istri" placeholder="Nama Istri" />
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <select name="id-bulan" id="heard" class="form-control mb-1">
                                            <option selected value='0'>Bulan (Semua)</option>
                                            <?php
                                            $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                            $jlh_bln = count($bulan);
                                            for ($c = 0; $c < $jlh_bln; $c += 1) {
                                                $value = $c + 1;
                                                echo "<option value=" . $value . "> $bulan[$c] </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type='submit' class="btn btn-primary ml-1">Cari</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel pl-0 pr-0">
                                <div class="x_title pl-3">
                                    <h2>List Data Pernikahan</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="card-box table-responsive">
                                                <div class="pl-3">File Download</div>
                                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%; text-align: center; font-size: 12px;">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Tempat</th>
                                                            <th>Tanggal</th>
                                                            <th><?php echo date("Y"); ?></th>
                                                            <th><?php echo date("Y") + 1; ?></th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $nomer = 1;
                                                        foreach ($dataResultQuery as $row) { ?>

                                                            <tr>
                                                                <td style="vertical-align: middle;"><?php echo $nomer++ ?></td>
                                                                <td style="vertical-align: middle;"><?php echo $row['nama_suami'] . ' + ' . $row['nama_istri']; ?></td>
                                                                <td style="vertical-align: middle;"><?php echo $row['tempat_pernikahan']; ?></td>
                                                                <td style="vertical-align: middle;"><?php echo date('d F Y', strtotime($row['tanggal_pernikahan'])); ?></td>
                                                                <td style="vertical-align: middle;"><?php echo getAge($row['tanggal_pernikahan']); ?></td>
                                                                <td style="vertical-align: middle;"><?php echo getAge($row['tanggal_pernikahan']) +  1; ?></td>
                                                                <td style="vertical-align: middle;">
                                                                    <a onclick="return  confirm('do you want to update Y/N')" href="form_data_pernikahan.php?id-pernikahan=<?php echo $row["id_pernikahan"]; ?>"><button type="button" class="btn btn-primary" style="font-size: 12px !important;><i class=" fa fa-edit"></i> Edit</button></a>
                                                                    <a onclick="return  confirm('do you want to delete Y/N')" href="table_data_pernikahan.php?id-pernikahan=<?php echo $row["id_pernikahan"]; ?>"><button type="button" class="btn btn-danger" style="font-size: 12px !important;><i class=" fa fa-remove"></i> Hapus</button></a>
                                                                    <a href="table_data_pernikahan.php?ultah-pernikahan=<?php echo getAge($row['tanggal_pernikahan']) . "&nama-suami=" . $row['nama_suami'] . "&nama-istri=" . $row['nama_istri'] . "&tgl-pernikahan=" . date('d F Y', strtotime($row['tanggal_pernikahan'])); ?>"><button type="button" class="btn btn-info" style="font-size: 12px !important;"><i class=" fa fa-download"></i> Unduh</button></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

</body>

</html>