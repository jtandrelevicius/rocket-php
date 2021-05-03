<?php $this->load->view('layout/navbar') ?>

<div class="content">
  <div class="container-fluid">
    <form action="" method="POST" name="form_categorias">
      <!-- Page title -->
      <div class="page-header">
        <div class="row align-items-center mw-100">
          <div class="col">
            <div class="mb-1">
              <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="<?php echo base_url('categorias') ?>">Lista de Serviços</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo $titulo ?></a></li>
              </ol>
            </div>
            <h2 class="page-title">
              <span class="text-truncate"><?php echo $titulo ?></span>
            </h2>
          </div>
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <span class="d-none d-sm-inline">
                <a href="<?php echo base_url('categorias') ?>" class="btn btn-white">
                  Cancelar
                </a>
              </span>

              <button type="submit" class="btn btn-primary d-none d-sm-inline-block">
                Salvar
              </button>

            </div>
          </div>
        </div>
      </div>
      <?php if ($message = $this->session->flashdata('sucesso')) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-important alert-success alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                            <i class="far fa-smile"></i>&nbsp; <?php echo $message; ?>
                            </div>
                        </div>
                        <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($message = $this->session->flashdata('error')) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
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

      <div class="card">
        <div class="card-header">
        
        </div>
        <div class="card-body">
          <div class="row">
            <!--Row1-->
            <div class="form-group col-10 ">
              <label class="form-label required">Nome da Categoria</label>
              <div>
                <input type="text" class="form-control" name="categoria_nome" placeholder="Nome" 
                value="<?php echo $categoria->categoria_nome?>">
                <?php echo form_error('categoria_nome', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
         
            <div class="form-group col-2">
              <label class="form-label ">Ativo</label>
              <select class="form-select" name="categoria_ativa">
                <option value="0" <?php echo ($categoria->categoria_ativa == 0) ? 'selected' : ''?>>Não</option>
                <option value="1" <?php echo ($categoria->categoria_ativa == 1) ? 'selected' : ''?>>Sim</option>
              </select>

            </div>
          </div>
          <!--Row1-->
          <br>

          
        <input type="hidden" name="marca_id" value="<?php echo $categoria->categoria_id?>">
        </div>
      </div>
    </form>
    <!-- Content here -->
  </div>
