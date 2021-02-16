<?php
$servername = "localhost";
$database = "db_gereja";
$username = "root";
$password = "";

// YANG BELUM
// LOGIN
// SEARCHING DATA BERDASARKAN NAMA
// SEARCHING DATA BERDSARKAN BULAN LAHIR

// jadi saat user mengirimkan nama, maka diproses terlebih dahulu berdasarkan nama, berhasil
// setelah diterima  di ambil nkk terus di query di table sama, cari berdasarkan nkk yang sama
//  lalu kembalikan => untuk searching berdasrkan nama kepala keluarga dan jumlah anggota

$conn = mysqli_connect($servername, $username, $password, $database);
//=============================CONNECTION DATABASE =============================//
//=============================CONNECTION DATABASE =============================//
//=============================CONNECTION DATABASE =============================//

// LOGIN
function LoginAdmin($data){
  global $conn;
  $user_nama = $data['username'];
  $password = $data['password'];
  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user_nama' AND pass = '$password';");
  if ($result->num_rows == 1){
    return true;
  }
  return false;
}


function connectionDb()
{
  global $conn;
  if (!$conn) {
    echo "Koneksi gagal: " . mysqli_connect_error();
    mysqli_close($conn);
    return false;
  }
  return true;
}
// DATA LIST DAK
function dataDAK()
{
  global $conn;
  $dataDAK = [];
  $result = mysqli_query($conn, "SELECT * FROM dak");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataDAK, $row);
  };
  return $dataDAK;
}
//=============================READ =============================//
//=============================READ =============================//
//=============================READ =============================//
//ORANG
function dataSemuaOrang()
{
  global $conn;
  $dataOrang = [];
  $result = mysqli_query($conn, "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak )");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return $dataOrang;
}
//ORANG
function getDataOrangByidOrang($idOrang)
{
  global $conn;
  $dataOrang = [];
  $id_orang = (int)($idOrang);
  $result = mysqli_query($conn, "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_orang = $id_orang;");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return $dataOrang;
}
//ORANG
function getDataOrangByidPekerjaan($idPekerjaan)
{
  global $conn;
  $dataOrang = [];
  $id_pekerjaan = (int)($idPekerjaan);
  $result = mysqli_query($conn, "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_pekerjaan = $id_pekerjaan;");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return $dataOrang;
}
//ORANG
function getDataOrangByNamaOrang($namaOrang)
{
  global $conn;
  $dataOrang = [];
  $nama_orang = $namaOrang;
  $result = mysqli_query($conn, "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.nama_orang LIKE  '%$nama_orang%';");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return $dataOrang;
}
//ORANG
function getDataOrangByBulanLahir($idBulan, $idDAK)
{
  global $conn;
  $dataOrang = [];
  $id_bulan = (int)($idBulan);
  $id_DAK = (int)($idDAK);
  if ($id_DAK == null) {
    $result = mysqli_query($conn, "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE MONTH(orang.tl_orang) = $id_bulan AND orang.id_dak =  $id_DAK;");
  } else {
    $result = mysqli_query($conn, "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE MONTH(orang.tl_orang) = $id_bulan;");
  }
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return $dataOrang;
}
//ORANG
function getDataOrangByBulanIdPekerjaanNamaOrang($idBulan, $idPekerjaan, $namaOrang, $idDAK)
{
  global $conn;
  $dataOrang = [];
  $id_bulan = (int)($idBulan);
  $id_DAK = (int)($idDAK);
  $nama_orang = $namaOrang;
  $id_pekerjaan = (int)($idPekerjaan);
  // KOSONG DAN TIDAK KOSONG
  // all data dengan nama kosong semua pekerjaan dan semua bulan
  $query = querySearching($id_bulan, $id_pekerjaan, $nama_orang, $id_DAK);
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return $dataOrang;
}
//ORANG
function getDataOrangByBulanNamaOrang($idBulan, $namaOrang)
{
  global $conn;
  $dataOrang = [];
  $id_bulan = (int)($idBulan);
  $nama_orang = $namaOrang;
  $query = querySearchingTwo($id_bulan, $nama_orang);
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return $dataOrang;
}
//DAK I
function dataDakSatu()
{
  global $conn;
  $dataOrang = [];
  $result = mysqli_query($conn, "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan FROM (
    (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) 
    LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE dak.id_dak = 1;");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return $dataOrang;
}
//DAK II
function dataDakDua()
{
  global $conn;
  $dataOrang = [];
  $result = mysqli_query($conn, "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan FROM (
    (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) 
    LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE dak.id_dak = 2;");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return $dataOrang;
}
function dataDakKosong()
{
  global $conn;
  $dataOrang = [];
  $result = mysqli_query($conn, "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan FROM (
    (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) 
    LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE dak.id_dak = 3;");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return $dataOrang;
}
//KELAHIRAN
function dataKelahiran()
{
  global $conn;
  $dataOrang = [];
  $result = mysqli_query($conn, "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.status_orang, orang.jk_orang, orang.nkk_orang FROM orang;");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return $dataOrang;
}

// PEKERJAAN
function dataPekerjaan()
{
  global $conn;
  $dataPekerjaan = [];
  $result = mysqli_query($conn, "SELECT * FROM pekerjaan");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataPekerjaan, $row);
  };
  return $dataPekerjaan;
}
function getDataPekerjaanByIdPekerjaan($idPekerjaan)
{
  global $conn;
  $dataPekerjaan = [];
  $id_pekerjaan = (int)($idPekerjaan);

  $result = mysqli_query($conn, "SELECT * FROM pekerjaan WHERE id_pekerjaan = $id_pekerjaan");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataPekerjaan, $row);
  };
  return $dataPekerjaan;
}

