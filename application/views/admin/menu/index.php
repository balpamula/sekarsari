<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/_partials/head.php"); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php $this->load->view("admin/_partials/navbar.php"); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("admin/_partials/sidebar.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?php echo ucfirst($this->uri->segment(1)) ?></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-2">
                                <div class="card-header">
                                    <a href="<?= site_url('Menu/add'); ?>" class="btn btn-primary">Tambah <?php echo ucfirst($this->uri->segment(1)) ?></a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <?= ($this->session->flashdata('alert')); ?>
                                    <table id="example2" class="table table-bordered table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">ID</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Harga</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($cekdata > 0) {
                                                $no = 1;
                                                foreach ($menu as $item) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++; ?></td>
                                                        <td class="text-center"><?= $item->id; ?></td>
                                                        <td><?= $item->nama; ?></td>
                                                        <td><?= $item->deskripsi; ?></td>
                                                        <td><?= "Rp" . number_format($item->harga, 0, ".", "."); ?></td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalGambar<?php echo $item->id; ?>">
                                                                <i class="fas fa-image"></i>
                                                            </button>
                                                            <a href="<?= site_url('Menu/getid/' . $item->id); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                            <a href="<?= site_url('Menu/delete/' . $item->id); ?>" class="btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin ingin menghapus <?= $item->nama; ?>?')">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr><?php }
                                                    } else { ?>
                                                <tr>
                                                    <td colspan="7" align="center">
                                                        <h4>Data Kosong</h4>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php foreach ($menu as $item) { ?>
                                        <div class="modal fade" id="modalGambar<?php echo $item->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle"><?= $item->nama; ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="<?php echo base_url('upload/gambar/' . $item->gambar) ?>" class="card-img-top rounded p-4" alt="...">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <?php $this->load->view("admin/_partials/footer.php"); ?>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <?php $this->load->view("admin/_partials/js.php"); ?>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>