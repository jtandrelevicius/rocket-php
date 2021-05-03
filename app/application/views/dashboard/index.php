<?php $this->load->view('layout/navbar') ?>

<div class="content">
    <div class="container-fluid">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                </div>
            </div>
        </div>
        <!-- Content here -->

<div>
<?php if ($message = $this->session->flashdata('info')) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-important alert-info alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                            <i class="fas fa-exclamation-triangle"></i>&nbsp; <?php echo $message; ?>
                            </div>
                        </div>
                        <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
</div>



</div>
      