// PERNIKAHAN
function dataPernikahan()
{
  global $conn;
  $dataPernikahan = [];
  $result = mysqli_query($conn, "SELECT * FROM pernikahan");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataPernikahan, $row);
  };
  return $dataPernikahan;
}
// PERNIKAHAN
function getDataPernikahanByidPernikahan($idPernikahan)
{
  global $conn;
  $dataPernikahan = [];
  $id_pernikahan = (int)($idPernikahan);

  $result = mysqli_query($conn, "SELECT * FROM pernikahan WHERE id_pernikahan = $id_pernikahan");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataPernikahan, $row);
  };
  return $dataPernikahan;
}
// PERNIKAHAN
function getDataPernikahanBySuamiIstriBulan($namaSuami, $namaIstri, $idBulan)
{
  global $conn;
  $dataPernikahan = [];
  $id_bulan = (int)($idBulan);
  $nama_suami = $namaSuami;
  $nama_istri = $namaIstri;
  $query = querySearchingThree($nama_suami, $nama_istri, $id_bulan);
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataPernikahan, $row);
  };
  return $dataPernikahan;
}

//=============================CREATE =============================//
//=============================CREATE =============================//
//=============================CREATE =============================//

//ORANG => data kelahiran dan data DAK
function createDataOrang($data)
{
  global $conn;
  // personal data
  $nama_orang = $data["nama_orang"];
  $tl_orang = $data["tl_orang"];
  $jk_orang = $data["jk_orang"];
  $status_orang = $data["status_orang"];
  // dak  data
  $nkk_orang = $data["nkk_orang"];
  $alamat_orang = $data["alamat_orang"];

  $baptis_orang = $data["baptis_orang"] ;
  $sidi_orang =   $data["sidi_orang"] ;
  $pernikahan_orang =  $data["pernikahan_orang"];
  $id_pekerjaan = (int)($data["id_pekerjaan"]);
  $id_dak = (int)($data["id_dak"]);
  $query = mysqli_query(
    $conn,
    "INSERT INTO orang (
            id_orang, 
            nama_orang, 
            tl_orang, 
            jk_orang, 
            status_orang, 
            nkk_orang, 
            alamat_orang, 
            baptis_orang, 
            sidi_orang, 
            pernikahan_orang, 
            id_pekerjaan, 
            id_dak) VALUES (
                NULL, 
                '$nama_orang', 
                '$tl_orang', 
                '$jk_orang', 
                '$status_orang', 
                '$nkk_orang', 
                '$alamat_orang',
                '$baptis_orang',
                '$sidi_orang', 
                '$pernikahan_orang', 
                $id_pekerjaan, 
                $id_dak)"
  );

  if ($query) {
    return true;
  }
  return false;
}
//PEKERJAAN
function createDataPekerjaan($data)
{
  global $conn;
  $nama_pekerjaan = $data["nama_pekerjaan"];
  $query = mysqli_query(
    $conn,
    "INSERT INTO pekerjaan (id_pekerjaan, nama_pekerjaan) VALUES (NULL, '$nama_pekerjaan');"
  );
  if ($query) {
    return true;
  }
  return false;
}
//PERNIKAHAN
function createDataPernikahan($data)
{
  global $conn;
  $nama_suami = $data["nama_suami"];
  $nama_istri = $data["nama_istri"];
  $tempat_pernikahan = $data["tempat_pernikahan"];
  $tanggal_pernikahan = $data["tanggal_pernikahan"];
  $query = mysqli_query(
    $conn,
    "INSERT INTO pernikahan (id_pernikahan, nama_suami, nama_istri, tempat_pernikahan, `tanggal_pernikahan`) VALUES (NULL, '$nama_suami', '$nama_istri', '$tempat_pernikahan', '$tanggal_pernikahan');"
  );
  if ($query) {
    return true;
  }
  return false;
}


