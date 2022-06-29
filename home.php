<?php
include "koneksi.php";
include "function/fpaklaring.php";
session_start();
if (!isset($_SESSION['nama'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dian Mandiri</title>
    <link rel="icon" href="dist/img/logo.png" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body>

    <div class="wrapper">
        <?php include "navbar.php"; ?>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-10 text-center">
                        <h1>Data Paklaring Karyawan</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>MED</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Tempat</th>
                                            <th>barcode</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$no = 0 ;
										while($row = mysqli_fetch_array($sql)){
										$no++;
									?>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row['med']; ?></td>
                                        <td><?php echo $row['pak']; ?></td>
                                        <td><?php echo $row['jab']; ?></td>
                                        <td><?php echo $row['tem']; ?></td>
                                        <td><img src='qr/<?php echo $row['unik'];?>.png' width='50px'><a
                                                href="qr/<?php echo $row['unik'];?>.png" onclick="getPreview();"
                                                target="_BLANK">Preview</a></td>
                                        <td><a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal"
                                                data-target="#update<?php echo $no; ?>"><i
                                                    class="fa fa-pencil-square"></i>
                                                Edit</a>
                                            <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal"
                                                data-target="#delete<?php echo $no; ?>"><i class="fa fa-trash"></i>
                                                Delete</a>
                                                <a href="print.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-flat btn-xs"
                                                        ><i
                                                            class="fa fa-trash"></i> Priview</a>
                                        </td>
                                        </tr>
                                        <!-- modal delete -->
                                        <div class="example-modal">
                                            <div id="delete<?php echo $no; ?>" class="modal fade" role="dialog"
                                                style="display:none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Konfirmasi Delete ?</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4 align="center">Apakah anda yakin ingin
                                                                menghapus<strong><span class="grt"></span></strong>
                                                                ?</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button id="nodelete" type="button"
                                                                class="btn btn-danger pull-left"
                                                                data-dismiss="modal">Cancel</button>
                                                            <a href="function/fpaklaring.php?act=delete&id=<?php echo $row['id']; ?>&unik=<?php echo $row['unik']; ?>.png"
                                                                class="btn btn-primary">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- modal delete -->

                                        <div class="example-modal-xl">
                                            <div id="update<?php echo $no; ?>" class="modal fade" role="dialog"
                                                style="display:none;">

                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Edit Data</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="function/fpaklaring.php?act=update"
                                                                method="POST" enctype="multipart/form-data">
                                                                <?php
																		$id = $row['id'];
																		$query = "SELECT paklaring.id, paklaring.no , paklaring.med, paklaring.awal, paklaring.akhir, paklaring.alasan, paklaring.id_kategori ,paklaring.id_jabatan, 
                                                                        paklaring.id_tempat, paklaring.id_bagian, paklaring.awal, paklaring.akhir, paklaring.alasan, 
                                                                        paklaring.nama as pak, jabatan.nama as jab, tempat.nama as tem, kategori.nama as kat, 
                                                                        paklaring.unik, paklaring.create_date, bagian.nama as bag FROM paklaring 
                                                                        INNER JOIN tempat ON paklaring.id_tempat = tempat.id_tempat 
                                                                        INNER JOIN jabatan ON paklaring.id_jabatan = jabatan.id_jabatan 
                                                                        INNER JOIN kategori ON paklaring.id_kategori = kategori.id_kategori
                                                                        INNER JOIN bagian ON paklaring.id_bagian = bagian.id_bagian
                                                                        where paklaring.id = $id";
																		$result = mysqli_query($conn, $query);
																		while ($data = mysqli_fetch_assoc($result)) {
																		?>

                                                                <input type="text" class="form-control" name="id"
                                                                    value="<?php echo $data['id']; ?>" hidden>
                                                                    <input type="text" class="form-control" name="unik"
                                                                    value="<?php echo $data['unik']; ?>" hidden>

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 control-label text-left">Peruntukan<span
                                                                                class="text-red"></span></label>
                                                                        <label
                                                                            class="col-sm-1 control-label text-rigth">:<span
                                                                                class="text-red"></span></label>
                                                                        <div class="col-sm-7">
                                                                            <select name="kategori"
                                                                                class="form-control form-control-sm">
                                                                                <option
                                                                                    value="<?php echo $data['id_kategori']; ?>">
                                                                                    <?php echo $data['kat']; ?>
                                                                                </option>
                                                                                <option value="0">--</option>
                                                                                <?php 
                                                                                            $query1 = mysqli_query($conn, "SELECT * FROM kategori");
                                                                                            while($row1 = mysqli_fetch_array($query1)){
                                                                                    ?>
                                                                                <option
                                                                                    value="<?php echo $row1['id_kategori']; ?>">
                                                                                    <?php echo $row1['nama']; ?>
                                                                                </option>
                                                                                <?php }?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 control-label text-left">KOP
                                                                            Surat<span class="text-red"></span></label>
                                                                        <label
                                                                            class="col-sm-1 control-label text-rigth">:<span
                                                                                class="text-red"></span></label>
                                                                        <div class="col-sm-7"><input type="text"
                                                                                class="form-control" name="no"
                                                                                value="<?php echo $data['no']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 control-label text-left">MED<span
                                                                                class="text-red"></span></label>
                                                                        <label
                                                                            class="col-sm-1 control-label text-rigth">:<span
                                                                                class="text-red"></span></label>
                                                                        <div class="col-sm-7"><input type="text"
                                                                                class="form-control" name="med"
                                                                                value="<?php echo $data['med']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 control-label text-left">nama<span
                                                                                class="text-red"></span></label>
                                                                        <label
                                                                            class="col-sm-1 control-label text-rigth">:<span
                                                                                class="text-red"></span></label>
                                                                        <div class="col-sm-7"><input type="text"
                                                                                class="form-control" name="nama"
                                                                                value="<?php echo $data['pak']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 control-label text-left">jabatan<span
                                                                                class="text-red"></span></label>
                                                                        <label
                                                                            class="col-sm-1 control-label text-rigth">:<span
                                                                                class="text-red"></span></label>
                                                                        <div class="col-sm-7">
                                                                            <select name="jabatan"
                                                                                class="form-control form-control-sm">
                                                                                <option
                                                                                    value="<?php echo $data['id_jabatan']; ?>">
                                                                                    <?php echo $data['jab']; ?>
                                                                                </option>
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
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 control-label text-left">Bagian<span
                                                                                class="text-red"></span></label>
                                                                        <label
                                                                            class="col-sm-1 control-label text-rigth">:<span
                                                                                class="text-red"></span></label>
                                                                        <div class="col-sm-7">
                                                                            <select name="bagian"
                                                                                class="form-control form-control-sm">
                                                                                
                                                                                <option
                                                                                    value="<?php echo $data['id_bagian']; ?>">
                                                                                    <?php echo $data['bag']; ?>
                                                                                </option>
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
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 control-label text-left">Tempat
                                                                            Tugas<span class="text-red"></span></label>
                                                                        <label
                                                                            class="col-sm-1 control-label text-rigth">:<span
                                                                                class="text-red"></span></label>
                                                                        <div class="col-sm-7">
                                                                            <select name="tempat"
                                                                                class="form-control form-control-sm">
                                                                                <option
                                                                                    value="<?php echo $data['id_tempat']; ?>">
                                                                                    <?php echo $data['tem']; ?>
                                                                                            </option>
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
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 control-label text-left">Masa
                                                                            Kerja<span class="text-red"></span></label>
                                                                        <label
                                                                            class="col-sm-1 control-label text-rigth">:<span
                                                                                class="text-red"></span></label>
                                                                        <div class="col-sm-7"><input type="date"
                                                                                class="form" name="awal" value="<?php echo $data['awal']; ?>" required> s.d
                                                                            <input type="date" class="form" name="akhir"  value="<?php echo $data['akhir']; ?>"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 control-label text-left"> Alasan Keluar<span class="text-red"></span></label>
                                                                        <label
                                                                            class="col-sm-1 control-label text-rigth">:<span
                                                                                class="text-red"></span></label>
                                                                        <div class="col-sm-7"><input type="text"
                                                                                class="form-control" name="alasan"
                                                                                value="<?php echo $data['alasan']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 control-label text-left">Dibuat Tgl<span class="text-red"></span></label>
                                                                        <label
                                                                            class="col-sm-1 control-label text-rigth">:<span
                                                                                class="text-red"></span></label>
                                                                        <div class="col-sm-7"><input type="date"
                                                                                class="form" name="create"
                                                                                value="<?php echo $data['create_date']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-danger pull-left"
                                                                            data-dismiss="modal">Batal</button>
                                                                        <input type="submit"
                                                                            class="btn btn-primary" value="Update">
                                                                    </div>
                                                                <?php
																		}}
																		?>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- modal update user -->
                                        
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
    </div>
    <!-- /.container-fluid -->
    </section>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script><!-- ok -->

    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script><!-- ok -->
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- Page specific script -->
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    function getPreview() {
        $('.preview').hide();
        $('#blah').show();
    }
    </script>


</body>

</html>