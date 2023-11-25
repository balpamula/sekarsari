<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("user/_partials/head.php"); ?>
    <title><?php echo SITE_NAME . " - " . ucfirst($this->uri->segment(2)) ?></title>
</head>

<body>
    <?php $this->load->view("user/_partials/navbar.php"); ?>

    <section class="py-1">
        <?= ($this->session->flashdata('alert')); ?>
        <div class="container px-4 px-lg-5 mt-5 ">
            <div class="row gx-8 gx-lg-3 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center">
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
                                    <a class="btn btn-outline-success mt-auto" href="<?= site_url('Home/pesan/' . $item->id); ?>">Pesan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-2 bg-dark">
        <?php $this->load->view("user/_partials/footer.php"); ?>
    </footer>
    <!-- JS-->
    <?php $this->load->view("user/_partials/js.php"); ?>
    <script>
        $(document).ready(function() {
            $('#alertModal').modal('show');
        });
    </script>
</body>

</html>