//=============================DELETE =============================//
//=============================DELETE =============================//
//=============================DELETE =============================//

// ORANG
function deleteDataOrang($idOrang)
{
  global $conn;
  $query = mysqli_query(
    $conn,
    "DELETE FROM orang WHERE id_orang = $idOrang"
  );
  if ($query) {
    return true;
  }
  return false;
}
//PEKERJAAN
function deleteDataPekerjaan($idPekerjaan)
{
  global $conn;
  $query = mysqli_query(
    $conn,
    "DELETE FROM pekerjaan WHERE id_pekerjaan = $idPekerjaan"
  );
  if ($query) {
    return true;
  }
  return false;
}
// PERNIKAHAN
function deleteDataPernikahan($idPernikahan)
{
  global $conn;
  $query = mysqli_query(
    $conn,
    "DELETE FROM pernikahan WHERE id_pernikahan = $idPernikahan"
  );
  if ($query) {
    return true;
  }
  return false;
}

//=============================UPDATE =============================//
//=============================UPDATE =============================//
//=============================UPDATE =============================//

//ORANG
function updateDataOrang($data)
{
  global $conn;
  // personal data
  $id_orang = (int)$data["id_orang"];
  $nama_orang = $data["nama_orang"];
  $tl_orang = $data["tl_orang"];
  $jk_orang = $data["jk_orang"];
  $status_orang = $data["status_orang"];
  // dak  data
  $nkk_orang = $data["nkk_orang"];
  $alamat_orang = $data["alamat_orang"];
  $data["baptis_orang"] != '' ? $baptis_orang = $data["baptis_orang"] : $baptis_orang = NULL;
  $data["sidi_orang"] != '' ? $sidi_orang = $data["sidi_orang"] : $sidi_orang = NULL;
  $data["pernikahan_orang"] != '' ? $pernikahan_orang = $data["pernikahan_orang"] : $pernikahan_orang = NULL;
  $id_pekerjaan = (int)($data["id_pekerjaan"]);
  $id_dak = (int)($data["id_dak"]);

  $query = mysqli_query(
    $conn,
    "UPDATE orang SET 
        nama_orang='$nama_orang',
        tl_orang='$tl_orang',
        jk_orang='$jk_orang',
        status_orang='$status_orang',
        nkk_orang='$nkk_orang',
        alamat_orang='$alamat_orang',
        baptis_orang='$baptis_orang',
        sidi_orang='$sidi_orang',
        pernikahan_orang='$pernikahan_orang',
        id_pekerjaan='$id_pekerjaan',
        id_dak='$id_dak' 
        WHERE id_orang ='$id_orang';"
  );
  if ($query) {
    return true;
  }
  return false;
}
//PEKERJAAN
function updateDataPekerjaanByIdPekerjaan($data)
{
  global $conn;
  $id_pekerjaan = (int)($data["id_pekerjaan"]);
  $nama_pekerjaan = $data["nama_pekerjaan"];
  $query = mysqli_query(
    $conn,
    "UPDATE pekerjaan SET 
    nama_pekerjaan='$nama_pekerjaan'
    where id_pekerjaan = $id_pekerjaan;"
  );
  if ($query) {
    return true;
  }
  return false;
}
//PERNIKAHAN
function updateDataPernikahanByKodePernikahan($data)
{
  global $conn;
  $id_pernikahan = (int)($data["id_pernikahan"]);
  $nama_suami = $data["nama_suami"];
  $nama_istri = $data["nama_istri"];
  $tempat_pernikahan = $data["tempat_pernikahan"];
  $tanggal_pernikahan = $data["tanggal_pernikahan"];


  $query = mysqli_query(
    $conn,
    "UPDATE pernikahan SET 
    nama_suami='$nama_suami',
    nama_istri='$nama_istri',
    tempat_pernikahan= '$tempat_pernikahan',
    tanggal_pernikahan= '$tanggal_pernikahan'
    WHERE id_pernikahan = $id_pernikahan;"
  );
  if ($query) {
    return true;
  }
  return false;
}


