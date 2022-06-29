<?php 
include "koneksi.php";
$tempat = mysqli_query($conn,"SELECT * FROM tempat ORDER BY nama ASC");
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $sql= mysqli_query($conn, "SELECT * FROM tempat where nama='$nama'");
    $cek = mysqli_num_rows($sql);
    if($cek){
        echo"<script>alert('Data Tempat Sudah ada -> $nama');window.location='../cabang.php';</script>";
    }else{
        mysqli_query($conn,"INSERT INTO tempat (nama) VALUES ('$nama')");
        echo"<script>alert('Data ($nama) berhasil ditambahkan.');window.location='../cabang.php';</script>";
    }
}
elseif($_GET['act']=='update'){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $result = mysqli_query($conn,"UPDATE tempat SET nama = '$nama' WHERE id_tempat = '$id'");
    if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
    }else{
      echo "<script>alert('Data berhasil diubah.');window.location='../cabang.php';</script>";
    }
}
elseif($_GET['act']=='delete'){
	
    $id = $_GET["id"];
    //mengambil id yang ingin dihapus
    
        //jalankan query DELETE untuk menghapus data
        $query = "DELETE FROM tempat WHERE id_tempat='$id'";
        $hasil_query = mysqli_query($conn, $query);
    
        //periksa query, apakah ada kesalahan
        if(!$hasil_query) {
          die ("Gagal menghapus data: ".mysqli_errno($conn).
           " - ".mysqli_error($conn));
        } else {
          echo "<script>alert('Data berhasil dihapus.');window.location='../cabang.php';</script>";
        }	
        
    }
?>