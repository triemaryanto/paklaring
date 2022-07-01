<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="home.php">DIAN MANDIRI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Master Data <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tambah.php">Add Data Paklaring</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Kategori
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="jabatan.php">Jabatan</a>
                    <a class="dropdown-item" href="bagian.php">Bagian</a>
                    <a class="dropdown-item" href="cabang.php">Tempat</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal"
                    data-target="#ganti<?php echo $_SESSION['id']; ?>">Ganti Password</a>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-0">

            <a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">Log out</a>
        </form>
    </div>
</nav>
<div class="example-modal">
    <div id="ganti<?php echo $_SESSION['id']; ?>" class="modal fade" role="dialog" style="display:none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"> <?php echo $_SESSION['nama']?> <br> Ganti Password</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-left">Password Baru<span class="text-red"></span></label>
                            <label class="col-sm-1 control-label text-rigth">:<span class="text-red"></span></label>
                            <div class="col-sm-7"><input type="text" class="form-control" name="pass1"
                                    value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-left">Konfirmasi Password<span class="text-red"></span></label>
                            <label class="col-sm-1 control-label text-rigth">:<span class="text-red"></span></label>
                            <div class="col-sm-7"><input type="text" class="form-control" name="pass2"
                                    value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="nodelete" type="button" class="btn btn-danger pull-left"
                        data-dismiss="modal">Cancel</button>
                    <a href="function/fpaklaring.php?act=ganti&id=<?php echo $_SESSION['id']; ?>.png"
                        class="btn btn-primary">Simpan</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- modal delete -->