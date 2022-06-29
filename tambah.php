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
    <title>Tambah Data | Dian Mandiri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body>
    <?php include "navbar.php"; ?>
    <h1 class="text-center mb-4">Tambah Data</h1>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="function/fpaklaring.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Peruntukan</label>
                                <select class="form-select" aria-label="--" name="kategori" required>
                                    <option value="0">--</option>
                                    <?php 
                                                                                            $query1 = mysqli_query($conn, "SELECT * FROM kategori");
                                                                                            while($row1 = mysqli_fetch_array($query1)){
                                                                                    ?>
                                    <option value="<?php echo $row1['id_kategori']; ?>">
                                        <?php echo $row1['nama']; ?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">KOP Surat</label>
                                <input type="text" class="form-control" name="no" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">MED</label>
                                <input type="text" class="form-control" name="med" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jabatan</label>
                                <select class="form-select" aria-label="--" name="jabatan" required>
                                <option value="0">--</option>
                                                                                <?php 
                                                                                            $query1 = mysqli_query($conn, "SELECT * FROM jabatan");
                                                                                            while($row1 = mysqli_fetch_array($query1)){
                                                                                    ?>
                                                                                <option
                                                                                    value="<?php echo $row1['id_jabatan']; ?>">
                                                                                    <?php echo $row1['nama']; ?>
                                                                                </option>
                                                                                <?php }?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bagian / Seksi</label>
                                <select class="form-select" aria-label="--" name="bagian" required>
                                <option value="0">--</option>
                                                                                <?php 
                                                                                            $query1 = mysqli_query($conn, "SELECT * FROM bagian");
                                                                                            while($row1 = mysqli_fetch_array($query1)){
                                                                                    ?>
                                                                                <option
                                                                                    value="<?php echo $row1['id_bagian']; ?>">
                                                                                    <?php echo $row1['nama']; ?>
                                                                                </option>
                                                                                <?php }?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tempat Tugas</label>
                                <select class="form-select" aria-label="--" name="tempat" required>
                                <option value="0">--</option>
                                                                                <?php 
                                                                                            $query1 = mysqli_query($conn, "SELECT * FROM tempat");
                                                                                            while($row1 = mysqli_fetch_array($query1)){
                                                                                    ?>
                                                                                <option
                                                                                    value="<?php echo $row1['id_tempat']; ?>">
                                                                                    <?php echo $row1['nama']; ?>
                                                                                </option>
                                                                                <?php }?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Masa Kerja</label><br>
                                <input type="date" class="form" name="awal" required> s.d
                                <input type="date" class="form" name="akhir" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alasan Keluar</label>
                                <input type="text" class="form-control" name="alasan" required>
                            </div>
                            <button type="submit" class="btn btn-primary" value="submit" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script><!-- ok -->

    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script><!-- ok -->
</body>

</html>