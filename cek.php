<?php
include "koneksi.php";
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

<body>
    <?php 
                    if(isset($_GET["cek"])){
			
			$dta = $_GET["cek"];
			
			$sql ="SELECT * FROM paklaring WHERE unik = '$dta'";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result)){
			
			 ?>
    <br>
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <?php if ($row['kategori']=='ksp'){?>
                        <img src='1.png' width="100%">
                        <?php }else{?>
                        <img src='2.png' width="100%">
                        <?php }?>
                    </div>
                    <hr />
                    <p class="text-center mb-1">No. : <?php echo $row["no"] ?></p>
                    <P>
                    <div class="container justify-content-center">

                        <div class="row justify-content-center ">
                            <div class="col">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            DENGAN INI MENERANGKAN BAHWA
                                        </div>
                                        <div class="col-md-6">
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
                                        <div class="col-md-6">
                                            : <?php echo $row ['nama']; ?> (<?php echo $row ['med']; ?>)
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
                                            : <?php echo $row ['jabatan']; ?>
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
                                            : <?php echo $row ['bagian']; ?>
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
                                            : <?php echo $row ['tempat']; ?>
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
                                            : <?php echo date('d F Y', strtotime($row ['awal'])); ?> s.d <?php echo $row ['akhir']; ?>
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

                                        </div>
                                        <div class="col">
                                            <strong> TANGERANG, <?php echo $row ['create_date']; ?> <br>
                                                <?php if ($row['kategori']=='ksp'){?>
                                                Koperasi
                                                <?php }else{?>
                                                Yayasan <?php } ?>
                                                Dian Mandiri</strong><br>

                                            <img src='qr/<?php echo $row['unik'];?>.png' width='150px'>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <strong></strong>
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
    <?php
                                }
                            }else{
                                ?>
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="row col-10">
        <h5>SILAHKAN MEMINDAI QR KODE DI SURAT KETERANGAN KERJA</h5>
        <a type="submit" class="btn btn-primary" href="https://play.google.com/store/apps/details?id=com.google.ar.lens&hl=en&gl=US"> Pindai </a>
                            </div>
    </div>
    <?php
                                }?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

</body>

</html>