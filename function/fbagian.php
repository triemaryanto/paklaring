<?php 
include "koneksi.php";
$bagian = mysqli_query($conn,"SELECT * FROM bagian nama ASC");
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $sql= mysqli_query($conn, "SELECT * FROM bagian where nama='$nama'");
    $cek = mysqli_num_rows($sql);
    if($cek){
        echo"<script>alert('Data bagian Sudah ada -> $nama');window.location='../bagian.php';</script>";
    }else{
        mysqli_query($conn,"INSERT INTO bagian (nama) VALUES ('$nama')");
        echo"<script>alert('Data ($nama) berhasil ditambahkan.');window.location='../bagian.php';</script>";
    }
}
elseif($_GET['act']=='update'){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $result = mysqli_query($conn,"UPDATE bagian SET nama = '$nama' WHERE id_bagian =$id");
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
    }else{
      echo "<script>alert('Data berhasil diubah.');window.location='../bagian.php';</script>";
    }
}
elseif($_GET['act']=='delete'){
	
    $id = $_GET["id"];
    $nama = $_GET["nama"];
    //mengambil id yang ingin dihapus
    
        //jalankan query DELETE untuk menghapus data
        $query = "DELETE FROM bagian WHERE id_bagian=$id";
        $hasil_query = mysqli_query($conn, $query);
    
        //periksa query, apakah ada kesalahan
        if(!$hasil_query) {
          die ("Gagal menghapus data: ".mysqli_errno($conn).
           " - ".mysqli_error($conn));
        } else {
          echo "<script>alert('Data berhasil dihapus.');window.location='../bagian.php';</script>";
        }	
        
    }
?>