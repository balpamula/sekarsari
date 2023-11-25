<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("user/_partials/head.php"); ?>
</head>

<body>
    <!-- Navigation-->
    <title><?php echo SITE_NAME . " - " . ucfirst($this->uri->segment(2)) ?></title>
    <!-- Header-->
    <!-- Section-->
    <section class="py-1">
        <div class="container px-4 px-lg-5 mt-5 ">
            <!-- <div class="header py-3 mb-5">
                <div class="text-center">
                    <img src="<?= base_url('assets/'); ?>img/logo/sekarsari.png " width="15%" alt=" ..." />
                </div>
            </div> -->

            <div class="text-center">
                <h2 class="mt-0 fw-bolder">Input Data Pesanan</h2>
                <hr class="divider" />
            </div>
            <div class="row gx-8 gx-lg-3 row-cols-xl-2 justify-content-center">
                <!-- content -->
                <form method="POST" action="<?= site_url('Home/save_order'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_menu" value="<?= $menu->id; ?>">
                    <div class="form-group">
                        <div class="col-sm-6 col-md-12">
                            <label>Nama Menu</label>
                            <div class="input-group mb-2">
                                <input type="text" name="nama" class="form-control" value="<?= $menu->nama; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="harga" id="harga" class="form-control" value="<?= $menu->harga; ?>" readonly>
                    <div class=" form-group">
                        <div class="col-sm-6 col-md-12">
                            <label>Harga</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control number-format" value="<?= "Rp" . number_format($menu->harga, 0, ".", "."); ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class=" form-group">
                        <div class="col-sm-6 col-md-12">
                            <label>Nama Pemesan</label>
                            <div class="input-group mb-2">
                                <input type="text" name="namaPemesan" class="form-control" placeholder="Masukkan nama anda dengan benar..." required>
                            </div>
                        </div>
                    </div>
                    <div class=" form-group">
                        <div class="col-sm-6 col-md-12">
                            <label>Nomor WhatsApp</label>
                            <div class="input-group mb-2">
                                <input type="text" name="no_wa" class="form-control" placeholder="ex. 082112345678" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-md-12">
                            <label>Alamat</label>
                            <div class="input-group mb-2">
                                <textarea class="form-control" rows="3" name="alamat" placeholder="Masukkan alamat anda dengan benar..." required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-md-12 mb-2">
                            <label>Tanggal Disajikan</label>
                            <div class="input-group">
                                <input type="date" name="tgl_saji" class="form-control" required>
                            </div>
                            <small class="form-text text-muted">Minimal 7 hari / 1 minggu seteleh pesanan ini dibuat</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-md-12 mb-2">
                            <label>Waktu Disajikan</label>
                            <div class="input-group">
                                <input type="time" name="waktu_saji" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="tgl_order">
                    <div class="form-group">
                        <div class="col-sm-6 col-md-12">
                            <label>Jumlah</label>
                            <div class="input-group mb-2">
                                <input type="text" name="jumlah" id="jumlah" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="total" id="total" class="form-control" value="<?= $menu->harga; ?>">
                    <div class="form-group">
                        <div class="col-sm-6 col-md-12">
                            <label>Total</label>
                            <div class="input-group mb-2">
                                <input type="text" id="total2" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="form-group">
                        <a href="<?php echo base_url('Home#menu'); ?>" class="btn btn-danger ">Batal</a>
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-success">Pesan</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
    <!-- JS-->
    <?php $this->load->view("user/_partials/js.php"); ?>

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