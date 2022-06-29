<?php
include "koneksi.php";
include "function/fbagian.php";
session_start();
if (!isset($_SESSION['nama'])) {
    header("Location: index.php");
}
error_reporting(E_ALL ^ E_NOTICE);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bagian | Dian Mandiri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body>
    <?php include "navbar.php"; ?>

    <div class="container">
    <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active">Bagian</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Bagian / Seksi</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="function/fbagian.php" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Bagian / Seksi</label>
                                        <input class="form-control" name="nama">
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="tambah" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Bagian</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Bagian / Seksi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$no = 0 ;
                                        
										while($data= mysqli_fetch_array($bagian))
										    {
										$no++;
									?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $data['nama']; ?></a></td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal"
                                                    data-target="#update<?php echo $no; ?>"><i
                                                        class="fa fa-pencil-square"></i> Edit</a>
                                                <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal"
                                                    data-target="#delete<?php echo $no; ?>"><i class="fa fa-trash"></i>
                                                    Delete</a>
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
                                                            <a href="function/fbagian.php?act=delete&id=<?php echo $data['id_bagian'];?>"
                                                                class="btn btn-primary">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- modal delete -->

                                        <!-- modal update user -->
                                        <div class="example-modal">
                                            <div id="update<?php echo $no; ?>" class="modal fade" role="dialog"
                                                style="display:none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">

                                                            <h3 class="modal-title">Edit Bagian</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="function/fbagian.php?act=update"
                                                                method="POST" enctype="multipart/form-data">
                                                                <?php
																		$id = $data['id_bagian'];
																		$query = "SELECT * FROM bagian WHERE id_bagian='$id'";
																		$result = mysqli_query($conn, $query);
																		while ($row = mysqli_fetch_assoc($result)) {
																		?>
                                                                <input name="id"
                                                                    value="<?php echo $row['id_bagian']; ?>" hidden>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-sm-3 control-label text-right">Bagian
                                                                            <span class="text-red"></span></label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control"
                                                                                name="nama"
                                                                                value="<?php echo $row['nama']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-danger pull-left"
                                                                        data-dismiss="modal">Batal</button>
                                                                    <input type="submit" name="submit"
                                                                        class="btn btn-primary" value="Update">
                                                                </div>
                                                                <?php
																		}
																		?>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- modal update user -->
                                        <!-- modal hak akses -->
                                        <!-- end modal hak akses -->
                                        <?php 
									        }
                                        ?>
                                        </tfoot>
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
            <!-- /.container-fluid -->
        </section>
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