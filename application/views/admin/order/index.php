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
                                    <a>Data <?php echo ucfirst($this->uri->segment(1)) ?> Belum Dibayar</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <?= ($this->session->flashdata('alert')); ?>
                                    <table id="example2" class="table table-bordered table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th>Menu</th>
                                                <th>Nama Pemesan</th>
                                                <th>No WA</th>
                                                <th width="200">Alamat</th>
                                                <th>Tgl Penyajian</th>
                                                <th>Waktu Penyajian</th>
                                                <th>Tgl Pesan</th>
                                                <th class="text-center">Jumlah</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Status Bayar</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tanggal = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                            $tanggal->setPattern('EEEE, dd MMMM yyyy');
                                            $waktu = new IntlDateFormatter('id_ID', IntlDateFormatter::NONE, IntlDateFormatter::SHORT);
                                            $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::SHORT);
                                            $formatter->setPattern('EEEE, dd MMMM yyyy, HH:mm');
                                            if ($cekdata > 0) {
                                                $no = 1;
                                                foreach ($order as $item) { ?>
                                                    <?php if ($item->status_bayar == 'N') { ?>
                                                        <tr>
                                                            <td class="text-center"><?= $item->idpesan; ?></td>
                                                            <td><?= $item->menu; ?></td>
                                                            <td><?= $item->namaPemesan; ?></td>
                                                            <td><?= $item->no_wa; ?></td>
                                                            <td><?= $item->alamat; ?></td>
                                                            <td><?= $tanggal->format(strtotime($item->tgl_saji)); ?></td>
                                                            <td class="text-center"><?= $waktu->format(strtotime($item->waktu_saji)); ?></td>
                                                            <td><?= $formatter->format(strtotime($item->tgl_pesan)); ?></td>
                                                            <td class="text-center"><?= $item->jumlah; ?></td>
                                                            <td class="text-center"><?= "Rp" . number_format($item->total, 0, ".", "."); ?></td>
                                                            <?php if ($item->status_bayar == 'N') { ?>
                                                                <td class="text-center"><span class="badge badge-warning">Belum Dibayar</span></td>
                                                            <?php } else { ?>
                                                                <td class="text-center"><span class="badge badge-success">Sudah Dibayar</span></td>
                                                            <?php } ?>
                                                            <td class="text-center">
                                                                <a href="<?= site_url('Order/getid/' . $item->idpesan); ?>" class=" btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                                <?php
                                                                // sediakan nohp target
                                                                $nohp = $item->no_wa;
                                                                // atur pesan dengan helper text urlencode
                                                                $message = '&text=' . urlencode('
*Sekarsari Catering*
                                                    
_Informasi Pemesanan_
                                                    
Kode Pesanan : ' . $item->idpesan . ' 
Nama : ' . $item->namaPemesan . ' 
Alamat : ' . $item->alamat . ' 
                                                    
Menu : ' . $item->menu . ' 
Tanggal disajikan : ' . $tanggal->format(strtotime($item->tgl_saji)) . ' 
Waktu disajikan : ' . $waktu->format(strtotime($item->waktu_saji)) . ' 
                                                    
Jumlah : ' . $item->jumlah . ' 
Total Biaya : Rp' . number_format($item->total, 0, ".", ".") . '

Pilihan pembayaran : 
DANA : 082140971339
BCA : 461053287

*PENTING*
_- Pastikan data yang diinputkan sudah benar, jika belum anda dapat membalas pesan ini_
_- Batas waktu pembayaran adalah 7 hari / 1 minggu sebelum Tanggal disajikan_
_- Untuk konfirmasi pembayaran dapat diakses melalui web_');
                                                                // tapi kalau desktop pakai web.whatsapp.com
                                                                $linkWA = 'https://web.whatsapp.com/send?phone=' . $nohp . $message;
                                                                ?>
                                                                <a href="<?php echo $linkWA ?>" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-envelope"></i></a>
                                                                <a href="<?= site_url('order/delete/' . $item->idpesan); ?>" class="btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin ingin menghapus data dengan kode <?= $item->idpesan; ?> ini?')"><i class="fas fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="13" align="center">
                                                        <h4>Data Kosong</h4>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card shadow mb-2">
                                <div class="card-header">
                                    <a>Data <?php echo ucfirst($this->uri->segment(1)) ?> Sudah Dibayar</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example3" class="table table-bordered table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th>Menu</th>
                                                <th>Nama Pemesan</th>
                                                <th>No WA</th>
                                                <th width="200">Alamat</th>
                                                <th>Tgl Penyajian</th>
                                                <th>Waktu Penyajian</th>
                                                <th>Tgl Pesan</th>
                                                <th class="text-center">Jumlah</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Status Bayar</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tanggal = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                            $tanggal->setPattern('EEEE, dd MMMM yyyy');
                                            $waktu = new IntlDateFormatter('id_ID', IntlDateFormatter::NONE, IntlDateFormatter::SHORT);
                                            $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::SHORT);
                                            $formatter->setPattern('EEEE, dd MMMM yyyy, HH:mm');
                                            if ($cekdata > 0) {
                                                $no = 1;
                                                foreach ($order as $item) { ?>
                                                    <?php if ($item->status_bayar == 'Y') { ?>
                                                        <tr>
                                                            <td class="text-center"><?= $item->idpesan; ?></td>
                                                            <td><?= $item->menu; ?></td>
                                                            <td><?= $item->namaPemesan; ?></td>
                                                            <td><?= $item->no_wa; ?></td>
                                                            <td><?= $item->alamat; ?></td>
                                                            <td><?= $tanggal->format(strtotime($item->tgl_saji)); ?></td>
                                                            <td class="text-center"><?= $waktu->format(strtotime($item->waktu_saji)); ?></td>
                                                            <td><?= $formatter->format(strtotime($item->tgl_pesan)); ?></td>
                                                            <td class="text-center"><?= $item->jumlah; ?></td>
                                                            <td class="text-center"><?= "Rp" . number_format($item->total, 0, ".", "."); ?></td>
                                                            <?php if ($item->status_bayar == 'N') { ?>
                                                                <td class="text-center"><span class="badge badge-warning">Belum Dibayar</span></td>
                                                            <?php } else { ?>
                                                                <td class="text-center"><span class="badge badge-success">Sudah Dibayar</span></td>
                                                            <?php } ?>
                                                            <td class="text-center">
                                                                <a href="<?= site_url('Order/getid/' . $item->idpesan); ?>" class=" btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                                <a href="<?= site_url('order/delete/' . $item->idpesan); ?>" class="btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin ingin menghapus data dengan kode <?= $item->idpesan; ?> ini?')"><i class="fas fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="13" align="center">
                                                        <h4>Data Kosong</h4>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                    </table>
                                </div>
                            </div>
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
            $('#example3').DataTable({
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