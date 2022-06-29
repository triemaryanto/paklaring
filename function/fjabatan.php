<?php 
include "koneksi.php";
$jabatan = mysqli_query($conn,"SELECT * FROM jabatan nama ASC");
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $sql= mysqli_query($conn, "SELECT * FROM jabatan where nama='$nama'");
    $cek = mysqli_num_rows($sql);
    if($cek){
        echo"<script>alert('Data Jabatan Sudah ada -> $ijabatan');window.location='../jabatan.php';</script>";
    }else{
        mysqli_query($conn,"INSERT INTO jabatan (nama) VALUES ('$nama')");
        echo"<script>alert('Data ($nama) berhasil ditambahkan.');window.location='../jabatan.php';</script>";
    }
}
elseif($_GET['act']=='update'){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $result = mysqli_query($conn,"UPDATE jabatan SET nama = '$nama' WHERE id_jabatan ='$id'");
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
    }else{
      echo "<script>alert('Data jabatan diubah.');window.location='../jabatan.php';</script>";
    }
}
elseif($_GET['act']=='delete'){
    $id = $_GET["id"];
    //mengambil id yang ingin dihapus
    
        //jalankan query DELETE untuk menghapus data
        $query = "DELETE FROM jabatan WHERE id_jabatan='$id'";
        $hasil_query = mysqli_query($conn, $query);
    
        //periksa query, apakah ada kesalahan
        if(!$hasil_query) {
          die ("Gagal menghapus data: ".mysqli_errno($conn).
           " - ".mysqli_error($conn));
        } else {
          echo "<script>alert('Data berhasil dihapus.');window.location='../jabatan.php';</script>";
        }	
        
    }
?>