// ANOTHER FUNCTION 
function getAge($data)
{
  $birthDate = $data;
  $birthDate = explode("-", $birthDate);
  $age =  date("Y") - (int)($birthDate[0]);
  return (int)($age);
}
function querySearching($idBulan, $idPekerjaan, $namaOrang, $idDAK)
{
  $id_bulan = (int)($idBulan);
  $id_DAK = (int)($idDAK);
  $nama_orang = $namaOrang;
  $id_pekerjaan = (int)($idPekerjaan);
  if ($id_DAK != null && $id_bulan == 0 && $id_pekerjaan == 0 && $nama_orang == '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_dak = $id_DAK;";
  } else if ($id_DAK != null && $id_bulan == 0 && $id_pekerjaan == 0 && $nama_orang != '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_dak = $id_DAK AND orang.nama_orang LIKE '%$nama_orang%';";
  } else if ($id_DAK != null && $id_bulan == 0 && $id_pekerjaan != 0 && $nama_orang == '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_dak = $id_DAK AND orang.id_pekerjaan = $id_pekerjaan;";
  } else if ($id_DAK != null && $id_bulan == 0 && $id_pekerjaan != 0 && $nama_orang != '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_dak = $id_DAK AND orang.id_pekerjaan = $id_pekerjaan AND orang.nama_orang LIKE '%$nama_orang%';";
  } else if ($id_DAK != null && $id_bulan != 0 && $id_pekerjaan == 0 && $nama_orang == '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_dak = $id_DAK AND MONTH(orang.tl_orang) = $id_bulan;";
  } else if ($id_DAK != null && $id_bulan != 0 && $id_pekerjaan == 0 && $nama_orang != '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_dak = $id_DAK AND MONTH(orang.tl_orang) = $id_bulan AND orang.nama_orang LIKE '%$nama_orang%';";
  } else if ($id_DAK != null && $id_bulan != 0 && $id_pekerjaan != 0 && $nama_orang == '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_dak = $id_DAK AND MONTH(orang.tl_orang) = $id_bulan AND orang.id_pekerjaan = $id_pekerjaan;";
  } else if ($id_DAK != null && $id_bulan != 0 && $id_pekerjaan != 0 && $nama_orang != '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_dak = $id_DAK AND MONTH(orang.tl_orang) = $id_bulan AND orang.id_pekerjaan = $id_pekerjaan AND orang.nama_orang LIKE '%$nama_orang%';";
  } else {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_dak = $id_DAK;";
  }
  return $query;
}

function querySearchingTwo($idBulan, $namaOrang)
{
  $id_bulan = (int)($idBulan);
  $nama_orang = $namaOrang;
  if ($id_bulan == 0  && $nama_orang == '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak );";
  } else if ($id_bulan == 0  && $nama_orang != '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.nama_orang LIKE '%$nama_orang%';";
  } else if ($id_bulan != 0  && $nama_orang == '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE MONTH(orang.tl_orang) = $id_bulan;";
  } else if ($id_bulan != 0  && $nama_orang != '') {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE MONTH(orang.tl_orang) = $id_bulan AND orang.nama_orang LIKE '%$nama_orang%';";
  }
  return $query;
}


