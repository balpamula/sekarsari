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
                                    <a href="<?= site_url('Payment/add'); ?>" class="btn btn-primary">Tambah <?php echo ucfirst($this->uri->segment(1)) ?></a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">ID Order</th>
                                                <th class="text-center">Nama Pemesan</th>
                                                <th class="text-center">Waktu Konfirmasi</th>
                                                <th class="text-center">Status Payment</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::SHORT);
                                            $formatter->setPattern('dd MMMM yyyy, HH:mm');
                                            if ($cekdata > 0) {
                                                $no = 1;
                                                foreach ($payment as $item) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $item->idpem; ?></td>
                                                        <td class="text-center"><?= $item->id_pesan; ?></td>
                                                        <td class="text-center"><?= $item->namaPemesan; ?></td>
                                                        <td class="text-center"><?= $formatter->format(strtotime($item->waktu_konfirmasi)); ?></td>
                                                        <?php if ($item->status_bayar == 'N') { ?>
                                                            <td class=" text-center"><span class="badge badge-warning">Belum Dibayar</span></td>
                                                        <?php } else { ?>
                                                            <td class="text-center"><span class="badge badge-success">Sudah Dibayar</span></td>
                                                        <?php } ?>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalBukti<?php echo $item->id; ?>"><i class="fas fa-eye"></i></button>
                                                            <?php
                                                            // sediakan nohp target
                                                            $nohp = $item->no_wa;
                                                            // atur pesan dengan helper text urlencode
                                                            $message = '&text=' . urlencode('
*Sekarsari Catering*
                                                    
_Informasi Payment_

_*LUNAS*_
Kode Pesanan : ' . $item->id_pesan . ' 
Nama : ' . $item->namaPemesan . ' 
Jumlah : Rp' . number_format($item->total, 0, ".", ".") . ' 
Waktu : ' . $formatter->format(strtotime($item->waktu_konfirmasi)) . ' 
                                                    
*PENTING*
_- Jika ada yang ingin ditanyakan, anda dapat membalas pesan ini_
_- Informasi pengiriman akan dikirimkan melalui WhatsApp_');
                                                            // tapi kalau desktop pakai web.whatsapp.com
                                                            $linkWA = 'https://web.whatsapp.com/send?phone=' . $nohp . $message;
                                                            ?>
                                                            <?php if ($item->status_bayar == 'N') { ?>
                                                                <a href="<?= site_url('payment/status_bayar_Y/' . $item->id); ?>" class="btn btn-info btn-sm"><i class="fas fa-check"></i></a>
                                                                <a href="<?php echo $linkWA ?>" target="_blank" class="btn btn-success btn-sm disabled"><i class="fas fa-envelope"></i></a>
                                                            <?php } else { ?>
                                                                <a href="<?= site_url('payment/status_bayar_Y/' . $item->id); ?>" class="btn btn-success btn-sm disabled"><i class="fas fa-check"></i></a>
                                                                <a href="<?php echo $linkWA ?>" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-envelope"></i></a>
                                                            <?php } ?>
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
                                    <?php foreach ($payment as $item) { ?>
                                        <div class="modal fade" id="modalBukti<?php echo $item->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Bukti Bayar Order "<?= $item->id_pesan; ?>"</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="<?php echo base_url('upload/bukti/' . $item->bukti) ?>" width="80%" alt="...">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>