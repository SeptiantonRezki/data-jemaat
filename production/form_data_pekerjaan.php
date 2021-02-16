<?php
require('../php/function.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // check id apakah ada
    if (isset($_POST["id_pekerjaan"])) {
        if (updateDataPekerjaanByIdPekerjaan($_POST)) {
            echo '<script language="javascript">';
            echo 'alert("Berhasil Update Data Pekerjaan!!")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Something Error!! Cannot Update Data")';
            echo '</script>';
        }
    } else {
        if (createDataPekerjaan($_POST)) {
            echo '<script language="javascript">';
            echo 'alert("Berhasil Meambahkan Data Pekejaan!!")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Something Error!! Cannot Create Data")';
            echo '</script>';
        }
    }
}

$dataPekerjaanByIdPekerjaan = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["id-pekerjaan"])) {
        $idPekerjaan = (int)($_GET["id-pekerjaan"]);
        if (getDataPekerjaanByIdPekerjaan($idPekerjaan)) {
            $containerFunction = getDataPekerjaanByIdPekerjaan($idPekerjaan);
            array_push($dataPekerjaanByIdPekerjaan, $containerFunction[0]);
        }
    };
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
                                    <a class="dropdown-item" href="href="../php/log-out.php""><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Form Data Pekerjaan</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <form method="POST" action="/data-jemaat/production/form_data_pekerjaan.php" novalidate>
                                        <!-- ketika kita memuat halaman, ternyata tidak ada id di header, maka value id kosong, dan sebaliknya -->
                                        <!-- ketika kita memuat halaman, ternyata tidak ada id di header, name kosong sehinnga saat menambahkan data, nilai null, database AI -->
                                        <input type="hidden" value="<?php echo isset($dataPekerjaanByIdPekerjaan[0]["id_pekerjaan"]) ? $dataPekerjaanByIdPekerjaan[0]["id_pekerjaan"] : ''; ?>" type="hidden" readonly name="<?php echo isset($dataPekerjaanByIdPekerjaan[0]["id_pekerjaan"]) ? 'id_pekerjaan' : ''; ?>">


                                        <div class="field item form-group">
                                            <div class="col-md-2 col-sm-2 pl-0">
                                                <label class="col-form-label   label-align" style="text-align: left;">Nama Pekerjaan<span class="required">*</span></label>
                                            </div>
                                            <div class="col-md-7 col-sm-7 pl-0">
                                                <input value="<?php echo isset($dataPekerjaanByIdPekerjaan[0]["nama_pekerjaan"]) ? $dataPekerjaanByIdPekerjaan[0]["nama_pekerjaan"] : ""; ?>" class=" form-control" data-validate-length-range="6" data-validate-words="1" name="nama_pekerjaan" placeholder="contoh. Guru" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6 offset-md-2 pl-0">
                                                <button type='submit' class="btn btn-primary">Submit</button>
                                                <button type='reset' class="btn btn-success">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="../vendors/validator/multifield.js"></script>
    <script src="../vendors/validator/validator.js"></script>

    <!-- Javascript functions	-->
    <script>
        function hideshow() {
            var password = document.getElementById("password1");
            var slash = document.getElementById("slash");
            var eye = document.getElementById("eye");

            if (password.type === 'password') {
                password.type = "text";
                slash.style.display = "block";
                eye.style.display = "none";
            } else {
                password.type = "password";
                slash.style.display = "none";
                eye.style.display = "block";
            }

        }
    </script>

    <script>
        // initialize a validator instance from the "FormValidator" constructor.
        // A "<form>" element is optionally passed as an argument, but is not a must
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- validator -->
    <!-- <script src="../vendors/validator/validator.js"></script> -->

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

</body>

</html>