function querySearchingThree($namaSuami, $namaIstri, $idBulan)
{
  $id_bulan = (int)($idBulan);
  $nama_suami = $namaSuami;
  $nama_istri = $namaIstri;
  if ($id_bulan == 0  && $nama_suami == '' && $nama_istri == '') {
    $query = "SELECT id_pernikahan, nama_suami, nama_istri, tempat_pernikahan, tanggal_pernikahan FROM pernikahan;";
  } else if ($id_bulan == 0  && $nama_suami == '' && $nama_istri != '') {
    $query = "SELECT id_pernikahan, nama_suami, nama_istri, tempat_pernikahan, tanggal_pernikahan FROM pernikahan WHERE pernikahan.nama_istri LIKE '%$nama_istri%';";
  } else if ($id_bulan == 0  && $nama_suami != '' && $nama_istri == '') {
    $query = "SELECT id_pernikahan, nama_suami, nama_istri, tempat_pernikahan, tanggal_pernikahan FROM pernikahan WHERE pernikahan.nama_suami LIKE '%$nama_suami%';";
  } else if ($id_bulan == 0  && $nama_suami != '' && $nama_istri != '') {
    $query = "SELECT id_pernikahan, nama_suami, nama_istri, tempat_pernikahan, tanggal_pernikahan FROM pernikahan WHERE pernikahan.nama_suami LIKE '%$nama_suami%' AND pernikahan.nama_istri LIKE '%$nama_istri%';";
  } else if ($id_bulan != 0  && $nama_suami == '' && $nama_istri == '') {
    $query = "SELECT id_pernikahan, nama_suami, nama_istri, tempat_pernikahan, tanggal_pernikahan FROM pernikahan WHERE MONTH(pernikahan.tanggal_pernikahan) = $id_bulan;";
  } else if ($id_bulan != 0  && $nama_suami == '' && $nama_istri != '') {
    $query = "SELECT id_pernikahan, nama_suami, nama_istri, tempat_pernikahan, tanggal_pernikahan FROM pernikahan WHERE MONTH(pernikahan.tanggal_pernikahan) = $id_bulan AND pernikahan.nama_istri LIKE '%$nama_istri%';";
  } else if ($id_bulan != 0  && $nama_suami != '' && $nama_istri == '') {
    $query = "SELECT id_pernikahan, nama_suami, nama_istri, tempat_pernikahan, tanggal_pernikahan FROM pernikahan WHERE MONTH(pernikahan.tanggal_pernikahan) = $id_bulan AND pernikahan.nama_suami LIKE '%$nama_suami%';";
  } else if ($id_bulan != 0  && $nama_suami != '' && $nama_istri != '') {
    $query = "SELECT id_pernikahan, nama_suami, nama_istri, tempat_pernikahan, tanggal_pernikahan FROM pernikahan WHERE MONTH(pernikahan.tanggal_pernikahan) = $id_bulan AND pernikahan.nama_suami LIKE '%$nama_suami%' AND pernikahan.nama_istri LIKE '%$nama_istri%';";
  }
  return $query;
}
function mencariAGK($NKK)
{
  global $conn;
  $dataOrang = [];
  $result = mysqli_query($conn, "SELECT COUNT(orang.nkk_orang) AS 'agk' FROM orang WHERE nkk_orang = '$NKK'");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return isset($dataOrang[0]['agk']) ? $dataOrang[0]['agk'] : 0;
}
function mencariNamaKepalaKeluarga($NKK)
{
  global $conn;
  $dataOrang = [];
  $result = mysqli_query($conn, "SELECT orang.nama_orang FROM `orang` WHERE orang.nkk_orang = '$NKK' AND orang.status_orang = 'kepala keluarga';");
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataOrang, $row);
  };
  return isset($dataOrang[0]['nama_orang']) ? $dataOrang[0]['nama_orang'] : '...';
}
function mencariSeluruhAnggotaKeluarga($namaOrang, $idDAK)
{
  global $conn;
  $dataOrang = [];
  if($namaOrang == ''){
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_dak = $idDAK";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      array_push($dataOrang, $row);
    };
  }else {
    $query = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak ) WHERE orang.id_dak = $idDAK AND orang.nama_orang LIKE '%$namaOrang%';";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $nkk_orang = $row['nkk_orang'];
      $queryTwo = "SELECT orang.id_orang, orang.nama_orang, orang.tl_orang, orang.jk_orang, orang.status_orang, orang.nkk_orang, orang.alamat_orang, orang.baptis_orang, orang.sidi_orang, orang.pernikahan_orang, pekerjaan.nama_pekerjaan, dak.nama_dak FROM ( (orang LEFT JOIN pekerjaan ON orang.id_pekerjaan = pekerjaan.id_pekerjaan) LEFT JOIN dak ON orang.id_dak = dak.id_dak) WHERE orang.id_dak = $idDAK AND orang.nkk_orang = '$nkk_orang';";
      $resultTwo = mysqli_query($conn, $queryTwo);
      while ($rowTwo = mysqli_fetch_assoc($resultTwo)) {
        array_push($dataOrang, $rowTwo);
      }
    };
  }
  return $dataOrang;
}
