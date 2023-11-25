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
                                <div class="card-header py-3">
                                    <a>Edit Data <?php echo ucfirst($this->uri->segment(1)) ?></a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="POST" action="<?= site_url('Order/edit'); ?>" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $order->id; ?>">
                                        <input type="hidden" name="id_menu" value="<?= $order->id_menu; ?>">
                                        <div class=" form-group">
                                            <div class="col-sm-6 col-md-9">
                                                <label>Nama Menu</label>
                                                <input type="text" name="nama" class="form-control" value="<?= $order->id_menu; ?>" readonly>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="harga" id="harga" class="form-control" value="<?= $order->harga; ?>" readonly>
                                        <div class=" form-group">
                                            <div class="col-sm-6 col-md-9">
                                                <label>Harga</label>
                                                <input type="text" class="form-control number-format" value="<?= "Rp" . number_format($order->harga, 0, ".", "."); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class=" form-group">
                                            <div class="col-sm-6 col-md-9">
                                                <label>Nama Pemesan</label>
                                                <input type="text" name="namaPemesan" class="form-control" value="<?= $order->namaPemesan; ?>" required>
                                            </div>
                                        </div>
                                        <div class=" form-group">
                                            <div class="col-sm-6 col-md-9">
                                                <label>Nomor WhatsApp</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="no_wa" class="form-control" value="<?= $order->no_wa; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6 col-md-9">
                                                <label>Alamat</label>
                                                <textarea class="form-control" name="alamat" required><?= $order->alamat; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6 col-md-9">
                                                <label>Tanggal Disajikan</label>
                                                <input type="date" name="tgl_saji" class="form-control" value="<?= $order->tgl_saji; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6 col-md-9">
                                                <label>Waktu Disajikan</label>
                                                <input type="time" name="waktu_saji" class="form-control" value="<?= $order->waktu_saji; ?>" required>
                                            </div>
                                        </div>
                                        <input type="hidden" name="tgl_pesan">
                                        <div class="form-group">
                                            <div class="col-sm-6 col-md-9">
                                                <label>Jumlah</label>
                                                <input type="text" name="jumlah" id="jumlah" class="form-control" value="<?= $order->jumlah; ?>" required>
                                            </div>
                                        </div>
                                        <input type="hidden" name="total" id="total" class="form-control" value="<?= $order->total; ?>">
                                        <div class="form-group">
                                            <div class="col-sm-6 col-md-9">
                                                <label>Total</label>
                                                <input type="text" id="total2" class="form-control" value="<?= "Rp" . number_format($order->total, 0, ".", "."); ?>" readonly>
                                            </div>
                                        </div>
                                </div>
                                <!-- /.card-body -->
                                <div class=" card-footer">
                                    <a href="<?php echo base_url('Order'); ?>" class="btn btn-danger ">Batal</a>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                </form>
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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(harga) {
            $("#jumlah, #harga").keyup(function() {
                var harga = $("#harga").val();
                var jumlah = $("#jumlah").val();
                var biaya = '';

                if (jumlah >= 150) {
                    biaya = harga - 10000;
                } else if (jumlah >= 80) {
                    biaya = harga - 5000;
                } else {
                    biaya = harga
                }

                var total = parseInt(biaya) * parseInt(jumlah);
                $("#total").val(total);
                $("#total2").val("Rp" + number_format(total));
            });
        });

        function number_format(number, decimals, decPoint, thousandsSep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? '.' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? ',' : decPoint
            var s = ''

            var toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec)
                return '' + (Math.round(n * k) / k)
                    .toFixed(prec)
            }

            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || ''
                s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }
    </script>
</body>

</html>