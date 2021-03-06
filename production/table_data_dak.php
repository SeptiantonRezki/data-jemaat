<?php
require('../php/function.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
}
// semua data
$dataResultQuery = [];
$dataResultQuery = dataKelahiran();



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
                                <form method="POST" action="/data-jemaat/production/table_data_dak_dua.php" novalidate>
                                    <div class="col-md-3 col-sm-3 pl-0">
                                        <input class="form-control mb-1" name="nama_orang" placeholder="Nama" />
                                    </div>
                                    <div class="col-md-2 col-sm-2">

                                        <select name="bln" id="heard" class="form-control mb-1">
                                            <option disabled selected>Bulan</option>
                                            <?php
                                            $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                            $jlh_bln = count($bulan);
                                            for ($c = 0; $c < $jlh_bln; $c += 1) {
                                                echo "<option value=$bulan[$c]> $bulan[$c] </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ">
                                        <select name="id_pekerjaan" id="heard" class="form-control">
                                            <?php
                                            foreach ($selectPekerjaan as $row) { ?>
                                                <option value="<?php echo $row['id_pekerjaan']; ?>">
                                                    <?php echo $row['nama_pekerjaan']; ?>
                                                </option>
                                            <?php } ?>
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
                            <div class="x_panel pl-3">
                                <div class="x_title pl-3">
                                    <h2>Data Jamaat Lingkungan I</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="card-box table-responsive">
                                                <div class="pl-3">File Download</div>
                                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%; text-align: center;">
                                                    <thead>
                                                        <tr>
                                                            <th>Nomer</th>
                                                            <th>Nama</th>
                                                            <th>2020</th>
                                                            <th>2021</th>
                                                            <th>Tanggal Lahir</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th>Status</th>
                                                            <th>Alamat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($dataResultQuery as $row) { ?>
                                                            <tr>
                                                                <td><?php echo $row['nkk_orang'] ?></td>
                                                                <td>3</td>
                                                                <td><?php echo $row['nama_orang'] ?></td>
                                                                <td><?php echo $row['tl_orang'] ?></td>
                                                                <td><?php echo $row['status_orang'] ?></td>
                                                                <td><?php echo $row['jk_orang'] ?></td>
                                                                <td><?php echo $row['alamat_orang'] ?></td>
                                                                <td><?php echo $row['baptis_orang'] ?></td>
                                                                <td><?php echo $row['sidi_orang'] ?></td>
                                                                <td><?php echo $row['pernikahan_orang'] ?></td>
                                                                <td><?php echo $row['nama_pekerjaan'] ?></td>
                                                                <td>update || delete|| download></td>
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