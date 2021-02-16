<?php
require('../php/function.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
}
// edit, tambah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["id_orang"])) {
        if (updateDataOrang($_POST)) {
            echo '<script language="javascript">';
            echo    'alert("Berhasil Update Data")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo    'alert("Error!! Tidak Bisa Menambahkan Data")';
            echo '</script>';
        }
    } else {
        if (createDataOrang($_POST)) {
            echo '<script language="javascript">';
            echo    'alert("Berhasil Menambahkan Data")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo    'alert("Error!! Tidak Bisa Menambahkan Data")';
            echo '</script>';
        }
    }
}
$dataOrangByIdOrang = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["id-orang"])) {
        $idOrang = (int)($_GET["id-orang"]);
        if (getDataOrangByidOrang($idOrang)) {
            $containerFunction = getDataOrangByidOrang($idOrang);
            array_push($dataOrangByIdOrang, $containerFunction[0]);
        }
    };
}
$selectPekerjaan = dataPekerjaan();
$selectDAK = dataDAK();

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

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Form Data Jamaat</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">

                                <div class="x_content">
                                    <form method="POST" action="/data-jemaat/production/form_data_orang.php" novalidate>
                                        <!-- ketika kita memuat halaman, ternyata tidak ada id di header, maka value id kosong, dan sebaliknya -->
                                        <!-- ketika kita memuat halaman, ternyata tidak ada id di header, name kosong sehinnga saat menambahkan data, nilai null, database AI -->
                                        <input type="hidden" value="<?php echo isset($dataOrangByIdOrang[0]["id_orang"]) ? $dataOrangByIdOrang[0]["id_orang"] : ''; ?>" type="hidden" readonly name="<?php echo isset($dataOrangByIdOrang[0]["id_orang"]) ? 'id_orang' : ''; ?>">

                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Nama<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input value="<?php echo isset($dataOrangByIdOrang[0]["nama_orang"]) ? $dataOrangByIdOrang[0]["nama_orang"] : ""; ?>" class="form-control" data-validate-length-range="6" data-validate-words="1" name="nama_orang" placeholder="contoh. John f. Kennedy" required="required" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Tanggal Lahir<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input value="<?php echo isset($dataOrangByIdOrang[0]["tl_orang"]) ? $dataOrangByIdOrang[0]["tl_orang"] : ""; ?>" class="form-control" class='date' type="date" name="tl_orang" required='required'>
                                                <div><sub>* Hari - Bulan - Tahun</sub></div>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <select name="jk_orang" id="heard" class="form-control" required>
                                                    <option <?php echo isset($dataOrangByIdOrang[0]["jk_orang"]) && $dataOrangByIdOrang[0]["jk_orang"] == "L" ? "selected" : ""; ?> value="L">Laki - Laki</option>
                                                    <option <?php echo isset($dataOrangByIdOrang[0]["jk_orang"]) && $dataOrangByIdOrang[0]["jk_orang"] == "P" ? "selected" : ""; ?> value="P">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Status<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <select name="status_orang" id="heard" class="form-control" required>
                                                    <option <?php echo isset($dataOrangByIdOrang[0]["status_orang"]) && $dataOrangByIdOrang[0]["status_orang"] == "kepala keluarga" ? "selected" : ""; ?> value="kepala keluarga">Kepala Keluarga</option>
                                                    <option <?php echo isset($dataOrangByIdOrang[0]["status_orang"]) && $dataOrangByIdOrang[0]["status_orang"] == "istri" ? "selected" : ""; ?> value="istri">Istri</option>
                                                    <option <?php echo isset($dataOrangByIdOrang[0]["status_orang"])  && $dataOrangByIdOrang[0]["status_orang"] == "anak" ? "selected" : ""; ?> value="anak">Anak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Beribadah</label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <select name="id_dak" id="heard" class="form-control">
                                                    <?php
                                                    $selectedStatus = isset($dataOrangByIdOrang[0]["id_dak"]) ? $dataOrangByIdOrang[0]["id_dak"] : '';
                                                    foreach ($selectDAK as $row) { ?>
                                                        <option value="<?php echo $row['id_dak']; ?>" <?php echo $row['id_dak'] == $selectedStatus ? "selected" : ""; ?>>
                                                            <?php echo $row['nama_dak']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Nomer KK<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input value="<?php echo isset($dataOrangByIdOrang[0]["nkk_orang"]) ? $dataOrangByIdOrang[0]["nkk_orang"] : ""; ?>" class="form-control" type="tel" class='tel' name="nkk_orang" required='required' data-validate-length-range="7" />
                                                <div><sub>* Nomer KK minimal harus 7 angka (bukan huruf)</sub></div>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Alamat<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input value="<?php echo isset($dataOrangByIdOrang[0]["alamat_orang"]) ? $dataOrangByIdOrang[0]["alamat_orang"] : ""; ?>" class="form-control" data-validate-words="1" name="alamat_orang" placeholder="contoh. Palangkaraya" required="required" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Baptis</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input value="<?php echo isset($dataOrangByIdOrang[0]["baptis_orang"]) ? $dataOrangByIdOrang[0]["baptis_orang"] : ""; ?>" class="form-control" class='date' type="date" name="baptis_orang">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Sidi</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input value="<?php echo isset($dataOrangByIdOrang[0]["sidi_orang"]) ? $dataOrangByIdOrang[0]["sidi_orang"] : ""; ?>" class="form-control" class='date' type="date" name="sidi_orang">
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Pernikahan</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input value="<?php echo isset($dataOrangByIdOrang[0]["sidi_orang"]) ? $dataOrangByIdOrang[0]["sidi_orang"] : ""; ?>" class="form-control" class='date' type="date" name="pernikahan_orang">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Pekerjaan</label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <select name="id_pekerjaan" id="heard" class="form-control">
                                                    <?php
                                                    $selectedPekerjaan = isset($dataOrangByIdOrang[0]["id_pekerjaan"]) ? $dataOrangByIdOrang[0]["id_pekerjaan"] : '';
                                                    foreach ($selectPekerjaan as $row) { ?>
                                                        <option value="<?php echo $row['id_pekerjaan']; ?>" <?php echo $row['id_pekerjaan'] == $selectedPekerjaan ? "selected" : ""; ?>>
                                                            <?php echo $row['nama_pekerjaan']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type='submit' class="btn btn-primary">Submit</button>
                                                    <button type='reset' class="btn btn-success">Reset</button>
                                                </div>
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