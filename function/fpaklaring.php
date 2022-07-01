<?php
include "koneksi.php";
$sql = mysqli_query($conn,"SELECT paklaring.no , paklaring.id, paklaring.med, paklaring.nama as pak, jabatan.nama as jab, tempat.nama as tem, paklaring.unik FROM paklaring 
INNER JOIN tempat ON paklaring.id_tempat = tempat.id_tempat 
INNER JOIN jabatan ON paklaring.id_jabatan = jabatan.id_jabatan");

error_reporting(E_ALL ^ E_NOTICE);
if(isset($_POST["submit"])){
    $no = $_POST["no"];
    $med = $_POST["med"];
    $nama = $_POST["nama"];
    $jabatan = $_POST["jabatan"];
    $bagian = $_POST["bagian"];
    $tempat = $_POST["tempat"];
    $awal = $_POST["awal"];
    $akhir = $_POST["akhir"];
    $alasan = $_POST["alasan"];
    $qrunik = uniqid();
    $create = date('Y-m-d');
    $kategori = $_POST["kategori"];
    $sql= mysqli_query($conn, "SELECT * FROM paklaring where med='$med'");
    $cek = mysqli_num_rows($sql);
    if($cek){
        echo"<script>alert('Data Sudah ada -> $med');window.location='../tambah.php#';</script>";
    }else{
    mysqli_query($conn, "INSERT INTO paklaring (no, med, nama, id_jabatan, id_bagian, id_tempat, awal, akhir, alasan, unik, create_date, id_kategori) VALUES ('$no', '$med','$nama','$jabatan','$bagian','$tempat','$awal','$akhir','$alasan','$qrunik', '$create', '$kategori')");
    require_once('../phpqrcode/qrlib.php'); 
    $qrvalue = $qrunik;
    $tempDir = "../qr/"; 
    $codeContents = "https://dianmandiri.id/barcode/cek.php?cek=" . $qrvalue; 
    $fileName = $qrvalue . '.png'; 
    $pngAbsoluteFilePath = $tempDir.$fileName; 
    $urlRelativeFilePath = $tempDir.$fileName; 
    if (!file_exists($pngAbsoluteFilePath)) { 
        QRcode::png($codeContents, $pngAbsoluteFilePath); 
    }
    echo"<script>alert('Data $nama berhasil ditambahkan.');window.location='../tambah.php';</script>";
}
}
elseif($_GET['act']=='delete'){
	
    $id = $_GET["id"];
    $unik = $_GET["unik"];
    //mengambil id yang ingin dihapus    
        //jalankan query DELETE untuk menghapus data
        unlink("../qr/$unik");
        $query = "DELETE FROM paklaring WHERE id=$id";
        $hasil_query = mysqli_query($conn, $query);    
        //periksa query, apakah ada kesalahan
        if(!$hasil_query) {
          die ("Gagal menghapus data: ".mysqli_errno($conn).
           " - ".mysqli_error($conn));
           echo "<script>alert('Gagal.');</script>";
        } else {
          echo "<script>alert('Data berhasil dihapus.');window.location='../home.php';</script>";
        }	
        
    }
    elseif($_GET['act']=='update'){
        $id = $_POST["id"];
        $no = $_POST["no"];
    $med = $_POST["med"];
    $nama = $_POST["nama"];
    $jabatan = $_POST["jabatan"];
    $bagian = $_POST["bagian"];
    $tempat = $_POST["tempat"];
    $awal = $_POST["awal"];
    $akhir = $_POST["akhir"];
    $alasan = $_POST["alasan"];
    $kategori = $_POST["kategori"];
    $unik = $_POST["unik"];
    $create = $_POST["create"];
       $result = mysqli_query($conn,"UPDATE paklaring SET no = '$no', med = '$med', nama = '$nama', id_jabatan = '$jabatan', id_bagian = '$bagian', id_tempat = '$tempat', awal = '$awal', akhir = '$akhir', alasan = '$alasan', unik = '$unik', create_date = '$create', id_kategori = '$kategori' WHERE id = '$id'");
        if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($conn).
                                 " - ".mysqli_error($conn));
        }else{
          echo "<script>alert('Data Karyawan berhasil dirubah.');window.location='../home.php';</script>";
        }
    }
    elseif($_GET['act']=='ganti'){
        $id = $_GET["id"];
        $pass1 = $_POST["pass1"];
        $pass2 = $_POST["pass2"];
        if($pass1==$pass2){
            $result = mysqli_query($conn,"UPDATE user SET password = '".md5($pass2)."' WHERE id = '$id'");
            if(!$result){
                die ("Query gagal dijalankan: ".mysqli_errno($conn).
                                     " - ".mysqli_error($conn));
            }else{
              echo "<script>alert('Password Berhasil dirubah.');window.location='../home.php';</script>";
            }   
        }else{
            echo "<script>alert(Password tidak sama.');window.location='../home.php';</script>";
        }
    }
?>