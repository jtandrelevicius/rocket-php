<?php $this->load->view('layout/navbar') ?>

<div class="content">
  <div class="container-fluid">
    <form action="" method="POST" name="form_produtos">
      <!-- Page title -->
      <div class="page-header">
        <div class="row align-items-center mw-100">
          <div class="col">
            <div class="mb-1">
              <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="<?php echo base_url('marcas') ?>">Lista de Produtos</a></li>
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
                <a href="<?php echo base_url('produtos') ?>" class="btn btn-white">
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

          <div class="card">
            <ul class="nav nav-tabs" data-bs-toggle="tabs">
              <li class="nav-item">
                <a href="#tabs-home-9" class="nav-link active" data-bs-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="3" y="4" width="18" height="4" rx="2" />
                    <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" />
                    <line x1="10" y1="12" x2="14" y2="12" />
                  </svg>
                  &nbsp;Informações do Produto</a>
              </li>
              <li class="nav-item">
                <a href="#tabs-profile-9" class="nav-link" data-bs-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="4" y="3" width="16" height="18" rx="2" />
                    <rect x="8" y="7" width="8" height="3" rx="1" />
                    <line x1="8" y1="14" x2="8" y2="14.01" />
                    <line x1="12" y1="14" x2="12" y2="14.01" />
                    <line x1="16" y1="14" x2="16" y2="14.01" />
                    <line x1="8" y1="17" x2="8" y2="17.01" />
                    <line x1="12" y1="17" x2="12" y2="17.01" />
                    <line x1="16" y1="17" x2="16" y2="17.01" />
                  </svg>
                  &nbsp; Informações Fiscais</a>
              </li>
            </ul>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane show active" id="tabs-home-9">
                  <div>
                    <div class="row">
                      <!--Row1-->
                      <div class="form-group col-2 ">
                        <label class="form-label">Código Interno</label>
                        <div>
                          <input type="text" class="form-control" name="produto_codigo" placeholder="Nome" value="<?php echo set_value('produto_codigo') ?>">
                          <?php echo form_error('produto_codigo', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                      </div>

                      <div class="form-group col-7 ">
                        <label class="form-label required">Descrição</label>
                        <div>
                          <input type="text" class="form-control" name="produto_descricao" placeholder="Nome" value="<?php echo set_value('produto_descricao') ?>">
                          <?php echo form_error('produto_descricao', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                      </div>

                      <div class="form-group col-2 ">
                        <label class="form-label">Código de Barras / EAN</label>
                        <div>
                          <input type="text" class="form-control" name="produto_codigo_barras" placeholder="7890000000000" value="<?php echo set_value('produto_codigo_barras') ?>">
                          <?php echo form_error('produto_codigo_barras', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                      </div>

                      <div class="form-group col-1 ">
                        <label class="form-label">UN</label>
                        <div>
                          <input type="text" class="form-control" name="produto_unidade" placeholder="UN" value="<?php echo set_value('produto_unidade') ?>">
                          <?php echo form_error('produto_unidade', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                      </div>

                    </div>
                    <!--Row1-->
                    <br>
                    <div class="row">
                      <!--Row1-->
                      <div class="form-group col-3 ">
                        <label class="form-label required">Preço de Custo</label>
                        <div>
                          <input type="text" class="form-control input_dinheiro2" name="produto_preco_custo" placeholder="R$ 0.00" value="<?php echo set_value('produto_preco_custo') ?>">
                          <?php echo form_error('produto_preco_custo', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                      </div>

                      <div class="form-group col-3 ">
                        <label class="form-label required">Preço de Venda</label>
                        <div>
                          <input type="text" class="form-control input_dinheiro2" name="produto_preco_venda" placeholder="R$ 0.00" value="<?php echo set_value('produto_preco_venda') ?>">
                          <?php echo form_error('produto_preco_venda', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                      </div>

                      <div class="form-group col-3 ">
                        <label class="form-label">Estoque</label>
                        <div>
                          <input type="text" class="form-control" name="produto_qtde_estoque" placeholder="Estoque" value="<?php echo set_value('produto_qtde_estoque') ?>">
                          <?php echo form_error('produto_qtde_estoque', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                      </div>

                      <div class="form-group col-3 ">
                        <label class="form-label">Estoque Minimo</label>
                        <div>
                          <input type="text" class="form-control" name="produto_estoque_minimo" placeholder="Estoque Minimo" value="<?php echo set_value('produto_estoque_minimo') ?>">
                          <?php echo form_error('produto_estoque_minimo', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                      </div>


                    </div>
                    <!--Row1-->
                    <br>

                    <div class="row">
                      <!--Row1-->

                      <div class="form-group col-4">
                        <label class="form-label ">Fornecedor</label>
                        <select class="form-select" name="produto_fornecedor_id">
                          <option value=""></option>
                          <?php foreach ($fornecedores as $fornecedor) : ?>
                            <option value="<?php echo $fornecedor->fornecedor_id ?>"><?php echo $fornecedor->fornecedor_nome_fantasia ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div class="form-group col-3">
                        <label class="form-label ">Marca</label>
                        <select class="form-select" name="produto_marca_id">
                          <option value=""></option>
                          <?php foreach ($marcas as $marca) : ?>
                            <option value=" <?php echo $marca->marca_id ?>"><?php echo $marca->marca_nome ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div class="form-group col-3">
                        <label class="form-label ">Categoria</label>
                        <select class="form-select" name="produto_categoria_id">
                          <option value=""></option>
                          <?php foreach ($categorias as $categoria) : ?>
                            <option value="<?php echo $categoria->categoria_id ?>"><?php echo $categoria->categoria_nome ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div class="form-group col-2">
                        <label class="form-label ">Ativo</label>
                        <select class="form-select" name="produto_ativo">
                          <option value="1">Sim</option>
                          <option value="0">Não</option>
                        </select>
                      </div>

                    </div>
                    <!--Row1-->
                    <br>

                    <div class="row">

                      <div class="form-group col-12">
                        <label class="form-label">Observação<span class="form-label-description">0/180</span></label>
                        <textarea class="form-control" name="produto_observacao" rows="4" placeholder="Observação"><?php echo set_value('produto_observacao') ?></textarea>
                        <?php echo form_error('produto_observacao', '<small class="form-text text-danger">', '</small>') ?>
                      </div>


                    </div>
                    <br>



                  </div>
                </div>
                <div class="tab-pane" id="tabs-profile-9">
                  <div>Liberação para empresa emitente de Notas Fiscais.</div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </form>
    <!-- Content here -->
  </div>