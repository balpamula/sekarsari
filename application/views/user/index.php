<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("user/_partials/head.php"); ?>
    <title><?php echo SITE_NAME ?></title>
</head>

<body id="#">
    <!-- Navigation-->
    <?php $this->load->view("user/_partials/navbar.php"); ?>
    <?= ($this->session->flashdata('alert')); ?>
    <!-- Header-->
    <!-- <div class="container px-4 px-lg-5 my-5">
        <div class="text-center">
            <img src="<?= base_url('assets/'); ?>img/logo/sekarsari.png " width="50%">
            <h1 class="display-4 fw-bolder">SEKARSARI CATERING</h1>
        </div>
    </div> -->
    <!-- Section-->
    <!-- <div class="container px-4 px-lg-5 my-5">
        <hr class="my-4">
        <div class="text-center">
            <p class="lead fw-normal text-50 mb-0">Kepuasan anda adalah prioritas kami</p>
        </div>
        <hr class="my-4">
    </div>
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center">
            <a class="btn btn-outline-primary mt-auto btn-lg" href="<?php echo site_url('Home/menu'); ?>">Mulai Memesan <i class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div> -->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">SEKARSARI CATERING</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">Kepuasan anda adalah prioritas kami.</p>
                </div>
            </div>
        </div>
    </header>
    <section class="page-section bg-primary" id="home">
        <div class="container px-4 px-lg-5">
            <h2 class="text-white text-center mt-0">Mengapa harus pesan disini?</h2>
            <hr class="divider divider-light" />
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-universal-access fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3 fw-bolder">Mudah</h4>
                    <p class="text-white">Anda dapat memesan dimana saja dan kapan saja!</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-percentage fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3 fw-bolder">Potongan Harga</h4>
                    <p class="text-white">Dapatkan potongan harga untuk pemesanan lebih dari 80 porsi!</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-truck fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3 fw-bolder">Gratis Ongkir</h4>
                    <p class="text-white"> Anda hanya perlu menunggu dan kami akan mengantar ke tempat anda.
                        Tentunya tanpa biaya tambahan.
                        Pengantaran maksimal dari kami adalah 45km!
                    </p>
                </div>
            </div>
            <div class="text-center mt-5">
                <a class="btn btn-light btn-xl" href="#menu">Pesan Sekarang!</a>
            </div>
        </div>
    </section>
    <section class="page-section" id="menu">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0 fw-bolder">Pilihan Paket Menu Kami</h2>
            <hr class="divider" />
        </div>
        <div class="container px-4 px-lg-5 mt-5 ">
            <div class="row gx-8 gx-lg-3 row-cols-2 row-cols-md-3 row-cols-xl-5 justify-content-center">
                <?php foreach ($menu as $item) { ?>
                    <div class="col mb-5 ">
                        <div class="card h-100 shadow">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo base_url('upload/gambar/' . $item->gambar) ?>" width="15%" alt=" ..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $item->nama; ?></h5>
                                    <hr class="my-4">
                                    <!-- Product desc-->
                                    <p><?php echo $item->deskripsi; ?></p>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center fw-bolder">
                                    <?php echo "Rp" . number_format($item->harga, 0, ".", "."); ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer">
                                <div class="text-center">
                                    <a class="btn btn-outline-success mt-auto" href="<?= site_url('Home/order/' . $item->id); ?>">Pesan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="page-section" id="pembayaran">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="mt-0 fw-bolder">Sudah Membayar?</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Konfirmasi pembayaran disini!</p>
                    </div>
                    <div class="col-12">
                        <!-- <div class="py-3">
                            <div class="text-center">
                                <img src="<?= base_url('assets/'); ?>img/logo/sekarsari.png " width="15%" alt=" ..." />
                            </div>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="<?= site_url('Home/save_bayar'); ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="col-sm-6 col-md-auto mb-3">
                                        <label>Kode Pesanan</label>
                                        <div class="input-group">
                                            <input type="text" id="id_pesan" name="id_pesan" class="form-control" placeholder="Masukkan kode pesanan anda..." onchange="getData()">
                                        </div>
                                        <small id="error-message" class="text-danger"></small>
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
                        </div>
                        <div class="card-footer border-top-0 bg-transparent text-center">
                            <button type="submit" class="btn btn-success">Konfirmasi</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-3 bg-light">
        <?php $this->load->view("user/_partials/footer.php"); ?>
    </footer>
    <!-- JS-->
    <?php $this->load->view("user/_partials/js.php"); ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        // Event listener pada input ID order
        document.getElementById("id_pesan").addEventListener("keyup", function() {
            // Ambil nilai dari input ID order
            var id = this.value;

            // Cek apakah input ID order kosong
            if (id.trim() === "") {
                // Kosongkan pesan error
                document.getElementById("error-message").innerHTML = "";
                // Hentikan proses pengiriman request AJAX
                return;
            }
            // Kirim request AJAX untuk mengambil data order
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "<?php echo site_url('Home/getDataorder'); ?>" + "/" + id);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Parsing data JSON yang diterima
                    var order = JSON.parse(xhr.responseText);

                    // Cek apakah terdapat pesan error
                    if (order.error) {
                        // Tampilkan pesan error pada form
                        // alert(order.error);
                        document.getElementById("error-message").innerHTML = order.error;
                        // Kosongkan form
                        document.getElementById("namaPemesan").value = "";
                        document.getElementById("total2").value = "";
                    } else {
                        // Kosongkan pesan error
                        document.getElementById("error-message").innerHTML = "";
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#alertModal').modal('show');
        });
    </script>
</body>

</html>