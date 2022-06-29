<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['nama'])) {
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail | Dian Mandiri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body><?php 
                    if(isset($_GET["id"])){
			$id = $_GET["id"];
            $sql = mysqli_query($conn,"SELECT paklaring.no , paklaring.med, paklaring.awal, paklaring.akhir, paklaring.alasan, paklaring.nama as pak, jabatan.nama as jab, tempat.nama as tem, kategori.nama as kat, 
            paklaring.unik, paklaring.create_date, bagian.nama as bag FROM paklaring 
            INNER JOIN tempat ON paklaring.id_tempat = tempat.id_tempat 
            INNER JOIN jabatan ON paklaring.id_jabatan = jabatan.id_jabatan 
            INNER JOIN kategori ON paklaring.id_kategori = kategori.id_kategori
            INNER JOIN bagian ON paklaring.id_bagian = bagian.id_bagian
            where paklaring.id = $id");
			while($row = mysqli_fetch_array($sql)){
			
			 ?>
    <br>
    <div class="row justify-content-center">
  <div class="col-sm-6">
                <div class="">
    <div class="card-body">
        <div class="text-center">
        <h3><strong> SURAT KETERANGAN KERJA </strong><h3>
                <h5> <strong>CERTIFICATE OF EMPLOYMENT</strong> <h5>
                
        </div>
        <hr style="width:50%; margin: auto; height: 2px; color: #000000; background-color:#000000;"/>
        <hr style="width:50%; margin: auto; height: 2px; color: #000000; background-color:#000000;"/>
        <p class="text-center mb-1">No. : <?php echo $row["no"] ?></p>
        <P>
        <div class="container justify-content-center">

            <div class="row justify-content-center ">
                <div class="col">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                            <u>DENGAN INI MENERANGKAN BAHWA</u>
                            </div>
                            <div class="col">
                                :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>This is to cerify that</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <u>Nama/MED</u>
                            </div>
                            <div class="col">
                                : <?php echo $row ['pak']; ?> (<?php echo $row ['med']; ?>)
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>Name/MED</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <u>JABATAN</u>
                            </div>
                            <div class="col">
                                : <?php echo $row ['jab']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>Job Title</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <u>BAGIAN/SEKSI</u>
                            </div>
                            <div class="col">
                                : <?php echo $row ['bag']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>Department/Section</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <u>TEMPAT TUGAS</u>
                            </div>
                            <div class="col">
                                : <?php echo $row ['tem']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>Point of Assigment</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <u>MASA KERJA (DARI-SAMPAI)</u>
                            </div>
                            <div class="col">
                                : <?php echo $row ['awal']; ?> s.d <?php echo $row ['akhir']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>Length of Service (From - Up to)</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <u>ALASAN BERHENTI</u>
                            </div>
                            <div class="col">
                                : <?php echo $row ['alasan']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>Reason for Leaving</strong>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col">
                            <strong> TANGERANG, <?php echo $row ['create_date']; ?> <br>
                                    <?php if ($row['kat']=='KSP'){?>
                                    Koperasi
                                    <?php }else{?>
                                    Yayasan <?php } ?>
                                    Dian Mandiri</strong>
                            </div>
                            <div class="col">
                                <br>

                                <img src='qr/<?php echo $row['unik'];?>.png' width='150px'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <u><strong>Rita Lianti Hasan</strong></u>
                                <br>
                                <?php if ($row['kat']=='KSP'){?>
                                    <strong> Pengurus </strong>
                                    <?php }else{?>
                                        <strong> HR MANAGER </strong><?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
     </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <?php
                                }}
                            /* }else{ 
                                    */?>
</body>

</html>