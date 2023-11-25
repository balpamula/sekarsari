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
                                    <a>Tambah Data <?php echo ucfirst($this->uri->segment(1)) ?></a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="POST" action="<?= site_url('Payment/save'); ?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-sm-6 col-md-3">
                                                <label>Kode Pesanan</label>
                                                <input type="text" id="id_pesan" name="id_pesan" class="form-control" onchange="getData()">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6 col-md-3">
                                                <label>Nama Pemesan</label>
                                                <input type="text" id="namaPemesan" name="namaPemesan" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <input type="hidden" id="total" name="total" class="form-control" readonly>
                                        <div class="form-group">
                                            <div class="col-sm-6 col-md-3">
                                                <label>Total Biaya</label>
                                                <input type="text" id="total2" name="total2" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6 col-md-3">
                                                <label>Bukti</label>
                                                <input type="file" name="bukti" class="form-control" required>
                                            </div>
                                        </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <a href="<?php echo base_url('Payment'); ?>" class="btn btn-danger ">Batal</a>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        // Event listener pada input ID order
        document.getElementById("id_pesan").addEventListener("keyup", function() {
            // Ambil nilai dari input ID order
            var id = this.value;

            // Kirim request AJAX untuk mengambil data order
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "<?php echo site_url('Payment/getDataOrder'); ?>" + "/" + id);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Parsing data JSON yang diterima
                    var order = JSON.parse(xhr.responseText);

                    // Cek apakah terdapat pesan error
                    if (order.error) {
                        // Tampilkan pesan error pada form
                        // alert(order.error);
                        // Kosongkan form
                        document.getElementById("namaPemesan").value = "";
                        document.getElementById("total2").value = "";
                    } else {
                        // Isi form dengan data order
                        document.getElementById("namaPemesan").value = order.namaPemesan;
                        document.getElementById("total").value = order.total;
                        document.getElementById("total2").value = "Rp" + number_format(order.total);
                    }
                }
            }
            xhr.send();
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