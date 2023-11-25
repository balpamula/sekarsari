<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("user/_partials/head.php"); ?>
    <title><?php echo SITE_NAME . " - " . ucfirst($this->uri->segment(2)) ?></title>
</head>

<body>
    <!-- Navigation-->
    <?php $this->load->view("user/_partials/navbar.php"); ?>
    <!-- Header-->
    <!-- Section-->
    <section class="container">
        <?= ($this->session->flashdata('alert')); ?>
        <div class="container px-4 px-lg-5 mt-5 ">
            <div class="row gx-8 gx-lg-3 row-cols-xl-2 justify-content-center">
                <div class="col-12">
                    <div class="card shadow mb-2">
                        <div class="card-header py-3">
                            <div class="text-center">
                                <img src="<?= base_url('assets/'); ?>img/logo/sekarsari.png " width="15%" alt=" ..." />
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="<?= site_url('Home/save_bayar'); ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="col-sm-6 col-md-auto">
                                        <label>Kode Pesanan</label>
                                        <div class="input-group mb-3">
                                            <input type="text" id="id_pesan" name="id_pesan" class="form-control" placeholder="Masukkan kode pesanan anda..." onchange="getData()">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6 col-md-auto">
                                        <label>Nama Pemesan</label>
                                        <div class="input-group mb-3">
                                            <input type="text" id="namaPemesan" name="namaPemesan" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="total" name="total" class="form-control" readonly>
                                <div class="form-group">
                                    <div class="col-sm-6 col-md-auto">
                                        <label>Total Biaya</label>
                                        <div class="input-group mb-3">
                                            <input type="text" id="total2" name="total2" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6 col-md-auto">
                                        <label>Bukti</label>
                                        <div class="input-group mb-3">
                                            <input type="file" name="bukti" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6 col-md-auto">
                                        <a>DANA : 082140971339<br>
                                            BCA : 4610532875
                                        </a>
                                    </div>
                                </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="<?php echo base_url('Home'); ?>" class="btn btn-danger ">Batal</a>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Footer-->
    <footer class="py-2 bg-dark fixed-bottom">
        <?php $this->load->view("user/_partials/footer.php"); ?>
    </footer>
    <!-- JS-->
    <?php $this->load->view("user/_partials/js.php"); ?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        // Event listener pada input ID pesanan
        document.getElementById("id_pesan").addEventListener("keyup", function() {
            // Ambil nilai dari input ID pesanan
            var id = this.value;

            // Kirim request AJAX untuk mengambil data pesanan
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "<?php echo site_url('Home/getDataPesanan'); ?>" + "/" + id);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Parsing data JSON yang diterima
                    var pesanan = JSON.parse(xhr.responseText);

                    // Cek apakah terdapat pesan error
                    if (pesanan.error) {
                        // Tampilkan pesan error pada form
                        // alert(pesanan.error);
                        // Kosongkan form
                        document.getElementById("namaPemesan").value = "";
                        document.getElementById("total2").value = "";
                    } else {
                        // Isi form dengan data pesanan
                        document.getElementById("namaPemesan").value = pesanan.namaPemesan;
                        document.getElementById("total").value = pesanan.total;
                        document.getElementById("total2").value = "Rp" + number_format(pesanan.total);
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#alertModal').modal('show');
        });
    </script>
</body>

</html>